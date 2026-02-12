<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Ayuntamiento;

class TownHallProfile extends Component
{
    public $ayuntamiento;
    
    public function mount($id)
    {
        $this->ayuntamiento = Ayuntamiento::with('eventos')->findOrFail($id);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $eventos = $this->ayuntamiento->eventos()->orderBy('fecha_inicio', 'desc')->get();
        
        return view('livewire.public.town-hall-profile', [
            'eventos' => $eventos
        ]);
    }
}
