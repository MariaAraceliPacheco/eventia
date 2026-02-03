<?php

namespace App\Livewire\Artist;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AreaArtista extends Component
{
    public $searchEvent = '';
public $user;

public $artista;

//esta funcion sirve para obtener el usuario y el artista
public function mount() {
    $this->user = auth()->user();
    $this->artista = $this->user->perfilArtista;
}
    

    #[Layout('components.layouts.app')]
    public function render()
    { 
        return view('livewire.artist.area-artista');
    }
}
