<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class PaymentCheckout extends Component
{
    public $eventId;
    public $evento;
    public $paymentMethod = 'card'; // card, paypal, bizum
    
    public $cardNumber = '';
    public $cardName = '';
    public $expiryDate = '';
    public $cvv = '';
    public $email = '';
    public $phone = '';
    
    public $eventName = 'Cargando...';
    public $category = 'General';
    public $quantity = 1;
    public $unitPrice = 0;
    public $total = 0;

    public function mount()
    {
        $this->eventId = request('eventId');
        if ($this->eventId) {
            $this->evento = \App\Models\Evento::findOrFail($this->eventId);
            $this->eventName = $this->evento->nombre_evento;
        }

        // Get parameters from query string
        $this->category = request('category', 'General');
        $this->quantity = request('quantity', 1);
        $this->unitPrice = request('price', 35);
        $this->total = request('total', 37.50);
    }

    public function processPayment()
    {
        // Actualizing ticket sales
        if ($this->evento) {
            $this->evento->increment('entradas_vendidas', $this->quantity);

            // Automatically transition to FINALIZADO if sold out
            if ($this->evento->isSoldOut()) {
                $this->evento->update(['estado' => 'FINALIZADO']);
            }
        }

        session()->flash('message', '¡Pago procesado con éxito! Recibirás tus entradas por email.');
        return redirect()->route('public.area');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.payment-checkout');
    }
}
