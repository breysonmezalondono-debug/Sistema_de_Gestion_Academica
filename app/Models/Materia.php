<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    protected $fillable = [
        'nombre',
        'codigo',
        'creditos',
        'horas_semanales',
        'cupo_maximo',
        'profesor_id',
        'departamento_id',
        'aula_id',
        'semestre',
        'estado',
    ];

    protected $casts = [
        'creditos' => 'integer',
        'horas_semanales' => 'integer',
        'cupo_maximo' => 'integer',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'estudiante_materia')
            ->withPivot('fecha_inscripcion', 'periodo', 'estado')
            ->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(EstudianteMateria::class, 'materia_id');
    }
}
