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

    // Propiedades para la edición de eventos
    public $showModal = false;
    public $editingEventId;
    public $nombre_evento;
    public $descripcion;
    public $fecha_inicio;
    public $localidad;
    public $provincia;
    public $precio;

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
        $evento = Evento::find($id);
        if ($evento) {
            $this->editingEventId = $evento->id;
            $this->nombre_evento = $evento->nombre_evento;
            $this->descripcion = $evento->descripcion;
            // Aseguramos que la fecha tenga formato Y-m-d para inputs tipo date
            $this->fecha_inicio = $evento->fecha_inicio ? \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d') : null;
            $this->localidad = $evento->localidad;
            $this->provincia = $evento->provincia;
            $this->precio = $evento->precio;

            $this->showModal = true;
        }
    }

    public function updateEvent()
    {
        $this->validate([
            'nombre_evento' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'localidad' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);

        $evento = Evento::find($this->editingEventId);
        if ($evento) {
            $evento->update([
                'nombre_evento' => $this->nombre_evento,
                'descripcion' => $this->descripcion,
                'fecha_inicio' => $this->fecha_inicio,
                'localidad' => $this->localidad,
                'provincia' => $this->provincia,
                'precio' => $this->precio,
            ]);

            // Recargar la lista de eventos para reflejar cambios
            $this->eventos = Evento::all();

            $this->closeModal();
            session()->flash('message', 'Evento actualizado correctamente.');
        }
    }

    public function deleteEvent($id) {
        $evento = Evento::destroy($id);
        $this->eventos = Evento::all();
         session()->flash('message', 'Evento eliminado correctamente.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['editingEventId', 'nombre_evento', 'descripcion', 'fecha_inicio', 'localidad', 'provincia', 'precio']);
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
