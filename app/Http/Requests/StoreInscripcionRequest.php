<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscripcionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estudiante_id' => 'required|exists:estudiantes,id',
            'materia_id' => 'required|exists:materias,id',
            'fecha_inscripcion' => 'required|date',
            'periodo' => 'required|string|max:20',
            'estado' => 'required|in:Activo,Cancelado,Completado',
        ];
    }

    public function messages(): array
    {
        return [
            'estudiante_id.required' => 'Debe seleccionar un estudiante.',
            'estudiante_id.exists' => 'El estudiante seleccionado no existe.',
            'materia_id.required' => 'Debe seleccionar una materia.',
            'materia_id.exists' => 'La materia seleccionada no existe.',
            'fecha_inscripcion.required' => 'La fecha de inscripción es obligatoria.',
            'periodo.required' => 'El periodo académico es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
