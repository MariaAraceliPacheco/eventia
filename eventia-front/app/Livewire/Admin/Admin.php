<?php

namespace App\Livewire\Admin;

use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Evento;
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
    public $eventos = [];


    //esta funcion sirve para obtener el usuario y el artista
    public function mount()
    {
        $this->user = auth()->user();

        //se les pone el with para que a parte del artista, tambien devuelva su usuario al que hace referencia.
        //Asi se obtendria el objeto entero por decirlo de alguna forma
        $this->artistas = Artista::with('usuario')->get();
        $this->ayuntamientos = Ayuntamiento::with('usuario')->get();
        $this->publicos = Publico::with('usuario')->get();
        $this->eventos = Evento::all();
    }

    public function editEvent($id)
    {
        return redirect()->route('town-hall.edit-event', ['id' => $id]);
    }

    public function deleteEvent($id)
    {
        $evento = Evento::destroy($id);
        $this->eventos = Evento::all();
        session()->flash('message', 'Evento eliminado correctamente.');
    }

    public function deletePublico($id) {
        $publico = Publico::destroy($id);
        $this->publicos = Publico::all();
        session()->flash('message', 'Publico eliminado correctamente.');
    }

    public function deleteArtista($id) {
        $artista = Artista::destroy($id);
        $this->artistas = Artista::all();
        session()->flash('message', 'Artista eliminado correctamente.');
    }

    public function deleteAyuntamiento($id) {
        $ayuntamiento = Ayuntamiento::destroy($id);
        $this->ayuntamientos = Ayuntamiento::all();
        session()->flash('message', 'Ayuntamiento eliminado correctamente.');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('admin.vistaAdmin', [
            'artistas' => $this->artistas,
            'ayuntamientos' => $this->ayuntamientos,
            'publicos' => $this->publicos,
            'eventos' => $this->eventos,
        ]);
    }

}
