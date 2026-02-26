<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Register extends Component
{
    // Renderiza la vista del formulario de registro
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
