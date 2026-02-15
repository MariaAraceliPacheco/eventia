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
        $recentEvents = \App\Models\Evento::orderBy('id', 'desc')->take(3)->get();

        return view('livewire.home-page', [
            'recentEvents' => $recentEvents
        ])->layout('components.layouts.app');
    }
}
