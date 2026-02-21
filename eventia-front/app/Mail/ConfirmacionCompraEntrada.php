<?php

namespace App\Mail;

use App\Models\Entrada;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionCompraEntrada extends Mailable
{
    use Queueable, SerializesModels;

    public $entrada;

    /**
     * Create a new message instance.
     *
     * @param Entrada $entrada
     */
    public function __construct(Entrada $entrada)
    {
        $this->entrada = $entrada->load(['evento', 'usuario']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de compra de entrada - Eventia')
            ->view('emails.confirmacion-compra-entrada');
    }
}
