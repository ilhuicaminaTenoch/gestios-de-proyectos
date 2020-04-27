<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class UsuarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:App\User'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'email.sometimes' => 'El :attribute es obligatorio.',
            'password.required' => 'El :attribute es obligatorio.',
            'password.min' => 'El :attribute debe tener al menos 8 caracteres.',
            'email.unique' => 'El :attribute ya se ha sido registrado.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del usuario',
            'email' => 'email del usuario',
            'password' => 'contrasena',
        ];
    }
}
