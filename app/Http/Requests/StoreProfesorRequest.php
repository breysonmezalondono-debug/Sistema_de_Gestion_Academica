<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfesorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required|string|max:20|unique:profesores,codigo',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:profesores,correo',
            'direccion' => 'required|string|max:500',
            'fecha_contratacion' => 'required|date',
            'salario' => 'nullable|numeric|min:0',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'Este código ya está en uso.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'especialidad.required' => 'La especialidad es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'fecha_contratacion.required' => 'La fecha de contratación es obligatoria.',
            'salario.numeric' => 'El salario debe ser un valor numérico.',
            'departamento_id.exists' => 'El departamento seleccionado no existe.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
