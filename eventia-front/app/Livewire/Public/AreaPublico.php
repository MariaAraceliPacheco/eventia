<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class AreaPublico extends Component
{
    public $searchEvent = '';
    public $selectedTickets = [];

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.area-publico');
    }

    public function toggleSelection($ticketId)
    {
        if (in_array($ticketId, $this->selectedTickets)) {
            $this->selectedTickets = array_diff($this->selectedTickets, [$ticketId]);
        } else {
            $this->selectedTickets[] = $ticketId;
        }
    }

    public function goToPurchase()
    {
        if (count($this->selectedTickets) > 0) {
            // In a real app, we'd pass the actual IDs or save selection to session
            return redirect()->route('public.buy-ticket');
        }
    }
}
