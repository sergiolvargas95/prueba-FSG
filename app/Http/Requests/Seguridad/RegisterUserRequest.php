<?php

namespace App\Http\Requests\Seguridad;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'usuarioAlias'     => 'required|string|max:75|unique:seg_usuario,usuarioAlias',
            'usuarioPassword'  => 'required|string|min:6|confirmed',
            'usuarioNombre'    => 'required|string|max:100',
            'usuarioEmail'     => 'required|email|max:100|unique:seg_usuario,usuarioEmail',
        ];
    }

    public function messages()
    {
        return [
            'usuarioAlias.required' => 'El campo usuario es requerido.',
            'usuarioAlias.string'   => 'El usuario debe ser una cadena de texto.',
            'usuarioAlias.max'      => 'El usuario no debe exceder los 75 caracteres.',
            'usuarioAlias.unique'   => 'El usuario ya se encuentra registrado.',

            'usuarioPassword.required'  => 'El campo contraseña es requerido.',
            'usuarioPassword.string'    => 'La contraseña debe ser una cadena de texto.',
            'usuarioPassword.min'       => 'La contraseña debe tener al menos 6 caracteres.',
            'usuarioPassword.confirmed' => 'La confirmación de la contraseña no coincide.',

            'usuarioNombre.required' => 'El campo nombre completo es requerido.',
            'usuarioNombre.string'   => 'El nombre completo debe ser una cadena de texto.',
            'usuarioNombre.max'      => 'El nombre completo no debe exceder los 100 caracteres.',

            'usuarioEmail.required' => 'El campo correo electrónico es requerido.',
            'usuarioEmail.email'    => 'Debe ingresar un correo electrónico válido.',
            'usuarioEmail.max'      => 'El correo electrónico no debe exceder los 100 caracteres.',
            'usuarioEmail.unique'   => 'El correo electrónico ya está registrado.',
        ];
    }
}
