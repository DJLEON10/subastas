<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubastaVendidaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;
    public $vendedor;
    public $comprador;

    public function __construct($producto, $vendedor, $comprador)
    {
        $this->producto = $producto;
        $this->vendedor = $vendedor;
        $this->comprador = $comprador;
    }

    public function build()
    {
        return $this->subject('📦 Has vendido tu producto ' . $this->producto->nombre)
                    ->view('emails.subasta-vendida')
                    ->with([
                        'producto' => $this->producto,
                        'vendedor' => $this->vendedor,
                        'comprador' => $this->comprador,
                    ]);
    }
}
