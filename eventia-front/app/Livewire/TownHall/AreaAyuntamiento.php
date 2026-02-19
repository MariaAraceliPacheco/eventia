<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use App\Models\Evento;
use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Solicitud;

class AreaAyuntamiento extends Component
{
    use WithFileUploads;
    use WithPagination;


    public $searchArtist = '';

    public $user;
    public $ayuntamiento;

    // Profile Edit Modal properties
    public $showProfileModal = false;
    public $nombre_institucion = '';
    public $editImagen;
    public $telefono = '';
    public $comunidad_autonoma = '';
    public $provincia = '';
    public $localidad = '';
    public $tipo_evento = '';
    public $frecuencia = '';
    public $tipo_espacio = '';
    public $opciones_accesibilidad = '';
    public $tipo_facturacion = 'plataforma';
    public $logistica_propia = '';

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

    // Cerrar event modal properties
    public $showCerrarModal = false;
    public $closingEventId = null;
    public $total_entradas = 100;

    public function mount()
    {
        $this->user = auth()->user();
        if (!$this->user || !$this->user->perfilAyuntamiento) {
            return redirect()->route('role-selection');
        }
        $this->ayuntamiento = $this->user->perfilAyuntamiento;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $eventos = $this->ayuntamiento->eventos()->orderBy('fecha_inicio', 'desc')->get();

        $artistas = Artista::query()
            ->when($this->searchArtist, function ($query) {
                $query->where('nombre_artistico', 'like', '%' . $this->searchArtist . '%');
            })
            ->paginate(5);

        return view('livewire.town-hall.area-ayuntamiento', [
            'eventos' => $eventos,
            'artistas' => $artistas,
            'solicitudes' => $this->solicitudes
        ]);
    }

    public function getSolicitudesProperty()
    {
        return Solicitud::whereIn('id_evento', $this->ayuntamiento->eventos()->pluck('id'))
            ->where('estado', 'pendiente')
            ->where('origen', 'artista') // Only those initiated by artists
            ->with(['artista', 'evento'])
            ->get();
    }

    public function aceptarSolicitud($solicitudId)
    {
        $solicitud = Solicitud::findOrFail($solicitudId);

        // Ensure this town hall owns the event
        if ($solicitud->evento->id_ayuntamiento !== $this->ayuntamiento->id) {
            return;
        }

        $solicitud->update(['estado' => 'aceptada']);

        // Link artist to event
        $solicitud->evento->artistas()->syncWithoutDetaching([$solicitud->id_artista]);

        $this->dispatch('notificar', [
            'titulo' => 'Solicitud aceptada',
            'mensaje' => 'El artista ha sido añadido al cartel del evento.',
            'tipo' => 'success'
        ]);
    }

    public function rechazarSolicitud($solicitudId)
    {
        $solicitud = Solicitud::findOrFail($solicitudId);

        if ($solicitud->evento->id_ayuntamiento !== $this->ayuntamiento->id) {
            return;
        }

        $solicitud->update(['estado' => 'rechazada']);

        $this->dispatch('notificar', [
            'titulo' => 'Solicitud rechazada',
            'mensaje' => 'La solicitud ha sido rechazada.',
            'tipo' => 'info'
        ]);
    }

    public function createEvent()
    {
        return redirect()->route('town-hall.create-event');
    }

    public function editEvent($eventId)
    {
        return redirect()->route('town-hall.edit-event', ['id' => $eventId]);
    }


    public function cancelEdit()
    {
        $this->showEditModal = false;
        $this->resetEditForm();
    }

    public function deleteEvent($eventId)
    {
        $evento = Evento::find($eventId);
        if ($evento) {
            if ($evento->estado === 'FINALIZADO') {
                $this->dispatch('notificar', [
                    'titulo' => 'Acción bloqueada',
                    'mensaje' => 'No se puede eliminar un evento finalizado.',
                    'tipo' => 'error'
                ]);
                return;
            }
            $evento->delete();
            session()->flash('message', 'Evento eliminado correctamente');
        }
    }

    public function cerrarEvento($eventId)
    {
        $this->closingEventId = $eventId;
        $this->showCerrarModal = true;
    }

    public function confirmCerrarEvento()
    {
        $this->validate([
            'total_entradas' => 'required|integer|min:1'
        ]);

        $evento = Evento::findOrFail($this->closingEventId);
        $evento->update([
            'estado' => 'CERRADO',
            'entradas_maximas' => $this->total_entradas
        ]);

        $this->showCerrarModal = false;
        $this->closingEventId = null;

        $this->dispatch('notificar', [
            'titulo' => 'Evento cerrado',
            'mensaje' => 'El evento ahora es visible para el público y se han habilitado las entradas.',
            'tipo' => 'success'
        ]);
    }

    public function cancelCerrarEvento()
    {
        $this->showCerrarModal = false;
        $this->closingEventId = null;
    }

    public function editProfile()
    {
        if ($this->ayuntamiento) {
            $this->nombre_institucion = $this->ayuntamiento->nombre_institucion;
            $this->telefono = $this->ayuntamiento->telefono;
            $this->comunidad_autonoma = $this->ayuntamiento->comunidad_autonoma;
            $this->provincia = $this->ayuntamiento->provincia;
            $this->localidad = $this->ayuntamiento->localidad;
            $this->tipo_evento = $this->ayuntamiento->tipo_evento;
            $this->frecuencia = $this->ayuntamiento->frecuencia;
            $this->tipo_espacio = $this->ayuntamiento->tipo_espacio;
            $this->opciones_accesibilidad = $this->ayuntamiento->opciones_accesibilidad;
            $this->tipo_facturacion = $this->ayuntamiento->tipo_facturacion;
            $this->logistica_propia = $this->ayuntamiento->logistica_propia;
        }
        $this->showProfileModal = true;
    }

    public function saveProfile()
    {
        $validated = $this->validate([
            'nombre_institucion' => 'required|string',
            'telefono' => 'required|string',
            'comunidad_autonoma' => 'required|string',
            'provincia' => 'required|string',
            'localidad' => 'required|string',
            'tipo_evento' => 'required|string',
            'frecuencia' => 'required|string',
            'tipo_espacio' => 'required|string',
            'opciones_accesibilidad' => 'string',
            'tipo_facturacion' => 'required|string',
            'logistica_propia' => 'string',
        ]);

        if ($this->editImagen) {
            $validated['imagen'] = \App\Http\Controllers\AyuntamientoController::handleImageUpload($this->editImagen);
        }

        if ($this->ayuntamiento) {
            $this->ayuntamiento->update($validated);
            session()->flash('message', 'Perfil actualizado con éxito');
        }

        $this->showProfileModal = false;
        $this->editImagen = null;
    }

    public function cancelProfileEdit()
    {
        $this->showProfileModal = false;
        $this->editImagen = null;
    }

    public function getProvincesProperty()
    {
        if ($this->comunidad_autonoma) {
            return $this->regions_data[$this->comunidad_autonoma] ?? [];
        }

        $all = [];
        foreach ($this->regions_data as $provinces) {
            $all = array_merge($all, $provinces);
        }
        sort($all);
        return $all;
    }

    public function updatedProvincia()
    {
        if ($this->provincia) {
            foreach ($this->regions_data as $region => $provinces) {
                if (in_array($this->provincia, $provinces)) {
                    $this->comunidad_autonoma = $region;
                    break;
                }
            }
        }
    }

    private function resetEditForm()
    {
        $this->editingEventId = null;
        $this->editEventName = '';
        $this->editEventDate = '';
        $this->editEventLocation = '';
        $this->editEventDescription = '';
    }
}
