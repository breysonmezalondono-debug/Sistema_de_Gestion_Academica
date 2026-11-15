<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo_universitario' => 'required|string|max:20|unique:estudiantes,codigo_universitario,' . $this->route('estudiante'),
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:120',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:estudiantes,correo,' . $this->route('estudiante'),
            'fecha_nacimiento' => 'required|date|before:today',
            'programa' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return (new StoreEstudianteRequest)->messages();
    }
}
