<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class BuyTicket extends Component
{
    public $eventId;
    public $evento;
    public $quantity = 1;
    public $category = 'General';

    public function mount($eventId = null)
    {
        if ($eventId) {
            $this->eventId = $eventId;
            $this->evento = \App\Models\Evento::findOrFail($eventId);
            
            // If already sold out, don't allow buying
            if ($this->evento->isSoldOut()) {
                return redirect()->route('public.event-detail', $this->eventId)
                    ->with('error', 'Lo sentimos, las entradas para este evento se han agotado.');
            }
        }
    }
    
    // Price map for each category
    public $prices = [
        'General' => 35,
        'Pista' => 45,
        'V.I.P.' => 120,
        'Grada Lateral' => 30
    ];

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.buy-ticket', [
            'subtotal' => $this->getSubtotal(),
            'total' => $this->getTotal()
        ]);
    }

    public function getSubtotal()
    {
        return $this->prices[$this->category] * $this->quantity;
    }

    public function getTotal()
    {
        return $this->getSubtotal() + 2.50; // Adding management fee
    }

    public function increment()
    {
        if ($this->quantity < 5) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function buy()
    {
        // Redirect to payment checkout page with query parameters
        return redirect()->to('/pago?' . http_build_query([
            'eventId' => $this->eventId,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'price' => $this->prices[$this->category],
            'total' => $this->getTotal()
        ]));
    }
}
