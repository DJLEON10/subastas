<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiudadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
		if(request()->isMethod('post')){
			return [
				'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
				'departamento_id' => 'required'
				
			];	
		} elseif(request()->isMethod('put')){
			return [
				'nombre'=>'required|regex:/^[\pL\s\-]+$/u'
			];
		}
    }
	
	public function attributes()
    {
        return [
            'departamento_id' => 'departamento'
        ];
    }
}
