<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class sliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // hacer validaciones para todos los compos
    public function rules(): array
    {
        if (request()->isMethod("post")) {
            return [
                'titulo' => 'required|string|max:255|unique:sliders,titulo|regex:/^[\pL\s\-+]+$/u', 
                'descripcion' => 'required|string',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para imagen
                'nombre_boton' => 'Required|string',
                'link_boton' => 'required|'
            ];
            
        } elseif (request()->isMethod('put')) {
            return [
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opcional en PUT
            ];
        }

        // En caso de que el método no sea ni POST ni PUT, retornamos un array vacío.
        return[];
    }
}
