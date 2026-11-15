<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAulaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => 'required|string|max:20',
            'edificio' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1|max:500',
            'piso' => 'required|integer|min:0|max:50',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'numero.required' => 'El número de aula es obligatorio.',
            'edificio.required' => 'El edificio es obligatorio.',
            'capacidad.required' => 'La capacidad es obligatoria.',
            'capacidad.integer' => 'La capacidad debe ser un número entero.',
            'capacidad.min' => 'La capacidad mínima es 1.',
            'piso.required' => 'El piso es obligatorio.',
            'piso.integer' => 'El piso debe ser un número entero.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
