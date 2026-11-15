<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInscripcionRequest;
use App\Models\Estudiante;
use App\Models\EstudianteMateria;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = EstudianteMateria::with(['estudiante', 'materia'])
            ->when(request('search'), function ($query, $search) {
                $query->whereHas('estudiante', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%");
                })->orWhereHas('materia', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $estudiantes = Estudiante::where('estado', 'Activo')->orderBy('nombre')->get();
        $materias = Materia::where('estado', 'Activo')->orderBy('nombre')->get();
        $estudianteId = session('estudiante_reciente');
        return view('inscripciones.create', compact('estudiantes', 'materias', 'estudianteId'));
    }

    public function store(StoreInscripcionRequest $request)
    {
        EstudianteMateria::create($request->validated());

        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción creada correctamente.');
    }

    public function selfEnroll(Materia $materia)
    {
        $user = Auth::user();
        $miEstudiante = $user->estudiante;

        if (!$miEstudiante) {
            return redirect()->route('estudiantes.create')
                ->with('info', 'Primero completa tu perfil de estudiante.');
        }

        if ($materia->estado !== 'Activo') {
            return redirect()->route('materias.disponibles')
                ->with('error', 'Esta materia no está disponible.');
        }

        $yaInscrito = EstudianteMateria::where('estudiante_id', $miEstudiante->id)
            ->where('materia_id', $materia->id)
            ->exists();

        if ($yaInscrito) {
            return redirect()->route('materias.disponibles')
                ->with('info', 'Ya estás inscrito en esta materia.');
        }

        EstudianteMateria::create([
            'estudiante_id' => $miEstudiante->id,
            'materia_id' => $materia->id,
            'fecha_inscripcion' => now(),
            'periodo' => date('Y') . '-' . (date('Y') + 1),
            'estado' => 'Activo',
        ]);

        $aulaInfo = $materia->aula ? "Aula {$materia->aula->numero}, Edificio {$materia->aula->edificio}" : 'Por asignar';

        return redirect()->route('materias.disponibles')
            ->with('success', "Usted fue inscrito correctamente en {$materia->nombre}. Su aula es: {$aulaInfo}.");
    }

    public function destroy(EstudianteMateria $estudianteMateria)
    {
        // Cambiar estado a Cancelado en lugar de eliminar
        $estudianteMateria->update(['estado' => 'Cancelado']);

        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción cancelada correctamente.');
    }
}
