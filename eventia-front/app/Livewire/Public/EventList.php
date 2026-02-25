<?php

namespace App\Livewire\Public;

use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Evento;

class EventList extends Component
{
    use WithPagination;

    public $search = '';
    public $localidad = '';
    public $provincia = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'localidad' => ['except' => ''],
        'provincia' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLocalidad()
    {
        $this->resetPage();
    }

    public function updatingProvincia()
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $query = Evento::query();

        if ($this->search) {
            $query->where('nombre_evento', 'like', '%' . $this->search . '%');
        }

        if ($this->localidad) {
            $query->where('localidad', 'like', '%' . $this->localidad . '%');
        }

        if ($this->provincia) {
            $query->where('provincia', 'like', '%' . $this->provincia . '%');
        }

        // Visibility logic: Public users don't see ABIERTO events unless they have enough data
        // For this list, we might want to show everything that is published/ready

        if(Auth::user()->tipo_usuario == 'publico'){
            $query->where(function ($q) {
                $q->whereIn('estado', ['CERRADO', 'FINALIZADO', 'AGOTADO', 'AGOTADO'])
                    ->orWhere('estado', 'CERRADO');
            });
        } else if (Auth::user()->tipo_usuario == 'artista') {
            $query->where(function ($q) {
                $q->whereIn('estado', ['CERRADO', 'FINALIZADO', 'AGOTADO', 'AGOTADO'])
                    ->orWhere('estado', 'ABIERTO');
            });
        } else {
             $query->where(function ($q) {
                $q->whereIn('estado', ['CERRADO', 'FINALIZADO', 'AGOTADO', 'AGOTADO']);
            });
        }

        $eventos = $query->orderBy('fecha_inicio', 'desc')->paginate(9);

        return view('livewire.public.event-list', [
            'eventos' => $eventos
        ]);
    }
}
