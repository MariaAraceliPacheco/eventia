<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class EventDetail extends Component
{
    public $eventId;
    public $eventName = 'Summer Indie Festival 2026';
    
    public function mount($id)
    {
        $this->eventId = $id;
        // In a real app, fetch event details by ID
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.event-detail');
    }
}
