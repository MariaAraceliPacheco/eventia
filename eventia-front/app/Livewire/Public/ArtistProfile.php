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
        // In a real app we would fetch by ID, but since TownHallProfile uses hardcoded data for now,
        // and ArtistList also uses a static array, I'll mock some data or try to get it if available.
        // For consistency with TownHallProfile, I'll use the ID to show something.
        $this->artist = Artista::find($id) ?? (object)[
            'nombre_artistico' => 'Artista Ejemplo',
            'genero_musical' => 'Rock / Pop',
            'tipo' => 'Grupo',
            'descripcion' => 'Bienvenidos al perfil oficial de Artista Ejemplo. Una banda con trayectoria internacional que fusiona sonidos clásicos con toques modernos, creando una experiencia sonora inigualable para todo tipo de eventos.',
            'precio_referencia' => '1.200€',
            'img_logo' => null,
            'color' => 'secondary'
        ];
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.artist-profile');
    }
}
