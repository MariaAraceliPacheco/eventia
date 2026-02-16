<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;

class HomePage extends Component
{
    #[Url(as: 'type')]
    public $selectedPlan = 'publico'; // publico, artistas, ayuntamientos

    public function mount()
    {
        // Livewire's #[Url] handles query parameters automatically.
        // If the property is set via URL, it will overwrite the default.
    }

    public function setPlan($plan)
    {
        $this->selectedPlan = $plan;
    }

    public function render()
    {
        $query = \App\Models\Evento::orderBy('id', 'desc');

        // Global Visibility Rule: Public users/Guests never see ABIERTO events.
        // ABIERTO is only for Artists looking for work and Town Halls/Admins.
        if (!auth()->check() || auth()->user()->tipo_usuario === 'publico') {
            $query->where('estado', '!=', 'ABIERTO');
        } else {
            // If logged in as non-public (Artist/Ayto), we filter based on the view
            if ($this->selectedPlan === 'publico') {
                $query->where('estado', '!=', 'ABIERTO');
            }
        }

        $recentEvents = $query->take(3)->get();

        return view('livewire.home-page', [
            'recentEvents' => $recentEvents
        ])->layout('components.layouts.app');
    }
}
