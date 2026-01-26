<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;

class RoleSelection extends Component
{
    public $selectedRole = null;

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.role-selection');
    }

    public function selectRole($role)
    {
        $this->selectedRole = $role;
    }

    public function submit()
    {
        if ($this->selectedRole === 'publico') {
             return redirect()->route('user-questions');
        }

        if ($this->selectedRole === 'artista') {
            return redirect()->route('artist-questions');
        }
        
        // Handle other roles or default
        return redirect()->route('dashboard');
    }
}
