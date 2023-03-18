<?php

namespace App\Http\Requests;

use App\Models\Leader;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeaderRequest extends FormRequest
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
            'dni' => 'required|numeric|digits_between:6,11|unique:leaders,dni',
            'first_name' => 'required|string|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|string|regex:/^[\pL\s]+$/u',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric|digits:10',
            'place_id' => [
                'required',
                Rule::exists('places', 'id'),
            ],
            'user_id' => [
                'required',
                Rule::exists('users', 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El DNI es requerido',
            'dni.numeric' => 'El DNI solo debe contener números',
            'dni.unique' => function ($attribute, $value, $fail) {
                $leader = Leader::whereDni($value)->first();
                if ($leader) {
                    $full_name = $leader->coordinator->full_name;
                    $dni = $leader->coordinator->dni;
                    $fail("El DNI ya está asociado con el Líder {$full_name} con DNI {$dni}.");
                }
            },
            'dni.digits_between' => 'El DNI solo debe contener entre 6 y 11 números',
            'first_name.required' => 'El campo Nombre es obligatorio.',
            'first_name.string' => 'El campo Nombre solo debe contener letras.',
            'first_name.regex' => 'El campo Nombre solo debe contener letras.',
            'last_name.required' => 'El campo Apellido es obligatorio.',
            'last_name.string' => 'El campo Apellido solo debe contener letras.',
            'last_name.regex' => 'El campo Apellido solo debe contener letras.',
            'email.email' => 'El campo Email debe ser una dirección de correo electrónico válida.',
            'phone.numeric' => 'El campo Teléfono solo debe contener números.',
            'place_id.required' => 'El campo Lugar es obligatorio.',
            'user_id.required' => 'El campo Usuario es obligatorio.',
        ];
    }
}
