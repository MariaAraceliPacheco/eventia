<?php

namespace App\Livewire\Artist;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Evento;
use App\Models\Artista;

class AreaArtista extends Component
{
    use WithFileUploads;

    public $searchEvent = '';
    public $user;
    public $artista;

    // Profile Edit Modal properties
    public $showProfileModal = false;
    public $nombre_artistico = '';
    public $editImgLogo;
    public $descripcion = '';
    public $tipo = 'solista';
    public $genero_musical = '';
    public $num_integrantes = 1;
    public $telefono = '';
    public $precio_referencia = '';
    public $equipo_propio = false;
    public $recibir_facturas = 'plataforma';

    public function editProfile()
    {
        if ($this->artista) {
            $this->nombre_artistico = $this->artista->nombre_artistico;
            $this->descripcion = $this->artista->descripcion;
            $this->tipo = $this->artista->tipo;
            $this->genero_musical = $this->artista->genero_musical;
            $this->num_integrantes = $this->artista->num_integrantes;
            $this->telefono = $this->artista->telefono;
            $this->precio_referencia = $this->artista->precio_referencia;
            $this->equipo_propio = $this->artista->equipo_propio;
            $this->recibir_facturas = $this->artista->recibir_facturas;
        }
        $this->showProfileModal = true;
    }

    public function saveProfile()
    {
        $validated = $this->validate([
            'nombre_artistico' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:' . implode(',', Artista::TIPO),
            'genero_musical' => 'required|in:' . implode(',', Artista::GENERO_MUSICAL),
            'num_integrantes' => 'required|integer|min:1',
            'telefono' => 'required|string',
            'precio_referencia' => 'required|string',
            'equipo_propio' => 'boolean',
            'recibir_facturas' => 'required|in:' . implode(',', Artista::RECIBIR_FACTURAS),
        ]);

        if ($this->editImgLogo) {
            $validated['img_logo'] = \App\Http\Controllers\ArtistaController::handleImageUpload($this->editImgLogo);
        }

        if ($this->artista) {
            $this->artista->update($validated);
            session()->flash('message', 'Perfil actualizado con éxito');
        }

        $this->showProfileModal = false;
        $this->editImgLogo = null;
    }

    public function cancelEdit()
    {
        $this->showProfileModal = false;
        $this->editImgLogo = null;
    }

    public function aceptarInvitacion($solicitudId)
    {
        $solicitud = \App\Models\Solicitud::where('id', $solicitudId)
            ->where('id_artista', $this->artista->id)
            ->where('origen', 'ayuntamiento')
            ->firstOrFail();

        $solicitud->update(['estado' => 'aceptada']);
        
        // Add artist to event
        $solicitud->evento->artistas()->syncWithoutDetaching([$this->artista->id]);

        $this->dispatch('notificar', [
            'titulo' => 'Invitación aceptada',
            'mensaje' => "Te has unido al evento: {$solicitud->evento->nombre_evento}",
            'tipo' => 'success'
        ]);
    }

    public function rechazarInvitacion($solicitudId)
    {
        $solicitud = \App\Models\Solicitud::where('id', $solicitudId)
            ->where('id_artista', $this->artista->id)
            ->where('origen', 'ayuntamiento')
            ->firstOrFail();

        $solicitud->update(['estado' => 'rechazada']);

        $this->dispatch('notificar', [
            'titulo' => 'Invitación rechazada',
            'mensaje' => "Has rechazado la invitación para: {$solicitud->evento->nombre_evento}",
            'tipo' => 'info'
        ]);
    }

    public function mount()
    {
        $this->user = auth()->user();
        if (!$this->user || !$this->user->perfilArtista) {
            return redirect()->route('role-selection');
        }
        $this->artista = $this->user->perfilArtista;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        // All events for the sidebar "Info Eventos"
        $eventos = Evento::query()
            ->when($this->searchEvent, function ($query) {
                $query->where('nombre_evento', 'like', '%' . $this->searchEvent . '%');
            })
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        // Only events where this artist participated for "Trabajos realizados"
        $misEventos = $this->artista->eventos()
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        // Invitations from town halls
        $invitaciones = \App\Models\Solicitud::where('id_artista', $this->artista->id)
            ->where('origen', 'ayuntamiento')
            ->where('estado', 'pendiente')
            ->with('evento.ayuntamiento')
            ->get();

        return view('livewire.artist.area-artista', [
            'eventos' => $eventos,
            'misEventos' => $misEventos,
            'invitaciones' => $invitaciones
        ]);
    }
}
