<?php

namespace App\Livewire\Admin;

use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Evento;
use App\Models\Publico;
use App\Models\Carrito;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $searchArtista = '';
    public $searchAyuntamiento = '';
    public $searchPublico = '';
    public $searchEvento = '';
    public $user;

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

    // Edit Ayuntamientos properties
    public $showEditAyuntamientoModal = false;
    public $editingAyuntamientoId = null;
    public $editNombreInstitucion = '';
    public $editAyuntamientoImagen = null;
    public $editAyuntamientoTelefono = '';
    public $editAyuntamientoComunidad = '';
    public $editAyuntamientoProvincia = '';
    public $editAyuntamientoLocalidad = '';
    public $editTipoEvento = '';
    public $editFrecuencia = '';
    public $editTipoEspacio = '';
    public $editOpcionesAccesibilidad = '';
    public $editTipoFacturacion = 'plataforma';
    public $editLogisticaPropia = '';

    public $regions_data = [
        'Andalucía' => ['Almería', 'Cádiz', 'Córdoba', 'Granada', 'Huelva', 'Jaén', 'Málaga', 'Sevilla'],
        'Aragón' => ['Huesca', 'Teruel', 'Zaragoza'],
        'Asturias' => ['Asturias'],
        'Baleares' => ['Islas Baleares'],
        'Canarias' => ['Las Palmas', 'Santa Cruz de Tenerife'],
        'Cantabria' => ['Cantabria'],
        'Castilla y León' => ['Ávila', 'Burgos', 'León', 'Palencia', 'Salamanca', 'Segovia', 'Soria', 'Valladolid', 'Zamora'],
        'Castilla-La Mancha' => ['Albacete', 'Ciudad Real', 'Cuenca', 'Guadalajara', 'Toledo'],
        'Cataluña' => ['Barcelona', 'Girona', 'Lleida', 'Tarragona'],
        'Comunidad Valenciana' => ['Alicante', 'Castellón', 'Valencia'],
        'Extremadura' => ['Badajoz', 'Cáceres'],
        'Galicia' => ['A Coruña', 'Lugo', 'Ourense', 'Pontevedra'],
        'Madrid' => ['Madrid'],
        'Murcia' => ['Murcia'],
        'Navarra' => ['Navarra'],
        'País Vasco' => ['Álava', 'Bizkaia', 'Gipuzkoa'],
        'La Rioja' => ['La Rioja'],
        'Ceuta' => ['Ceuta'],
        'Melilla' => ['Melilla'],
    ];

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

    // Delete Confirmation properties
    public $showDeleteConfirmation = false;
    public $itemToDeleteId = null;
    public $itemToDeleteType = null;


    //esta funcion sirve para obtener el usuario y el artista
    public function mount()
    {
        $this->user = auth()->user();
    }

    public function editEvent($id)
    {
        return redirect()->route('town-hall.edit-event', ['id' => $id]);
    }

    public function confirmDelete($id, $type)
    {
        $this->itemToDeleteId = $id;
        $this->itemToDeleteType = $type;
        $this->showDeleteConfirmation = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirmation = false;
        $this->itemToDeleteId = null;
        $this->itemToDeleteType = null;
    }

    public function deleteEvent()
    {
        $evento = Evento::find($this->itemToDeleteId);

        if (!$evento) {
            $this->cancelDelete();
            return;
        }

        // Check if there are purchased tickets
        if ($evento->entradas()->count() > 0) {
            $this->dispatch('notificar', [
                'titulo' => 'Acción bloqueada',
                'mensaje' => 'No se puede eliminar el evento porque ya hay usuarios con entradas compradas.',
                'tipo' => 'error'
            ]);
            $this->cancelDelete();
            return;
        }

        // Check if there are items in carritos
        if (Carrito::where('id_evento', $this->itemToDeleteId)->count() > 0) {
            $this->dispatch('notificar', [
                'titulo' => 'Acción bloqueada',
                'mensaje' => 'No se puede eliminar el evento porque hay usuarios con este evento en su carrito.',
                'tipo' => 'error'
            ]);
            $this->cancelDelete();
            return;
        }

        $evento->delete();
        $this->cancelDelete();

        $this->dispatch('notificar', [
            'titulo' => '¡Evento Eliminado!',
            'mensaje' => 'El evento ha sido eliminado permanentemente del sistema.',
            'tipo' => 'success'
        ]);
    }

    public function deletePublico()
    {
        Publico::destroy($this->itemToDeleteId);
        $this->cancelDelete();

        $this->dispatch('notificar', [
            'titulo' => '¡Usuario Eliminado!',
            'mensaje' => 'El perfil de usuario público ha sido eliminado correctamente.',
            'tipo' => 'success'
        ]);
    }

    public function deleteArtista()
    {
        Artista::destroy($this->itemToDeleteId);
        $this->cancelDelete();

        $this->dispatch('notificar', [
            'titulo' => '¡Artista Eliminado!',
            'mensaje' => 'El perfil del artista ha sido eliminado del sistema.',
            'tipo' => 'success'
        ]);
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
            'editImgLogoArtista' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
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
            $data['img_logo'] = \App\Http\Controllers\ArtistaController::handleImageUpload($this->editImgLogoArtista);
        }

        $artista->update($data);

        $this->showEditArtistaModal = false;
        $this->editingArtistaId = null;

        $this->dispatch('notificar', [
            'titulo' => '¡Artista Actualizado!',
            'mensaje' => 'Los cambios en el perfil del artista se han guardado correctamente.',
            'tipo' => 'success'
        ]);
    }

    public function cancelEditArtista()
    {
        $this->showEditArtistaModal = false;
        $this->editingArtistaId = null;
        $this->editImgLogoArtista = null;
    }

    public function editAyuntamiento($id)
    {
        $ayuntamiento = Ayuntamiento::findOrFail($id);
        $this->editingAyuntamientoId = $id;
        $this->editNombreInstitucion = $ayuntamiento->nombre_institucion;
        $this->editAyuntamientoTelefono = $ayuntamiento->telefono;
        $this->editAyuntamientoComunidad = $ayuntamiento->comunidad_autonoma;
        $this->editAyuntamientoProvincia = $ayuntamiento->provincia;
        $this->editAyuntamientoLocalidad = $ayuntamiento->localidad;
        $this->editTipoEvento = $ayuntamiento->tipo_evento;
        $this->editFrecuencia = $ayuntamiento->frecuencia;
        $this->editTipoEspacio = $ayuntamiento->tipo_espacio;
        $this->editOpcionesAccesibilidad = $ayuntamiento->opciones_accesibilidad;
        $this->editTipoFacturacion = $ayuntamiento->tipo_facturacion;
        $this->editLogisticaPropia = $ayuntamiento->logistica_propia;
        $this->editAyuntamientoImagen = null;
        $this->showEditAyuntamientoModal = true;
    }

    public function updateAyuntamiento()
    {
        $this->validate([
            'editNombreInstitucion' => 'required|string',
            'editAyuntamientoTelefono' => 'required|string',
            'editAyuntamientoComunidad' => 'required|string',
            'editAyuntamientoProvincia' => 'required|string',
            'editAyuntamientoLocalidad' => 'required|string',
            'editTipoEvento' => 'required|string',
            'editFrecuencia' => 'required|string',
            'editTipoEspacio' => 'required|string',
            'editAyuntamientoImagen' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ]);

        $ayuntamiento = Ayuntamiento::findOrFail($this->editingAyuntamientoId);

        $data = [
            'nombre_institucion' => $this->editNombreInstitucion,
            'telefono' => $this->editAyuntamientoTelefono,
            'comunidad_autonoma' => $this->editAyuntamientoComunidad,
            'provincia' => $this->editAyuntamientoProvincia,
            'localidad' => $this->editAyuntamientoLocalidad,
            'tipo_evento' => $this->editTipoEvento,
            'frecuencia' => $this->editFrecuencia,
            'tipo_espacio' => $this->editTipoEspacio,
            'opciones_accesibilidad' => $this->editOpcionesAccesibilidad,
            'tipo_facturacion' => $this->editTipoFacturacion,
            'logistica_propia' => $this->editLogisticaPropia,
        ];

        if ($this->editAyuntamientoImagen) {
            $data['imagen'] = \App\Http\Controllers\AyuntamientoController::handleImageUpload($this->editAyuntamientoImagen);
        }

        $ayuntamiento->update($data);

        $this->showEditAyuntamientoModal = false;
        $this->editingAyuntamientoId = null;

        $this->dispatch('notificar', [
            'titulo' => '¡Ayuntamiento Actualizado!',
            'mensaje' => 'Los datos de la institución se han actualizado correctamente.',
            'tipo' => 'success'
        ]);
    }

    public function cancelEditAyuntamiento()
    {
        $this->showEditAyuntamientoModal = false;
        $this->editingAyuntamientoId = null;
        $this->editAyuntamientoImagen = null;
    }

    public function getProvincesProperty()
    {
        if ($this->editAyuntamientoComunidad) {
            return $this->regions_data[$this->editAyuntamientoComunidad] ?? [];
        }

        $all = [];
        foreach ($this->regions_data as $provinces) {
            $all = array_merge($all, $provinces);
        }
        sort($all);
        return $all;
    }

    public function updatedEditAyuntamientoProvincia()
    {
        if ($this->editAyuntamientoProvincia) {
            foreach ($this->regions_data as $region => $provinces) {
                if (in_array($this->editAyuntamientoProvincia, $provinces)) {
                    $this->editAyuntamientoComunidad = $region;
                    break;
                }
            }
        }
    }

    public function deleteAyuntamiento()
    {
        Ayuntamiento::destroy($this->itemToDeleteId);
        $this->cancelDelete();

        $this->dispatch('notificar', [
            'titulo' => '¡Ayuntamiento Eliminado!',
            'mensaje' => 'El ayuntamiento y sus datos han sido eliminados correctamente.',
            'tipo' => 'success'
        ]);
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

        $this->showEditPublicoModal = false;

        $this->dispatch('notificar', [
            'titulo' => '¡Usuario Actualizado!',
            'mensaje' => 'El perfil del usuario público ha sido actualizado con éxito.',
            'tipo' => 'success'
        ]);
    }

    public function cancelEditPublico()
    {
        $this->showEditPublicoModal = false;
        $this->editingPublicoId = null;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $artistas = Artista::with('usuario')
            ->when($this->searchArtista, function ($query) {
                $query->where('nombre_artistico', 'like', '%' . $this->searchArtista . '%')
                    ->orWhereHas('usuario', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->searchArtista . '%');
                    });
            })//el metodo paginate acepta varios argumentos ($registrosPorPagina, $columnas, $nombreDeLaPagina)
            //el * sirve para que traiga todas las columnas
            //'artistasPage' sirve para diferenciar las paginaciones en caso de que haya mas de una en la misma pagina
            //para que cuando se quiera avanzar una, no se muevan las demas
            ->paginate(5, ['*'], 'artistasPage');

        $ayuntamientos = Ayuntamiento::with('usuario')
            ->when($this->searchAyuntamiento, function ($query) {
                $query->where('nombre_institucion', 'like', '%' . $this->searchAyuntamiento . '%')
                    ->orWhereHas('usuario', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->searchAyuntamiento . '%');
                    });
            })
            ->paginate(5, ['*'], 'ayuntamientosPage');

        $publicos = Publico::with('usuario')
            ->when($this->searchPublico, function ($query) {
                $query->whereHas('usuario', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->searchPublico . '%')
                        ->orWhere('email', 'like', '%' . $this->searchPublico . '%');
                });
            })
            ->paginate(5, ['*'], 'publicosPage');

        $eventos = Evento::when($this->searchEvento, function ($query) {
            $query->where('nombre_evento', 'like', '%' . $this->searchEvento . '%');
        })->paginate(5, ['*'], 'eventosPage');

        return view('admin.vistaAdmin', [
            'artistas' => $artistas,
            'ayuntamientos' => $ayuntamientos,
            'publicos' => $publicos,
            'eventos' => $eventos,
            'allGustos' => Publico::GUSTOS_MUSICALES,
            'allFavoritos' => Publico::TIPO_EVENTOS_FAVORITOS,
        ]);
    }

}
