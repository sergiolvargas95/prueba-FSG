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
            'foto.required' => 'Debe seleccionar una imagen.',
            'foto.mimes' => 'Solo se permiten imágenes JPG, JPEG o PNG.',
            'foto.max' => 'La imagen no debe superar los 2MB.',
        ];
    }
}
