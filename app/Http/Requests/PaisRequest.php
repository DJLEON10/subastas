<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

	public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'nombre' => 'required|unique:paises,nombre|regex:/^[\pL\s\-]+$/u'
            ];    
        } elseif ($this->isMethod('put')) {
            $paisId = $this->route('pais'); // Este es el nombre del parámetro de la ruta para el recurso 'pais'
            return [
                'nombre' => 'required|regex:/^[\pL\s\-]+$/u|unique:paises,nombre,' . $paisId
            ];
        }
    }
}
