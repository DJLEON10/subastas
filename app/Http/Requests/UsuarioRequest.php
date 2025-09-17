<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(request()->isMethod('post')){
			return [
				'name' => 'required',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|same:confirm_password'
			];	
		} elseif(request()->isMethod('put')){
			return [
				'roles' => 'required'
			];
		}
    }
}
