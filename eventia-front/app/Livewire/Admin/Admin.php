<?php

namespace App\Livewire\Admin;

use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Evento;
use App\Models\Publico;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class Admin extends Component
{
    use WithFileUploads;
    public $searchEvent = '';
    public $user;

    public $artistas = [];
    public $ayuntamientos = [];
    public $publicos = [];
    public $eventos = [];

    // Edit Artista properties
    public $showEditArtistaModal = false;
    public $editingArtistaId = null;
    public $editNombreArtistico = '';
    public $editTipo = '';
    public $editGeneroMusical = '';
    public $editDescripcion = '';
    public $editTelefono = '';
    public $editPrecioReferencia = '';
    public $editEquipoPropio = false;
    public $editRecibirFacturas = '';
    public $editImgLogoArtista = null;

    // Edit Publico properties
    public $showEditPublicoModal = false;
    public $editingPublicoId = null;
    public $editNombre = '';
    public $editEmail = '';
    public $editComunidad = '';
    public $editProvincia = '';
    public $editLocalidad = '';
    public $editGustos = [];
    public $editFavoritos = [];
    public $editNotificaciones = false;


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

    public function deletePublico($id)
    {
        $publico = Publico::destroy($id);
        $this->publicos = Publico::all();
        session()->flash('message', 'Publico eliminado correctamente.');
    }

    public function deleteArtista($id)
    {
        $artista = Artista::destroy($id);
        $this->artistas = Artista::with('usuario')->get();
        session()->flash('message', 'Artista eliminado correctamente.');
    }

    public function editArtista($id)
    {
        $artista = Artista::findOrFail($id);
        $this->editingArtistaId = $id;
        $this->editNombreArtistico = $artista->nombre_artistico;
        $this->editTipo = $artista->tipo;
        $this->editGeneroMusical = $artista->genero_musical;
        $this->editDescripcion = $artista->descripcion;
        $this->editTelefono = $artista->telefono;
        $this->editPrecioReferencia = $artista->precio_referencia;
        $this->editEquipoPropio = (bool) $artista->equipo_propio;
        $this->editRecibirFacturas = $artista->recibir_facturas;
        $this->editImgLogoArtista = null;
        $this->showEditArtistaModal = true;
    }

    public function updateArtista()
    {
        $this->validate([
            'editNombreArtistico' => 'required|string|max:255',
            'editTipo' => 'required|string',
            'editGeneroMusical' => 'required|string',
            'editDescripcion' => 'nullable|string',
            'editTelefono' => 'nullable|string|max:20',
            'editPrecioReferencia' => 'nullable|string|max:100',
            'editImgLogoArtista' => 'nullable|image|max:2048',
        ]);

        $artista = Artista::findOrFail($this->editingArtistaId);

        $data = [
            'nombre_artistico' => $this->editNombreArtistico,
            'tipo' => $this->editTipo,
            'genero_musical' => $this->editGeneroMusical,
            'descripcion' => $this->editDescripcion,
            'telefono' => $this->editTelefono,
            'precio_referencia' => $this->editPrecioReferencia,
            'equipo_propio' => $this->editEquipoPropio,
            'recibir_facturas' => $this->editRecibirFacturas,
        ];

        if ($this->editImgLogoArtista) {
            $path = $this->editImgLogoArtista->store('profiles/artistas', 'public');
            $data['img_logo'] = $path;
        }

        $artista->update($data);

        $this->artistas = Artista::with('usuario')->get();
        $this->showEditArtistaModal = false;
        $this->editingArtistaId = null;
        session()->flash('message', 'Artista actualizado correctamente.');
    }

    public function cancelEditArtista()
    {
        $this->showEditArtistaModal = false;
        $this->editingArtistaId = null;
        $this->editImgLogoArtista = null;
    }

    public function deleteAyuntamiento($id)
    {
        $ayuntamiento = Ayuntamiento::destroy($id);
        $this->ayuntamientos = Ayuntamiento::all();
        session()->flash('message', 'Ayuntamiento eliminado correctamente.');
    }

    public function editPublico($id)
    {
        $publico = Publico::with('usuario')->findOrFail($id);
        $this->editingPublicoId = $id;
        $this->editNombre = $publico->usuario->nombre;
        $this->editEmail = $publico->usuario->email;
        $this->editComunidad = $publico->comunidad_autonoma;
        $this->editProvincia = $publico->provincia;
        $this->editLocalidad = $publico->localidad;

        // Handle gustos and favoritos as arrays (conversion if they are stored as strings)
        $this->editGustos = is_string($publico->gustos_musicales) ? explode(',', $publico->gustos_musicales) : (is_array($publico->gustos_musicales) ? $publico->gustos_musicales : []);
        $this->editFavoritos = is_string($publico->tipo_eventos_favoritos) ? explode(',', $publico->tipo_eventos_favoritos) : (is_array($publico->tipo_eventos_favoritos) ? $publico->tipo_eventos_favoritos : []);

        $this->editNotificaciones = $publico->notificaciones;
        $this->showEditPublicoModal = true;
    }

    public function updatePublico()
    {
        $this->validate([
            'editNombre' => 'required|string|max:255',
            'editEmail' => 'required|email|max:255',
            'editComunidad' => 'required|string',
            'editProvincia' => 'required|string',
            'editLocalidad' => 'required|string',
        ]);

        $publico = Publico::findOrFail($this->editingPublicoId);
        $user = $publico->usuario;

        $user->update([
            'nombre' => $this->editNombre,
            'email' => $this->editEmail,
        ]);

        $publico->update([
            'comunidad_autonoma' => $this->editComunidad,
            'provincia' => $this->editProvincia,
            'localidad' => $this->editLocalidad,
            'gustos_musicales' => is_array($this->editGustos) ? implode(',', $this->editGustos) : $this->editGustos,
            'tipo_eventos_favoritos' => is_array($this->editFavoritos) ? implode(',', $this->editFavoritos) : $this->editFavoritos,
            'notificaciones' => $this->editNotificaciones,
        ]);

        $this->mount(); // Refresh data
        $this->showEditPublicoModal = false;
        session()->flash('message', 'Público actualizado correctamente.');
    }

    public function cancelEditPublico()
    {
        $this->showEditPublicoModal = false;
        $this->editingPublicoId = null;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('admin.vistaAdmin', [
            'artistas' => $this->artistas,
            'ayuntamientos' => $this->ayuntamientos,
            'publicos' => $this->publicos,
            'eventos' => $this->eventos,
            'allGustos' => Publico::GUSTOS_MUSICALES,
            'allFavoritos' => Publico::TIPO_EVENTOS_FAVORITOS,
        ]);
    }

}
