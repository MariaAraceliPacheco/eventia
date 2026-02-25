<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;

class BuyTicket extends Component
{
    public $eventId;
    public $evento;
    public $quantity = 1;
    public $category = '';
    public $tipos_disponibles = [];

    public function mount($eventId = null)
    {
        if ($eventId) {
            $this->eventId = $eventId;
            $this->evento = \App\Models\Evento::findOrFail($eventId);

            if ($this->evento->tipos_entrada && count($this->evento->tipos_entrada) > 0) {
                $this->tipos_disponibles = $this->evento->tipos_entrada;
                $this->category = $this->tipos_disponibles[0]['nombre'];
            } else {
                $this->tipos_disponibles = [['nombre' => 'General', 'precio' => $this->evento->precio]];
                $this->category = 'General';
            }

            // If already sold out, don't allow buying
            if ($this->evento->isSoldOut()) {
                session()->flash('notificar', [
                    'titulo' => 'Entradas agotadas',
                    'mensaje' => 'Lo sentimos, las entradas para este evento se han agotado.',
                    'tipo' => 'error'
                ]);
                return redirect()->route('public.event-detail', $this->eventId);
            }
        } else {
            session()->flash('notificar', [
                'titulo' => 'Error',
                'mensaje' => 'Selecciona un evento para comprar entradas.',
                'tipo' => 'error'
            ]);
            return redirect()->route('public.area');
        }
    }

    public function getSelectedPrice()
    {
        foreach ($this->tipos_disponibles as $tipo) {
            if ($tipo['nombre'] === $this->category) {
                return (float) $tipo['precio'];
            }
        }
        return 0;
    }

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
        return $this->getSelectedPrice() * $this->quantity;
    }

    public function getTotal()
    {
        return $this->getSubtotal() + 2.50; // Adding management fee
    }

    public function getDisponibles()
    {
        if ($this->evento->entradas_maximas === null)
            return 999;
        return max(0, $this->evento->entradas_maximas - $this->evento->entradas_vendidas);
    }

    public function increment()
    {
        $max_compra = min(5, $this->getDisponibles());
        if ($this->quantity < $max_compra) {
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
        // Final validation of availability
        if ($this->quantity > $this->getDisponibles()) {
            session()->flash('notificar', [
                'titulo' => 'Sin disponibilidad',
                'mensaje' => 'Lo sentimos, ya no quedan suficientes entradas disponibles.',
                'tipo' => 'error'
            ]);
            return redirect()->route('public.event-detail', $this->eventId);
        }

        // Redirect to payment checkout page with query parameters
        return redirect()->to('/pago?' . http_build_query([
            'eventId' => $this->eventId,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'price' => $this->getSelectedPrice(),
            'total' => $this->getTotal()
        ]));
    }
}
