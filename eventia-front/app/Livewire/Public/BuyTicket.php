<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class BuyTicket extends Component
{
    public $quantity = 1;
    public $category = 'General';

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.buy-ticket');
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function buy()
    {
        // Logic for purchase will go here
        return redirect()->route('public.area');
    }
}
