<?php

namespace App\Http\Requests;

use App\Models\Voter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoterRequest extends FormRequest
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
            'leader_id' => [
                'required',
                Rule::exists('leaders', 'id'),
            ],
            'address' => 'nullable|string',
            //add entity enum parent validation
            'entity_parent' => [
                'required',
                Rule::in(\App\Enums\EntityParent::toArray()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.numeric' => 'El campo DNI solo debe contener números.',
            'dni.unique' => function ($attribute, $value, $fail) {
                $voter = Voter::whereDni($value)->first();
                if ($voter) {
                    $full_name = $voter->leader->full_name;
                    $dni = $voter->leader->dni;
                    $fail("El DNI ya está asociado con el Líder {$full_name} con DNI {$dni}.");
                }
            },
            'first_name.required' => 'El campo Nombre es obligatorio.',
            'first_name.string' => 'El campo Nombre solo debe contener letras.',
            'first_name.regex' => 'El campo Nombre solo debe contener letras.',
            'last_name.required' => 'El campo Apellido es obligatorio.',
            'last_name.string' => 'El campo Apellido solo debe contener letras.',
            'last_name.regex' => 'El campo Apellido solo debe contener letras.',
            'email.email' => 'El campo Email debe ser una dirección de correo electrónico válida.',
            'phone.numeric' => 'El campo Teléfono solo debe contener números.',
            'phone.digits' => 'El campo Teléfono debe contener 10 dígitos.',
            'place_id.required' => 'El campo Lugar es obligatorio.',
            'place_id.exists' => 'El campo Lugar no existe.',
            'leader_id.required' => 'El campo Líder es obligatorio.',
            'leader_id.exists' => 'El campo Líder no existe.',
            'parent_entity.required' => 'El campo Parentesco es obligatorio.',
            'parent_entity.in' => 'El campo Parentesco no es válido.',
        ];
    }
}