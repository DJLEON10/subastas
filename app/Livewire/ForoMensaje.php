<?php

namespace App\Livewire;

use App\Models\Foro;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForoMensaje extends Component
{
    public $foroId;
    public $foro;
    public $nuevoMensaje = '';

    protected $listeners = ['refreshForo' => 'cargarForo'];

    public function mount($foroId)
    {
        $this->foroId = $foroId;
        $this->cargarForo();
    }

    public function cargarForo()
    {
        $this->foro = Foro::find($this->foroId);

        if (!is_array($this->foro->mensajes)) {
            $this->foro->mensajes = [];
            $this->foro->save();
        }
    }

    // --- Agregar mensaje ---
    public function enviarMensaje()
    {
        $mensajes = $this->foro->mensajes ?? [];

        $mensajes[] = [
            'mensaje_id' => uniqid('m'),
            'user_id'    => Auth::id(),
            'user_name'  => Auth::user()->name, // ← NOMBRE DEL AUTOR
            'contenido'  => $this->nuevoMensaje,
            'reacciones' => [],
            'created_at' => now()
        ];

        $this->foro->update(['mensajes' => $mensajes]);

        $this->nuevoMensaje = '';
        $this->cargarForo();
        $this->dispatch('refreshForo')->to($this);
    }

    // --- Reaccionar (solo una reacción por usuario) ---
    public function reaccionar($mensajeId, $tipo)
    {
        $mensajes = $this->foro->mensajes;

        foreach ($mensajes as &$m) {
            if ($m['mensaje_id'] === $mensajeId) {

                if (!isset($m['reacciones']) || !is_array($m['reacciones'])) {
                    $m['reacciones'] = [];
                }

                $userId = Auth::id();
                $reaccionExiste = false;

                foreach ($m['reacciones'] as &$r) {
                    if ($r['user_id'] == $userId) {
                        $r['tipo'] = $tipo; // Actualiza reacción existente
                        $reaccionExiste = true;
                        break;
                    }
                }

                if (!$reaccionExiste) {
                    $m['reacciones'][] = [
                        'user_id' => $userId,
                        'tipo'    => $tipo
                    ];
                }
            }
        }

        $this->foro->update(['mensajes' => $mensajes]);

        $this->cargarForo();
    }

    // Obtener reacción del usuario
    public function reaccionUsuario($reacciones)
    {
        $userId = Auth::id();

        foreach ($reacciones as $r) {
            if ($r['user_id'] == $userId) {
                return $r['tipo'];
            }
        }
        return null;
    }

    public function render()
    {
        return view('livewire.foro-mensaje');
    }
}
