<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CoordinatorUpdateRequest extends FormRequest
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
            'first_name' => 'required|string|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|string|regex:/^[\pL\s]+$/u',
            'phone' => 'nullable|numeric|digits:10',
            'place_id' => [
                'required',
                Rule::exists('places', 'id'),
            ],
            'user_id' => [
                'required',
                Rule::exists('users', 'id'),
            ],
            'address' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El campo Nombre es obligatorio.',
            'first_name.string' => 'El campo Nombre solo debe contener letras.',
            'first_name.regex' => 'El campo Nombre solo debe contener letras.',
            'last_name.required' => 'El campo Apellido es obligatorio.',
            'last_name.string' => 'El campo Apellido solo debe contener letras.',
            'last_name.regex' => 'El campo Apellido solo debe contener letras.',
            'phone.numeric' => 'El campo Teléfono solo debe contener números.',
            'user_id.required' => 'Debe haber al menos un usuario',
            'user_id.exists' => 'El usuario no existe.',
            'place_id.required' => 'El campo Lugar es obligatorio.',
            'place_id.exists' => 'El campo Lugar no existe.',
        ];
    }
}