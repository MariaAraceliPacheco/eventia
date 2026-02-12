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
    public $date = '';
    public $category = '';
    public $description = '';
    public $locality = '';
    public $province = '';

    public function mount($id = null)
    {
        if (!auth()->user() || !auth()->user()->perfilAyuntamiento) {
            return redirect()->route('role-selection');
        }

        if ($id) {
            $evento = Evento::with('artistas')->findOrFail($id);
            
            // Verify ownership
            if ($evento->id_ayuntamiento !== auth()->user()->perfilAyuntamiento->id) {
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
            $this->selectedArtists = $evento->artistas->pluck('id')->toArray();
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
        return view('livewire.town-hall.create-event', [
            'allArtists' => Artista::all()
        ]);
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required',
            'date' => 'required|date',
            'locality' => 'required',
            'category' => 'required',
            'price' => 'nullable',
        ]);

        $data = [
            'id_ayuntamiento' => auth()->user()->perfilAyuntamiento->id,
            'nombre_evento' => $this->title,
            'fecha_inicio' => $this->date,
            'localidad' => $this->locality,
            'provincia' => $this->province,
            'category' => $this->category,
            'categoria' => $this->category,
            'precio' => $this->price,
            'descripcion' => $this->description,
            'estado' => 'ABIERTO',
        ];

        if ($this->eventId) {
            $evento = Evento::findOrFail($this->eventId);
            $evento->update($data);
            $evento->artistas()->sync($this->selectedArtists);
            session()->flash('message', 'Evento actualizado con éxito');
        } else {
            $evento = Evento::create($data);
            if (!empty($this->selectedArtists)) {
                $evento->artistas()->attach($this->selectedArtists);
            }
            session()->flash('message', 'Evento creado con éxito');
        }

        return redirect()->route('town-hall.area');
    }
}
