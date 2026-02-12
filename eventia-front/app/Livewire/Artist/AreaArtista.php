<?php

namespace App\Livewire\Artist;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Evento;

class AreaArtista extends Component
{
    public $searchEvent = '';
    public $user;
    public $artista;

    //esta funcion sirve para obtener el usuario y el artista
    public function mount()
    {
        $this->user = auth()->user();
        if (!$this->user || !$this->user->perfilArtista) {
            return redirect()->route('role-selection');
        }
        $this->artista = $this->user->perfilArtista;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $eventos = Evento::query()
            ->when($this->searchEvent, function($query) {
                $query->where('nombre_evento', 'like', '%' . $this->searchEvent . '%');
            })
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('livewire.artist.area-artista', [
            'eventos' => $eventos
        ]);
    }
}
