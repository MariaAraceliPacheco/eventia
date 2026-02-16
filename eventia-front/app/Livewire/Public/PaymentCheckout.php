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
        } else {
            return redirect()->route('public.area')->with('error', 'Falta información del evento para procesar el pago.');
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

            // Create Entrada record
            \App\Models\Entrada::create([
                'id_usuario' => auth()->id(),
                'id_evento' => $this->eventId,
                'categoria' => $this->category,
                'cantidad' => $this->quantity,
                'precio_total' => $this->total,
                'codigo_ticket' => strtoupper(\Illuminate\Support\Str::random(8)) . '-' . rand(1000, 9999),
                'fecha_compra' => now()
            ]);
        }

        session()->flash('message', '¡Pago procesado con éxito! Ya puedes ver tus entradas en tu área.');
        return redirect()->route('public.area');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.payment-checkout');
    }
}
