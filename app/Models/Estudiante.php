<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'user_id',
        'codigo_universitario',
        'nombre',
        'apellido',
        'edad',
        'sexo',
        'direccion',
        'telefono',
        'correo',
        'fecha_nacimiento',
        'programa',
        'carrera',
        'fotografia',
        'estado',
    ];

    protected $casts = [
        'edad' => 'integer',
        'fecha_nacimiento' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'estudiante_materia')
            ->withPivot('fecha_inscripcion', 'periodo', 'estado')
            ->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(EstudianteMateria::class, 'estudiante_id');
    }
}
