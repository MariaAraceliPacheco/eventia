<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Evento;

class EventDetail extends Component
{
    public $evento;
    
    public function mount($id)
    {
        $this->evento = Evento::with('ayuntamiento')->findOrFail($id);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.event-detail');
    }
}
