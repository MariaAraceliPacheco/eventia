<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class TownHallList extends Component
{
    public $search = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        // Get town halls from database and filter by search term
        $townHalls = \App\Models\Ayuntamiento::query()
            ->when($this->search, function($query) {
                $query->where('nombre_institucion', 'like', '%' . $this->search . '%');
            })
            ->get()
            ->map(function($ayuntamiento) {
                return [
                    'id' => $ayuntamiento->id,
                    'name' => $ayuntamiento->nombre_institucion,
                    'description' => 'Institución comprometida con la cultura y el ocio.',
                    'events' => ['Próximamente'],
                    'image' => $ayuntamiento->imagen,
                    'color' => 'primary'
                ];
            })
            ->toArray();

        // If no town halls found and no search, show mock data
        if (empty($townHalls) && empty($this->search)) {
            $townHalls = [
                [
                    'id' => 1,
                    'name' => 'Ayuntamiento de Madrid',
                    'description' => 'Fomentando la cultura y el ocio en el corazón de España.',
                    'events' => ['Summer Indie Festival', 'Gastro-Fest 2026', 'Indie Night'],
                    'image' => '🏛️',
                    'color' => 'primary'
                ],
                [
                    'id' => 2,
                    'name' => 'Ayuntamiento de Barcelona',
                    'description' => 'Tradición y vanguardia en cada evento institucional.',
                    'events' => ['Sónar Week', 'Feria del Libro', 'Concierto en la Playa'],
                    'image' => '⛪',
                    'color' => 'secondary'
                ],
                [
                    'id' => 3,
                    'name' => 'Ayuntamiento de Valencia',
                    'description' => 'Luz, música y tradición mediterránea para todos.',
                    'events' => ['Fallas Exclusivas', 'Metal Bash', 'Paella-Fest'],
                    'image' => '🕌',
                    'color' => 'accent'
                ],
                [
                    'id' => 4,
                    'name' => 'Ayuntamiento de Sevilla',
                    'description' => 'La magia del sur a través de eventos únicos.',
                    'events' => ['Feria de Abril', 'Flamenco Night', 'Tour Museos'],
                    'image' => '🎪',
                    'color' => 'primary'
                ]
            ];
        }

        return view('livewire.public.town-hall-list', [
            'townHalls' => $townHalls
        ]);
    }
}
