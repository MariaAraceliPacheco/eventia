<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

use App\Models\Evento;
use App\Models\Artista;

class CreateEvent extends Component
{
    use WithFileUploads;

    public $eventId = null;
    public $title = '';
    public $image;
    public $invitedArtists = ''; // Legacy text field, keeping for now or replacing
    public $selectedArtists = []; // IDs of selected artists
    public $price = '';
    public $tipos_entrada = [['nombre' => 'General', 'precio' => '']];
    public $date = '';
    public $category = '';
    public $description = '';
    public $locality = '';
    public $province = '';

    public function mount($id = null)
    {
        $user = auth()->user();
        if (!$user || (!$user->perfilAyuntamiento && $user->tipo_usuario !== 'admin')) {
            return redirect()->route('role-selection');
        }

        if ($id) {
            $evento = Evento::with('artistas')->findOrFail($id);

            // Verify ownership (unless admin)
            if ($user->tipo_usuario !== 'admin' && $evento->id_ayuntamiento !== $user->perfilAyuntamiento->id) {
                return redirect()->route('town-hall.area');
            }

            $this->eventId = $evento->id;
            $this->title = $evento->nombre_evento;
            $this->date = \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d');
            $this->locality = $evento->localidad;
            $this->province = $evento->provincia;
            $this->category = $evento->categoria ?? $evento->category;
            $this->price = $evento->precio;
            $this->description = $evento->descripcion;
            $this->tipos_entrada = $evento->tipos_entrada ?? [['nombre' => 'General', 'precio' => $evento->precio]];
            $this->selectedArtists = $evento->artistas->pluck('id')->toArray();
            
            // Also include those with pending or rejected invitation to show their status
            $invitedIds = \App\Models\Solicitud::where('id_evento', $evento->id)
                ->where('origen', 'ayuntamiento')
                ->pluck('id_artista')
                ->toArray();
            
            $this->selectedArtists = array_unique(array_merge($this->selectedArtists, $invitedIds));
        } else {
            // Default for new events
            $this->tipos_entrada = [['nombre' => 'General', 'precio' => '']];
        }
    }

    public function addTipoEntrada()
    {
        $this->tipos_entrada[] = ['nombre' => '', 'precio' => ''];
    }

    public function removeTipoEntrada($index)
    {
        unset($this->tipos_entrada[$index]);
        $this->tipos_entrada = array_values($this->tipos_entrada);
        
        if (empty($this->tipos_entrada)) {
            $this->addTipoEntrada();
        }
    }

    public function toggleArtist($id)
    {
        if (in_array($id, $this->selectedArtists)) {
            $this->selectedArtists = array_diff($this->selectedArtists, [$id]);
        } else {
            $this->selectedArtists[] = $id;
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $view = $this->eventId ? 'livewire.town-hall.edit-event' : 'livewire.town-hall.create-event';

        $invitaciones = [];
        if ($this->eventId) {
            $invitaciones = \App\Models\Solicitud::where('id_evento', $this->eventId)
                ->where('origen', 'ayuntamiento')
                ->get()
                ->pluck('estado', 'id_artista')
                ->toArray();
        }

        return view($view, [
            'allArtists' => Artista::all(),
            'invitaciones' => $invitaciones
        ]);
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required',
            'date' => 'required|date',
            'locality' => 'required',
            'category' => 'required',
            'price' => 'nullable|numeric|min:0',
            'tipos_entrada' => 'required|array|min:1',
            'tipos_entrada.*.nombre' => 'required',
            'tipos_entrada.*.precio' => 'required|numeric|min:0',
        ]);

        $data = [
            'nombre_evento' => $this->title,
            'fecha_inicio' => $this->date,
            'localidad' => $this->locality,
            'provincia' => $this->province,
            'category' => $this->category,
            'categoria' => $this->category,
            'precio' => count($this->tipos_entrada) > 0 ? $this->tipos_entrada[0]['precio'] : $this->price,
            'tipos_entrada' => $this->tipos_entrada,
            'descripcion' => $this->description,
            'estado' => 'ABIERTO',
        ];

        // Only set id_ayuntamiento for new events or if user is ayuntamiento
        if (!$this->eventId && auth()->user()->perfilAyuntamiento) {
            $data['id_ayuntamiento'] = auth()->user()->perfilAyuntamiento->id;
        }

        if ($this->eventId) {
            $evento = Evento::findOrFail($this->eventId);
            $evento->update($data);
            
            // 1. New invitations for newly selected artists
            $currentArtistIds = $evento->artistas->pluck('id')->toArray();
            foreach ($this->selectedArtists as $artistId) {
                if (!in_array($artistId, $currentArtistIds)) {
                    \App\Models\Solicitud::firstOrCreate([
                        'id_artista' => $artistId,
                        'id_evento' => $evento->id,
                        'origen' => 'ayuntamiento',
                        'estado' => 'pendiente'
                    ]);
                }
            }

            // 2. Remove attached artists who are NO LONGER selected
            $toDetach = array_diff($currentArtistIds, $this->selectedArtists);
            if (!empty($toDetach)) {
                $evento->artistas()->detach($toDetach);
            }

            // 3. Remove pending or rejected invitations for artists who are NO LONGER selected
            \App\Models\Solicitud::where('id_evento', $evento->id)
                ->where('origen', 'ayuntamiento')
                ->whereIn('estado', ['pendiente', 'rechazada'])
                ->whereNotIn('id_artista', $this->selectedArtists)
                ->delete();

            session()->flash('message', 'Evento actualizado con éxito.');
        } else {
            $evento = Evento::create($data);
            // Create invitations for all selected artists
            foreach ($this->selectedArtists as $artistId) {
                \App\Models\Solicitud::create([
                    'id_artista' => $artistId,
                    'id_evento' => $evento->id,
                    'origen' => 'ayuntamiento',
                    'estado' => 'pendiente'
                ]);
            }
            session()->flash('message', 'Evento creado con éxito. Se han enviado invitaciones a los artistas seleccionados.');
        }

        if (auth()->user()->tipo_usuario === 'admin') {
            return redirect()->route('admin.vistaAdmin');
        }

        return redirect()->route('town-hall.area');
    }
}
