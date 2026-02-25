<?php

namespace App\Livewire\Public;

use App\Models\Artista;
use App\Models\Ayuntamiento;
use App\Models\Evento;
use Livewire\Attributes\On;
use Livewire\Component;

class GlobalSearch extends Component
{
    // Propiedad vinculada al input de búsqueda con wire:model.live
    public $query = '';

    // Array estructurado para almacenar los resultados por categoría
    public $results = [
        'artistas' => [],
        'ayuntamientos' => [],
        'eventos' => []
    ];

    /**
     * Se ejecuta al cargar el componente. 
     * Inicializamos los resultados vacíos.
     */
    public function mount()
    {
        $this->results = [
            'artistas' => [],
            'ayuntamientos' => [],
            'eventos' => []
        ];
    }

    /**
     * Hook de Livewire que se dispara automáticamente cuando cambia $query.
     * Aquí es donde sucede la lógica de búsqueda en tiempo real.
     */
    public function updatedQuery()
    {
        // Solo buscamos si el usuario ha escrito al menos 1 caracter
        if (strlen($this->query) < 1) {
            $this->results = [
                'artistas' => [],
                'ayuntamientos' => [],
                'eventos' => []
            ];
            return;
        }

        // Búsqueda en el modelo Artista
        $this->results['artistas'] = Artista::where('nombre_artistico', 'like', '%' . $this->query . '%')
            ->orWhere('genero_musical', 'like', '%' . $this->query . '%')
            ->limit(5) // Limitamos para no saturar el modal
            ->get();

        // Búsqueda en el modelo Ayuntamiento (por nombre o localidad)
        $this->results['ayuntamientos'] = Ayuntamiento::where('nombre_institucion', 'like', '%' . $this->query . '%')
            ->orWhere('localidad', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();

        // Búsqueda en el modelo Evento
        $eventQuery = Evento::where(function ($q) {
            $q->where('nombre_evento', 'like', '%' . $this->query . '%')
                ->orWhere('localidad', 'like', '%' . $this->query . '%');
        });

        // Visibility logic: Public users don't see ABIERTO events
        if (!auth()->check() || (auth()->user()->tipo_usuario !== 'artista' && auth()->user()->tipo_usuario !== 'ayuntamiento' && auth()->user()->tipo_usuario !== 'admin')) {
            $eventQuery->where('estado', '!=', 'ABIERTO');
        }

        $this->results['eventos'] = $eventQuery->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.public.global-search');
    }
}
