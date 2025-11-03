<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public $contador = 0;

    public function aumentar() {
        $this->contador++;
    }

    public function render()
    {
        return view('livewire.contador');
    }
}
