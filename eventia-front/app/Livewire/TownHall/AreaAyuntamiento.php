<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AreaAyuntamiento extends Component
{
    public $searchArtist = '';
    
    public $user;
    public $ayuntamiento;

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
}
