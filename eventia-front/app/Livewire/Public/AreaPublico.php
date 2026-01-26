<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AreaPublico extends Component
{
    public $searchEvent = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.area-publico');
    }
}
