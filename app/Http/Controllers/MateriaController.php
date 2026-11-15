<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use App\Models\Departamento;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with(['profesor', 'departamento'])
            ->when(request('search'), function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhere('semestre', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $profesores = Profesor::where('estado', 'Activo')->orderBy('nombre')->get();
        $departamentos = Departamento::where('estado', 'Activo')->orderBy('nombre')->get();
        return view('materias.create', compact('profesores', 'departamentos'));
    }

    public function store(StoreMateriaRequest $request)
    {
        Materia::create($request->validated());

        return redirect()->route('materias.index')
            ->with('success', 'Materia creada correctamente.');
    }

    public function edit(Materia $materia)
    {
        $profesores = Profesor::where('estado', 'Activo')->orderBy('nombre')->get();
        $departamentos = Departamento::where('estado', 'Activo')->orderBy('nombre')->get();
        return view('materias.edit', compact('materia', 'profesores', 'departamentos'));
    }

    public function update(UpdateMateriaRequest $request, Materia $materia)
    {
        $materia->update($request->validated());

        return redirect()->route('materias.index')
            ->with('success', 'Materia actualizada correctamente.');
    }

    public function disponibles()
    {
        $user = Auth::user();
        $miEstudiante = $user->estudiante;

        if (!$miEstudiante) {
            return redirect()->route('estudiantes.create')
                ->with('info', 'Primero completa tu perfil de estudiante.');
        }

        $materias = Materia::with(['profesor', 'aula', 'departamento'])
            ->where('estado', 'Activo')
            ->orderBy('semestre')
            ->orderBy('nombre')
            ->get();

        $misMateriasIds = $miEstudiante->materias()->pluck('materias.id')->toArray();

        return view('materias.disponibles', compact('materias', 'miEstudiante', 'misMateriasIds'));
    }

    public function destroy(Materia $materia)
    {
        // Cancelar inscripciones activas en lugar de eliminarlas
        $materia->inscripciones()
            ->where('estado', 'Activo')
            ->update(['estado' => 'Cancelado']);

        $materia->delete();

        return redirect()->route('materias.index')
            ->with('success', 'Materia eliminada correctamente.');
    }
}
