<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoDocumentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
		if(request()->isMethod('post')){
			return [
				'nombre' => 'required|unique:tipodocumentos,nombre|regex:/^[\pL\s\-]+$/u',
				'abreviatura' => 'required|unique:tipodocumentos,abreviatura|regex:/^[\pL\s\-]+$/u'

			];	
		} elseif(request()->isMethod('put')){
			return [
				'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
				'abreviatura' => 'required|regex:/^[\pL\s\-]+$/u'

			];
		}


		
    }
}
