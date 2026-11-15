<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table = 'aulas';

    protected $fillable = [
        'numero',
        'edificio',
        'capacidad',
        'piso',
        'estado',
    ];

    protected $casts = [
        'capacidad' => 'integer',
        'piso' => 'integer',
    ];

    public function materias()
    {
        return $this->hasMany(Materia::class, 'aula_id');
    }
}
