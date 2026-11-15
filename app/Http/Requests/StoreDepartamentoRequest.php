<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:departamentos,codigo',
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del departamento es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'Este código ya está en uso.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
