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
        // Base query for upcoming events
        $upcomingQuery = $this->ayuntamiento->eventos()->where('fecha_inicio', '>=', now()->startOfDay());

        // Base query for past events
        $pastQuery = $this->ayuntamiento->eventos()->where('fecha_inicio', '<', now()->startOfDay());

        // Visibility logic: Public users don't see ABIERTO events
        if (!auth()->check() || (auth()->user()->tipo_usuario !== 'artista' && auth()->user()->tipo_usuario !== 'ayuntamiento' && auth()->user()->tipo_usuario !== 'admin')) {
            $upcomingQuery->where('estado', '!=', 'ABIERTO');
            $pastQuery->where('estado', '!=', 'ABIERTO');
        }

        // If filtering specifically for artists (optional)
        if (auth()->check() && auth()->user()->tipo_usuario === 'artista' && request()->has('only_open')) {
            $upcomingQuery->where('estado', 'ABIERTO');
            // Past events usually are not 'ABIERTO', but keeping it for consistency if needed
        }

        $proximosEventos = $upcomingQuery->orderBy('fecha_inicio', 'asc')->get();
        $eventosPasados = $pastQuery->orderBy('fecha_inicio', 'desc')->get();

        return view('livewire.public.town-hall-profile', [
            'proximosEventos' => $proximosEventos,
            'eventosPasados' => $eventosPasados
        ]);
    }
}
