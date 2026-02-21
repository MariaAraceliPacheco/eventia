<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class ArtistList extends Component
{
    public $search = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        // Get artists from database and filter by search term
        $artists = \App\Models\Artista::query()
            ->when($this->search, function($query) {
                $query->where('nombre_artistico', 'like', '%' . $this->search . '%');
            })
            ->get()
            ->map(function($artista) {
                return [
                    'id' => $artista->id,
                    'name' => $artista->nombre_artistico,
                    'genre' => $artista->genero_musical,
                    'description' => $artista->descripcion ?? 'Artista profesional con amplia trayectoria.',
                    'image' => $artista->img_logo,
                    'events' => ['Próximamente'],
                    'town_halls' => ['Varios'],
                    'color' => 'secondary'
                ];
            })
            ->toArray();

        // If no artists found and no search, show mock data
        if (empty($artists) && empty($this->search)) {
            $artists = [
                [
                    'id' => 1,
                    'name' => 'Los Rockeros',
                    'genre' => 'Rock / Indie',
                    'description' => 'Energía pura en el escenario con los mejores riffs del país.',
                    'image' => '🎸',
                    'events' => ['Summer Indie Fest', 'Rock Night'],
                    'town_halls' => ['Madrid', 'Valencia'],
                    'color' => 'primary'
                ],
                [
                    'id' => 2,
                    'name' => 'DJ Spark',
                    'genre' => 'Electronic / House',
                    'description' => 'Haciendo vibrar las pistas de baile con ritmos innovadores.',
                    'image' => '🎧',
                    'events' => ['Sónar Week', 'Beach Party'],
                    'town_halls' => ['Barcelona', 'Ibiza'],
                    'color' => 'secondary'
                ],
                [
                    'id' => 3,
                    'name' => 'Voz de Angel',
                    'genre' => 'Pop / Soul',
                    'description' => 'Una voz que cautiva y emociona desde la primera nota.',
                    'image' => '🎤',
                    'events' => ['Gala Solidaria', 'Acústicos en el Parque'],
                    'town_halls' => ['Sevilla', 'Málaga'],
                    'color' => 'accent'
                ],
                [
                    'id' => 4,
                    'name' => 'Jazz Trio',
                    'genre' => 'Jazz / Blues',
                    'description' => 'Elegancia y sofisticación para las noches más exclusivas.',
                    'image' => '🎷',
                    'events' => ['Noches de Jazz', 'Apertura de Festival'],
                    'town_halls' => ['San Sebastián', 'Madrid'],
                    'color' => 'primary'
                ]
            ];
        }

        return view('livewire.public.artist-list', [
            'artists' => $artists
        ]);
    }
}
