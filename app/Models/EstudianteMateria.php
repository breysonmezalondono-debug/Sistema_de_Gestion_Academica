<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EstudianteMateria extends Pivot
{
    protected $table = 'estudiante_materia';

    protected $fillable = [
        'estudiante_id',
        'materia_id',
        'fecha_inscripcion',
        'periodo',
        'estado',
    ];

    protected $casts = [
        'fecha_inscripcion' => 'date',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
