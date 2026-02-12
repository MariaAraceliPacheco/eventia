<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Evento;
use App\Models\Artista;

class AreaAyuntamiento extends Component
{
    public $searchArtist = '';
    
    public $user;
    public $ayuntamiento;
    
    // Edit modal properties
    public $showEditModal = false;
    public $editingEventId = null;
    public $editEventName = '';
    public $editEventDate = '';
    public $editEventLocation = '';
    public $editEventDescription = '';

    public function mount() {
        $this->user = auth()->user();
        if (!$this->user || !$this->user->perfilAyuntamiento) {
            return redirect()->route('role-selection');
        }
        $this->ayuntamiento = $this->user->perfilAyuntamiento;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $eventos = $this->ayuntamiento->eventos()->orderBy('fecha_inicio', 'desc')->get();

        $artistas = Artista::query()
            ->when($this->searchArtist, function($query) {
                $query->where('nombre_artistico', 'like', '%' . $this->searchArtist . '%');
            })
            ->get();

        return view('livewire.town-hall.area-ayuntamiento', [
            'eventos' => $eventos,
            'artistas' => $artistas
        ]);
    }

    public function createEvent()
    {
        return redirect()->route('town-hall.create-event');
    }
    
    public function editEvent($eventId)
    {
        $evento = Evento::find($eventId);
        if ($evento) {
            $this->editingEventId = $evento->id;
            $this->editEventName = $evento->nombre_evento;
            $this->editEventDate = $evento->fecha_inicio->format('Y-m-d');
            $this->editEventLocation = $evento->localidad; // Mapping localidad to location input
            $this->editEventDescription = $evento->descripcion;
            $this->showEditModal = true;
        }
    }
    
    public function saveEvent()
    {
        $this->validate([
            'editEventName' => 'required',
            'editEventDate' => 'required|date',
            'editEventLocation' => 'required',
        ]);

        if ($this->editingEventId) {
            $evento = Evento::find($this->editingEventId);
            if ($evento) {
                $evento->update([
                    'nombre_evento' => $this->editEventName,
                    'fecha_inicio' => $this->editEventDate,
                    'localidad' => $this->editEventLocation,
                    'descripcion' => $this->editEventDescription,
                ]);
                session()->flash('message', 'Evento actualizado correctamente');
            }
        }

        $this->showEditModal = false;
        $this->resetEditForm();
    }
    
    public function cancelEdit()
    {
        $this->showEditModal = false;
        $this->resetEditForm();
    }
    
    public function deleteEvent($eventId)
    {
        $evento = Evento::find($eventId);
        if ($evento) {
            $evento->delete();
            session()->flash('message', 'Evento eliminado correctamente');
        }
    }
    
    private function resetEditForm()
    {
        $this->editingEventId = null;
        $this->editEventName = '';
        $this->editEventDate = '';
        $this->editEventLocation = '';
        $this->editEventDescription = '';
    }
}
