<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Departamento;
use App\Models\Estudiante;
use App\Models\EstudianteMateria;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->esEstudiante()) {
            $miEstudiante = $user->estudiante;
            $totalInscripciones = $miEstudiante ? EstudianteMateria::where('estudiante_id', $miEstudiante->id)->count() : 0;
            $totalMaterias = $miEstudiante ? $miEstudiante->materias()->count() : 0;
            $inscripcionesActivas = $miEstudiante ? EstudianteMateria::where('estudiante_id', $miEstudiante->id)->where('estado', 'Activo')->count() : 0;
            $inscripcionesCompletadas = $miEstudiante ? EstudianteMateria::where('estudiante_id', $miEstudiante->id)->where('estado', 'Completado')->count() : 0;

            $misInscripciones = $miEstudiante
                ? EstudianteMateria::with(['materia.aula', 'materia.profesor'])
                    ->where('estudiante_id', $miEstudiante->id)
                    ->latest()->get()
                : collect();

            return view('dashboard.estudiante', compact(
                'totalInscripciones',
                'totalMaterias',
                'inscripcionesActivas',
                'inscripcionesCompletadas',
                'misInscripciones',
                'miEstudiante',
            ));
        }

        $totalEstudiantes = Estudiante::count();
        $totalProfesores = Profesor::count();
        $totalMaterias = Materia::count();
        $totalDepartamentos = Departamento::count();
        $totalAulas = Aula::count();
        $totalInscripciones = EstudianteMateria::count();

        $ultimosEstudiantes = Estudiante::latest()->take(5)->get();
        $ultimasMaterias = Materia::with('profesor')->latest()->take(5)->get();
        $ultimosProfesores = Profesor::latest()->take(5)->get();

        $estudiantesPorEstado = [
            Estudiante::where('estado', 'Activo')->count(),
            Estudiante::where('estado', 'Inactivo')->count(),
        ];

        $materiasPorSemestre = Materia::selectRaw('semestre, count(*) as total')
            ->groupBy('semestre')
            ->orderBy('total', 'desc')
            ->get();

        return view('dashboard.index', compact(
            'totalEstudiantes',
            'totalProfesores',
            'totalMaterias',
            'totalDepartamentos',
            'totalAulas',
            'totalInscripciones',
            'ultimosEstudiantes',
            'ultimasMaterias',
            'ultimosProfesores',
            'estudiantesPorEstado',
            'materiasPorSemestre',
        ));
    }
}
