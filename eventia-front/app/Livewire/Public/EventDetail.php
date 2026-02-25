<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Evento;

class EventDetail extends Component
{
    public $evento;
    public $messages = [];
    public $userInput = '';
    public $solicitudPendiente = null;

    public function mount($id)
    {
        $this->evento = Evento::with(['ayuntamiento', 'artistas'])->findOrFail($id);

        // Visibility protection: ABIERTO events are only for staff/artists
        if ($this->evento->estado === 'ABIERTO') {
            if (!auth()->check() || (auth()->user()->tipo_usuario !== 'artista' && auth()->user()->tipo_usuario !== 'ayuntamiento' && auth()->user()->tipo_usuario !== 'admin')) {
                return redirect()->route('home')->with('error', 'Este evento aún no está disponible para el público.');
            }
        }

        // Check if artist has already applied
        if (auth()->check() && auth()->user()->tipo_usuario === 'artista') {
            $artista = \App\Models\Artista::where('id_usuario', auth()->id())->first();
            if ($artista) {
                $this->solicitudPendiente = \App\Models\Solicitud::where('id_artista', $artista->id)
                    ->where('id_evento', $this->evento->id)
                    ->first();
            }
        }

        // Initial message
        $precioBot = "";
        if ($this->evento->tipos_entrada && count($this->evento->tipos_entrada) > 0) {
            $minPrice = collect($this->evento->tipos_entrada)->min('precio');
            $precioBot = "precios desde " . number_format($minPrice, 2) . "€";
        } else {
            $precioBot = "un precio de " . number_format($this->evento->precio, 2) . "€";
        }

        $fechaEvento = \Carbon\Carbon::parse($this->evento->fecha_inicio)->format('d M Y - H:i');
        $this->messages[] = [
            'role' => 'assistant',
            'content' => "¡Hola! Soy el asistente de Eventia. ¿Tienes alguna duda sobre el {$this->evento->nombre_evento}? Se celebrará el {$fechaEvento}. Puedo informarte sobre {$precioBot}, artistas confirmados, ubicación o el ayuntamiento organizador."
        ];
    }

    public function solicitarEvento()
    {
        if (!auth()->check() || auth()->user()->tipo_usuario !== 'artista') {
            return;
        }

        if ($this->evento->estado !== 'ABIERTO') {
            $this->dispatch('notificar', [
                'titulo' => 'No disponible',
                'mensaje' => 'Este evento ya no acepta solicitudes de artistas.',
                'tipo' => 'error'
            ]);
            return;
        }

        $artista = \App\Models\Artista::where('id_usuario', auth()->id())->first();

        if (!$artista) {
            return;
        }

        // Double check if already exists
        $exists = \App\Models\Solicitud::where('id_artista', $artista->id)
            ->where('id_evento', $this->evento->id)
            ->exists();

        if ($exists) {
            return;
        }

        $this->solicitudPendiente = \App\Models\Solicitud::create([
            'id_artista' => $artista->id,
            'id_evento' => $this->evento->id,
            'estado' => 'pendiente'
        ]);

        $this->dispatch('notificar', [
            'titulo' => 'Solicitud enviada',
            'mensaje' => 'Tu propuesta ha sido enviada al ayuntamiento correctamente.',
            'tipo' => 'success'
        ]);
    }

    public function sendMessage()
    {
        if (trim($this->userInput) === '')
            return;

        $userMessage = $this->userInput;
        $this->messages[] = ['role' => 'user', 'content' => $userMessage];
        $this->userInput = '';

        $response = $this->generateResponse($userMessage);
        $this->messages[] = ['role' => 'assistant', 'content' => $response];

        $this->dispatch('messageAdded');
    }

    protected function generateResponse($input)
    {
        $input = mb_strtolower($input);

        if (str_contains($input, 'artista') || str_contains($input, 'quién') || str_contains($input, 'cartel')) {
            $artistas = $this->evento->artistas->pluck('nombre_artistico')->join(', ', ' y ');
            return $artistas
                ? "Los artistas confirmados para este evento son: {$artistas}. ¡Va a ser increíble! 🎵"
                : "Aún no se han confirmado artistas específicos para este evento, ¡pero mantente atento a las actualizaciones!";
        }

        if (str_contains($input, 'precio') || str_contains($input, 'entrada') || str_contains($input, 'cuánto') || str_contains($input, 'cuesta')) {
            if ($this->evento->tipos_entrada && count($this->evento->tipos_entrada) > 0) {
                $precios = collect($this->evento->tipos_entrada)->map(function ($t) {
                    return "{$t['nombre']}: " . number_format($t['precio'], 2) . "€";
                })->join(', ');
                return "Tenemos varios tipos de entrada: {$precios}. Puedes comprarlas directamente aquí.";
            }
            return "El precio de la entrada es de " . number_format($this->evento->precio, 2) . "€. Puedes adquirir tus entradas directamente en esta página.";
        }

        if (str_contains($input, 'donde') || str_contains($input, 'dónde') || str_contains($input, 'ubicación') || str_contains($input, 'lugar') || str_contains($input, 'sitio')) {
            return "El evento tendrá lugar en {$this->evento->localidad}, {$this->evento->provincia}. ¡Te esperamos allí! 📍";
        }

        if (str_contains($input, 'cuándo') || str_contains($input, 'cuando') || str_contains($input, 'fecha') || str_contains($input, 'día') || str_contains($input, 'hora')) {
            return "El evento está programado para el día " . \Carbon\Carbon::parse($this->evento->fecha_inicio)->format('d M Y') . " a las " . \Carbon\Carbon::parse($this->evento->fecha_inicio)->format('H:i') . ". 📅";
        }

        if (str_contains($input, 'ayuntamiento') || str_contains($input, 'organiza') || str_contains($input, 'institución')) {
            $ayto = $this->evento->ayuntamiento->nombre_institucion;
            return "Este evento es organizado por el {$ayto}. Son conocidos por su excelente gestión de eventos culturales.";
        }

        if (str_contains($input, 'hola') || str_contains($input, 'buenos días') || str_contains($input, 'buenas')) {
            return "¡Hola! ¿En qué puedo ayudarte hoy con respecto al evento {$this->evento->nombre_evento}?";
        }

        return "Lo siento, no tengo información específica sobre eso. Pero recuerda que el evento {$this->evento->nombre_evento} será en {$this->evento->localidad} el día " . \Carbon\Carbon::parse($this->evento->fecha_inicio)->format('d M Y') . " a las " . \Carbon\Carbon::parse($this->evento->fecha_inicio)->format('H:i') . ". ¿Deseas saber algo más sobre los artistas o las entradas?";
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.event-detail');
    }
}
