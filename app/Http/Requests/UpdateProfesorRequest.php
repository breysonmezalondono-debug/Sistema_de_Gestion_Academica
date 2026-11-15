<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required|string|max:20|unique:profesores,codigo,' . $this->route('profesor'),
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:profesores,correo,' . $this->route('profesor'),
            'direccion' => 'required|string|max:500',
            'fecha_contratacion' => 'required|date',
            'salario' => 'nullable|numeric|min:0',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return (new StoreProfesorRequest)->messages();
    }
}
