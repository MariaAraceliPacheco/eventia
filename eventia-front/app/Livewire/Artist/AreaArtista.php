<?php

namespace App\Livewire\Artist;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AreaArtista extends Component
{
    public $searchEvent = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.artist.area-artista');
    }
}
