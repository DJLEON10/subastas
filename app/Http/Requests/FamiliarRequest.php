<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamiliarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
		if(request()->isMethod('post')){
			return [
				'habitante_id' => 'required',
				'nombre' => 'required|:familiares,nombre|regex:/^[\pL\s\-]+$/u',
                'parentezco' => 'required',
				'direccion' => 'required',
				'celular' => 'required',

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
            'habitante_id' => 'habitante'
        ];
    }
}
