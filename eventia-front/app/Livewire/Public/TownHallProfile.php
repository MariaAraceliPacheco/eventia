<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class TownHallProfile extends Component
{
    public $townHallId;
    public $name = 'Ayuntamiento de Ejemplo';
    
    public function mount($id)
    {
        $this->townHallId = $id;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.town-hall-profile');
    }
}
