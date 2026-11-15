<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo_universitario' => 'required|string|max:20|unique:estudiantes,codigo_universitario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:120',
            'sexo' => 'required|in:Masculino,Femenino,Otro',
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:estudiantes,correo',
            'fecha_nacimiento' => 'required|date|before:today',
            'programa' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo_universitario.required' => 'El código universitario es obligatorio.',
            'codigo_universitario.unique' => 'Este código universitario ya está registrado.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'edad.min' => 'La edad mínima es 1.',
            'edad.max' => 'La edad máxima es 120.',
            'sexo.required' => 'El sexo es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before' => 'La fecha debe ser anterior a hoy.',
            'programa.required' => 'El programa es obligatorio.',
            'carrera.required' => 'La carrera es obligatoria.',
            'fotografia.image' => 'El archivo debe ser una imagen.',
            'fotografia.mimes' => 'La imagen debe ser jpeg, png, jpg o webp.',
            'fotografia.max' => 'La imagen no debe superar los 2MB.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
