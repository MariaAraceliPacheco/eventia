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
        // Fetch artist with their events relationship
        $this->artist = Artista::with('eventos')->findOrFail($id);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.artist-profile');
    }
}
