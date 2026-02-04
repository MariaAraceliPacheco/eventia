<?php

namespace App\Livewire\Admin;

use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Publico;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Admin extends Component
{
    public $searchEvent = '';
    public $user;

    public $artistas = [];
    public $ayuntamientos = [];
    public $publicos = [];


    //esta funcion sirve para obtener el usuario y el artista
    public function mount()
    {
        $this->user = auth()->user();
        $this->artistas = Artista::all();
        $this->ayuntamientos = Ayuntamiento::all();
        $this->publicos = Publico::all();
    }


    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('admin.vistaAdmin', [
            'artistas' => $this->artistas,
            'ayuntamientos' => $this->ayuntamientos,
            'publicos' => $this->publicos,
        ]);
    }
}
