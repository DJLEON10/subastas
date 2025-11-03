<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Puja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubastaGanadaMail;
use App\Mail\SubastaVendidaMail;
use Carbon\Carbon;

class PujarProducto extends Component
{
    public $productoId;
    public $producto;
    public $nuevoMonto;
    public $pujas = [];

    protected $listeners = ['verificarTiempo'];

    public function mount($productoId)
    {
        $this->productoId = $productoId;
        $this->producto = Producto::find($productoId);
        $this->cargarPujas();
    }

    public function hacerPuja()
    {
        $precioActual = $this->producto->precio;
        $incrementoMinimo = $this->producto->incrementoMinimo;

        // Validar monto
        if ($this->nuevoMonto < $precioActual + $incrementoMinimo) {
            $this->dispatch('swal:error', [
                'message' => 'La puja mínima debe ser de $' . number_format($precioActual + $incrementoMinimo, 0, ',', '.'),
            ]);
            return;
        }

        // Registrar puja
        Puja::create([
            'producto_id' => $this->productoId,
            'user_id' => Auth::id(),
            'monto' => $this->nuevoMonto,
            'created_at' => now(),
        ]);

        // Actualizar el precio actual del producto
        $this->producto->update(['precio' => $this->nuevoMonto]);
        $this->producto = Producto::find($this->productoId);

        // Recargar historial
        $this->nuevoMonto = null;
        $this->cargarPujas();

        // Mensaje de éxito
        $this->dispatch('swal', [
            'message' => '¡Puja realizada con éxito!',
        ]);
    }

    public function cargarPujas()
    {
        $this->pujas = Puja::where('producto_id', $this->productoId)
        ->with('user') // 👈 Esto carga el nombre del usuario
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function verificarTiempo()
    {
        if (!$this->producto->finalizado && Carbon::now()->greaterThanOrEqualTo($this->producto->fechaFin)) {
            $ultimaPuja = Puja::where('producto_id', $this->productoId)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($ultimaPuja) {
                $this->producto->update([
                    'finalizado' => true,
                    'ganador_id' => $ultimaPuja->user_id,
                    'estado'=>0
                ]);

                // enviar correos
                $comprador = User::find($ultimaPuja->user_id);
                $vendedor = User::find($this->producto->registradopor);

                if ($comprador && $vendedor) {
                    Mail::to($comprador->email)->send(new SubastaGanadaMail($this->producto, $comprador));
                    Mail::to($vendedor->email)->send(new SubastaVendidaMail($this->producto, $vendedor, $comprador));
                }
            }
        }
    }

    public function render()
    {
        $this->verificarTiempo(); // se verifica en cada render
        return view('livewire.pujar-producto');
    }
}
