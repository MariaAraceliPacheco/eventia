<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\Attributes\Layout;

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
        $this->ayuntamiento = $this->user->perfilAyuntamiento;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.town-hall.area-ayuntamiento');
    }

    public function createEvent()
    {
        return redirect()->route('town-hall.create-event');
    }
    
    public function editEvent($eventId, $name, $date, $location)
    {
        $this->editingEventId = $eventId;
        $this->editEventName = $name;
        $this->editEventDate = $date;
        $this->editEventLocation = $location;
        $this->editEventDescription = 'Descripción del evento'; // This would come from database
        $this->showEditModal = true;
    }
    
    public function saveEvent()
    {
        // Here you would save the edited event to the database
        // For now, just close the modal
        $this->showEditModal = false;
        session()->flash('message', 'Evento actualizado correctamente');
    }
    
    public function cancelEdit()
    {
        $this->showEditModal = false;
        $this->resetEditForm();
    }
    
    public function deleteEvent($eventId)
    {
        // Here you would delete the event from the database
        session()->flash('message', 'Evento eliminado correctamente');
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
