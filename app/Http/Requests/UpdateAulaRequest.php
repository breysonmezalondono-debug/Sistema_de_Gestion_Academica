<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAulaRequest extends FormRequest
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
        return (new StoreAulaRequest)->messages();
    }
}
