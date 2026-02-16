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
        $query = $this->ayuntamiento->eventos();

        // If the logged-in user is an artist, show only open events
        if (auth()->check() && auth()->user()->tipo_usuario === 'artista') {
            $query->where('estado', 'abierto');
        }

        $eventos = $query->orderBy('fecha_inicio', 'desc')->get();
        
        return view('livewire.public.town-hall-profile', [
            'eventos' => $eventos
        ]);
    }
}
