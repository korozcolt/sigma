<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class PlaceRequest extends FormRequest
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
            'place'=> 'required|string|regex:/^[\pL\s]+$/u',
            'table'=> 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'place.required' => 'El campo Lugar es obligatorio.',
            'place.string' => 'El campo Lugar solo debe contener letras.',
            'place.regex' => 'El campo Lugar solo debe contener letras.',
            'table.required' => 'El campo Mesa es obligatorio.',
            'table.integer' => 'El campo Mesa solo debe contener números.',
        ];
    }
}