<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMateriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:materias,codigo,' . $this->route('materia'),
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
        return (new StoreMateriaRequest)->messages();
    }
}
