<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Barryvdh\DomPDF\Facade\Pdf;

class AreaPublico extends Component
{
    public $searchEvent = '';
    public $selectedTickets = [];

    // Profile Edit Modal properties
    public $showProfileModal = false;
    public $gustos_musicales = '';
    public $tipo_eventos_favoritos = '';
    public $comunidad_autonoma = '';
    public $provincia = '';
    public $localidad = '';
    public $notificaciones = false;
    public $nombre = '';

    public $user;
    public $publico;

    public $regions_data = [
        'Andalucía' => ['Almería', 'Cádiz', 'Córdoba', 'Granada', 'Huelva', 'Jaén', 'Málaga', 'Sevilla'],
        'Aragón' => ['Huesca', 'Teruel', 'Zaragoza'],
        'Asturias' => ['Asturias'],
        'Baleares' => ['Islas Baleares'],
        'Canarias' => ['Las Palmas', 'Santa Cruz de Tenerife'],
        'Cantabria' => ['Cantabria'],
        'Castilla y León' => ['Ávila', 'Burgos', 'León', 'Palencia', 'Salamanca', 'Segovia', 'Soria', 'Valladolid', 'Zamora'],
        'Castilla-La Mancha' => ['Albacete', 'Ciudad Real', 'Cuenca', 'Guadalajara', 'Toledo'],
        'Cataluña' => ['Barcelona', 'Girona', 'Lleida', 'Tarragona'],
        'Comunidad Valenciana' => ['Alicante', 'Castellón', 'Valencia'],
        'Extremadura' => ['Badajoz', 'Cáceres'],
        'Galicia' => ['A Coruña', 'Lugo', 'Ourense', 'Pontevedra'],
        'Madrid' => ['Madrid'],
        'Murcia' => ['Murcia'],
        'Navarra' => ['Navarra'],
        'País Vasco' => ['Álava', 'Bizkaia', 'Gipuzkoa'],
        'La Rioja' => ['La Rioja'],
        'Ceuta' => ['Ceuta'],
        'Melilla' => ['Melilla'],
    ];

    public function mount($id = null)
    {
        $authUser = auth()->user();

        if ($id && $authUser->tipo_usuario === 'admin') {
            $this->publico = \App\Models\Publico::with('usuario')->findOrFail($id);
            $this->user = $this->publico->usuario;
        } else {
            $this->user = $authUser;
            $this->publico = $this->user->perfilPublico;
        }
    }

    public function editProfile()
    {
        if ($this->publico) {
            $this->gustos_musicales = $this->publico->gustos_musicales;
            $this->tipo_eventos_favoritos = $this->publico->tipo_eventos_favoritos;
            $this->comunidad_autonoma = $this->publico->comunidad_autonoma;
            $this->provincia = $this->publico->provincia;
            $this->localidad = $this->publico->localidad;
            $this->notificaciones = $this->publico->notificaciones;
        }

        if ($this->user) {
            $this->nombre = $this->user->nombre;
        }
        $this->showProfileModal = true;
    }

    public function saveProfile()
    {
        $validated = $this->validate([
            'comunidad_autonoma' => 'required|string',
            'provincia' => 'required|string',
            'localidad' => 'required|string',
            'gustos_musicales' => 'required|string',
            'tipo_eventos_favoritos' => 'required|string',
            'notificaciones' => 'boolean',
            'nombre' => 'required|string|max:255',
        ]);

        try {
            if ($this->user) {
                $this->user->update(['nombre' => $this->nombre]);
            }

            if ($this->publico) {
                $this->publico->update($validated);
            }

            $this->dispatch('notificar', [
                'titulo' => '¡Perfil Actualizado!',
                'mensaje' => 'Tus cambios se han guardado correctamente.',
                'tipo' => 'success'
            ]);

            $this->showProfileModal = false;
        } catch (\Exception $e) {
            $this->dispatch('notificar', [
                'titulo' => 'Error al guardar',
                'mensaje' => 'No se pudieron guardar los cambios. Por favor, inténtalo de nuevo.',
                'tipo' => 'error'
            ]);
        }
    }

    public function cancelEdit()
    {
        $this->showProfileModal = false;
    }

    public function getProvincesProperty()
    {
        if ($this->comunidad_autonoma) {
            return $this->regions_data[$this->comunidad_autonoma] ?? [];
        }

        $all = [];
        foreach ($this->regions_data as $provinces) {
            $all = array_merge($all, $provinces);
        }
        sort($all);
        return $all;
    }

    public function updatedProvincia()
    {
        if ($this->provincia) {
            foreach ($this->regions_data as $region => $provinces) {
                if (in_array($this->provincia, $provinces)) {
                    $this->comunidad_autonoma = $region;
                    break;
                }
            }
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $query = \App\Models\Evento::query();

        if ($this->searchEvent) {
            $query->where('nombre_evento', 'like', '%' . $this->searchEvent . '%');
        }

        // Filtering: Only show CERRADO, FINALIZADO or SOLD OUT events
        $query->where(function ($q) {
            $q->whereIn('estado', ['CERRADO', 'FINALIZADO'])
                ->orWhere(function ($sq) {
                    $sq->where('estado', 'ABIERTO')
                        ->whereNotNull('entradas_maximas')
                        ->whereColumn('entradas_vendidas', '>=', 'entradas_maximas');
                });
        });

        $events = $query->orderBy('fecha_inicio', 'desc')->take(10)->get();

        // Fetch purchased tickets for the current user
        $purchasedTickets = [];
        $upcomingEvents = [];
        if (auth()->check()) {
            $purchasedTickets = \App\Models\Entrada::with('evento')
                ->where('id_usuario', auth()->id())
                ->orderBy('fecha_compra', 'desc')
                ->get();

            // Upcoming Events Logic (only if notifications are enabled)
            if ($this->publico && $this->publico->notificaciones) {
                $upcomingEvents = \App\Models\Entrada::with('evento')
                    ->where('id_usuario', auth()->id())
                    ->whereHas('evento', function ($q) {
                        $q->where('fecha_inicio', '>=', now())
                            ->where('fecha_inicio', '<=', now()->addDays(7));
                    })
                    ->get()
                    ->pluck('evento')
                    ->unique('id');
            }
        }

        // Fetch real items "in cart" (selected tickets)
        $cartItems = [];
        if (!empty($this->selectedTickets)) {
            $cartItems = \App\Models\Evento::whereIn('id', $this->selectedTickets)->get();
        }

        return view('livewire.public.area-publico', [
            'events' => $events,
            'purchasedTickets' => $purchasedTickets,
            'upcomingEvents' => $upcomingEvents,
            'cartItems' => $cartItems
        ]);
    }

    public function toggleSelection($eventId)
    {
        if (in_array($eventId, $this->selectedTickets)) {
            $this->selectedTickets = array_diff($this->selectedTickets, [$eventId]);
        } else {
            $this->selectedTickets[] = $eventId;
        }
    }

    public function goToPurchase()
    {
        if (count($this->selectedTickets) > 0) {
            // Redirect to the first selected event for now
            return redirect()->route('public.buy-ticket', ['eventId' => $this->selectedTickets[0]]);
        }
    }

    public function downloadTicket($ticketId)
    {
        $ticket = \App\Models\Entrada::with('evento')->findOrFail($ticketId);

        // Security check
        if ($ticket->id_usuario !== auth()->id()) {
            session()->flash('error', 'No tienes permiso para descargar esta entrada.');
            return;
        }

        Pdf::setOption(['isRemoteEnabled' => true]);
        $pdf = Pdf::loadView('pdf.ticket', ['ticket' => $ticket]);

        // Use stream or download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Entrada-' . $ticket->evento->nombre_evento . '.pdf');
    }
}
