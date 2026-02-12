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

    public function mount()
    {
        if (!auth()->user() || !auth()->user()->perfilAyuntamiento) {
            return redirect()->route('role-selection');
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
            'price' => 'nullable|numeric',
        ]);

        $description = $this->description;
        // if ($this->invitedArtists) {
        //     $description .= "\n\nArtistas invitados: " . $this->invitedArtists;
        // }

        $evento = Evento::create([
            'id_ayuntamiento' => auth()->user()->perfilAyuntamiento->id,
            'nombre_evento' => $this->title,
            'fecha_inicio' => $this->date,
            'localidad' => $this->locality,
            'provincia' => $this->province,
            'category' => $this->category, // Fix: component has $category, model has category
            'categoria' => $this->category, // Assuming model field name is categoria from previous view
            'precio' => $this->price,
            'descripcion' => $description,
            'estado' => 'ABIERTO',
        ]);

        if (!empty($this->selectedArtists)) {
            $evento->artistas()->attach($this->selectedArtists);
        }

        return redirect()->route('town-hall.area');
    }
}
