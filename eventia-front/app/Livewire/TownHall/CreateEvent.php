<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

use App\Models\Evento;

class CreateEvent extends Component
{
    use WithFileUploads;

    public $title = '';
    public $image;
    public $invitedArtists = '';
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

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.town-hall.create-event');
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
        if ($this->invitedArtists) {
            $description .= "\n\nArtistas invitados: " . $this->invitedArtists;
        }

        Evento::create([
            'id_ayuntamiento' => auth()->user()->perfilAyuntamiento->id,
            'nombre_evento' => $this->title,
            'fecha_inicio' => $this->date,
            'localidad' => $this->locality,
            'provincia' => $this->province,
            'categoria' => $this->category,
            'precio' => $this->price,
            'descripcion' => $description,
            'estado' => 'ABIERTO', // Default status from DB enum
            // 'imagen' => $this->image ? $this->image->store('eventos', 'public') : null, // Column missing in DB schema provided
        ]);

        return redirect()->route('town-hall.area');
    }
}
