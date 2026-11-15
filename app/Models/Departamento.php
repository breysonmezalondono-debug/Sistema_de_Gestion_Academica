<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'estado',
    ];

    public function profesores()
    {
        return $this->hasMany(Profesor::class, 'departamento_id');
    }

    public function materias()
    {
        return $this->hasMany(Materia::class, 'departamento_id');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado', 'Activo');
    }
}
