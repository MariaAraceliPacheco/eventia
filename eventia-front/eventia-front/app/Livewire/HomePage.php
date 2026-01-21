<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    public $selectedPlan = 'publico'; // publico, artistas, ayuntamientos

    public function setPlan($plan)
    {
        $this->selectedPlan = $plan;
    }

    public function render()
    {
        return view('livewire.home-page')->layout('components.layouts.app');
    }
}
