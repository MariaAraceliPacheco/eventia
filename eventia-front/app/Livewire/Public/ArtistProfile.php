<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Artista;

class ArtistProfile extends Component
{
    public $artistId;
    public $artist;

    public function mount($id)
    {
        $this->artistId = $id;
        
        $this->artist = Artista::with(['eventos' => function($query) {
            // Visibility logic: Public users don't see ABIERTO events
            if (!auth()->check() || (auth()->user()->tipo_usuario !== 'artista' && auth()->user()->tipo_usuario !== 'ayuntamiento' && auth()->user()->tipo_usuario !== 'admin')) {
                $query->where('estado', '!=', 'ABIERTO');
            }
            $query->orderBy('fecha_inicio', 'desc');
        }])->findOrFail($id);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.artist-profile');
    }
}
