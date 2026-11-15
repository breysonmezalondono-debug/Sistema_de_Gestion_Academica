<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:departamentos,codigo,' . $this->route('departamento'),
            'descripcion' => 'nullable|string|max:500',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return (new StoreDepartamentoRequest)->messages();
    }
}
