<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

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
        ]);

        if ($this->publico) {
            $this->publico->update($validated);
            session()->flash('message', 'Perfil actualizado con éxito');
        }

        $this->showProfileModal = false;
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

        // Visibility logic: Public users don't see ABIERTO events
        $query->where('estado', '!=', 'ABIERTO');

        $events = $query->orderBy('fecha_inicio', 'desc')->take(10)->get();

        return view('livewire.public.area-publico', [
            'events' => $events
        ]);
    }

    public function toggleSelection($ticketId)
    {
        if (in_array($ticketId, $this->selectedTickets)) {
            $this->selectedTickets = array_diff($this->selectedTickets, [$ticketId]);
        } else {
            $this->selectedTickets[] = $ticketId;
        }
    }

    public function goToPurchase()
    {
        if (count($this->selectedTickets) > 0) {
            // In a real app, we'd pass the actual IDs or save selection to session
            return redirect()->route('public.buy-ticket');
        }
    }
}
