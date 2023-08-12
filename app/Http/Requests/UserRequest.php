<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,super_admin,leader,coordinator,digitizer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.string' => 'El campo Nombre debe ser una cadena de caracteres.',
            'name.max' => 'El campo Nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El campo Email es obligatorio.',
            'email.email' => 'El campo Email debe ser una dirección de correo válida.',
            'email.unique' => 'El Email ya está en uso.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.string' => 'El campo Contraseña debe ser una cadena de caracteres.',
            'password.min' => 'El campo Contraseña debe contener al menos 8 caracteres.',
            'role.required' => 'El campo Rol es obligatorio.',
            'role.in' => 'El campo Rol seleccionado no es válido.',
        ];
    }
}
