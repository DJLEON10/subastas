<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubastaGanadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;
    public $comprador;

    /**
     * Create a new message instance.
     */
    public function __construct($producto, $comprador)
    {
        $this->producto = $producto;
        $this->comprador = $comprador;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('🎉 ¡Has ganado la subasta de ' . $this->producto->nombre . '!')
                    ->view('emails.subasta-ganada')
                    ->with([
                        'producto' => $this->producto,
                        'comprador' => $this->comprador,
                    ]);
    }
}
