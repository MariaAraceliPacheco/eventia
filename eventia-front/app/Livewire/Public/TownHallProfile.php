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
        
        // Visibility logic: Public users don't see ABIERTO events
        if (!auth()->check() || (auth()->user()->tipo_usuario !== 'artista' && auth()->user()->tipo_usuario !== 'ayuntamiento' && auth()->user()->tipo_usuario !== 'admin')) {
            $query->where('estado', '!=', 'ABIERTO');
        }

        // If filtering specifically for artists (optional: they might only care about open ones)
        if (auth()->check() && auth()->user()->tipo_usuario === 'artista' && request()->has('only_open')) {
            $query->where('estado', 'ABIERTO');
        }

        $eventos = $query->orderBy('fecha_inicio', 'desc')->get();
        
        return view('livewire.public.town-hall-profile', [
            'eventos' => $eventos
        ]);
    }
}
