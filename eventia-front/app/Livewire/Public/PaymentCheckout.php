<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class PaymentCheckout extends Component
{
    public $paymentMethod = 'card'; // card, paypal, bizum
    
    public $cardNumber = '';
    public $cardName = '';
    public $expiryDate = '';
    public $cvv = '';
    public $email = '';
    public $phone = '';
    
    public $eventName = 'Summer Indie Festival 2026';
    public $category = 'General';
    public $quantity = 1;
    public $unitPrice = 35;
    public $total = 37.50;

    public function mount()
    {
        // Get parameters from query string
        $this->category = request('category', 'General');
        $this->quantity = request('quantity', 1);
        $this->unitPrice = request('price', 35);
        $this->total = request('total', 37.50);
    }

    public function processPayment()
    {
        // This is just a placeholder - no actual payment processing
        // In a real app, you would validate and process the payment here
        session()->flash('message', '¡Pago procesado con éxito! Recibirás tus entradas por email.');
        return redirect()->route('public.area');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.payment-checkout');
    }
}
