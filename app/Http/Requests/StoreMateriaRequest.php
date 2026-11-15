<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:materias,codigo',
            'creditos' => 'required|integer|min:1|max:20',
            'horas_semanales' => 'required|integer|min:0|max:40',
            'cupo_maximo' => 'required|integer|min:1|max:200',
            'profesor_id' => 'nullable|exists:profesores,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'semestre' => 'required|string|max:20',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la materia es obligatorio.',
            'codigo.required' => 'El código es obligatorio.',
            'codigo.unique' => 'Este código ya está en uso.',
            'creditos.required' => 'Los créditos son obligatorios.',
            'creditos.integer' => 'Los créditos deben ser un número entero.',
            'creditos.min' => 'Los créditos mínimos son 1.',
            'creditos.max' => 'Los créditos máximos son 20.',
            'horas_semanales.required' => 'Las horas semanales son obligatorias.',
            'horas_semanales.integer' => 'Las horas semanales deben ser un número entero.',
            'cupo_maximo.required' => 'El cupo máximo es obligatorio.',
            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero.',
            'profesor_id.exists' => 'El profesor seleccionado no existe.',
            'departamento_id.exists' => 'El departamento seleccionado no existe.',
            'semestre.required' => 'El semestre es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
