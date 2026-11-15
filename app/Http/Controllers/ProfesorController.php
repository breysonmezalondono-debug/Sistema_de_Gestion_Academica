<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesorRequest;
use App\Http\Requests\UpdateProfesorRequest;
use App\Models\Departamento;
use App\Models\Profesor;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::with('departamento')
            ->when(request('search'), function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhere('especialidad', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('profesores.index', compact('profesores'));
    }

    public function create()
    {
        if (Auth::user()->esProfesor() && Auth::user()->profesor) {
            return redirect()->route('profesores.edit', Auth::user()->profesor)
                ->with('info', 'Ya tienes un perfil de profesor. Puedes editarlo aquí.');
        }

        $departamentos = Departamento::where('estado', 'Activo')->orderBy('nombre')->get();
        return view('profesores.create', compact('departamentos'));
    }

    public function store(StoreProfesorRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Profesor::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Perfil de profesor creado correctamente.');
    }

    public function edit(Profesor $profesor)
    {
        if (!Auth::user()->esAdmin() && (!$profesor->user_id || $profesor->user_id !== Auth::id())) {
            abort(403, 'No puedes editar el perfil de otro profesor.');
        }

        $departamentos = Departamento::where('estado', 'Activo')->orderBy('nombre')->get();
        return view('profesores.edit', compact('profesor', 'departamentos'));
    }

    public function update(UpdateProfesorRequest $request, Profesor $profesor)
    {
        if (!Auth::user()->esAdmin() && (!$profesor->user_id || $profesor->user_id !== Auth::id())) {
            abort(403, 'No puedes editar el perfil de otro profesor.');
        }

        $profesor->update($request->validated());

        if (Auth::user()->esProfesor()) {
            return redirect()->route('dashboard')
                ->with('success', 'Perfil actualizado correctamente.');
        }

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(Profesor $profesor)
    {
        if (!Auth::user()->esAdmin()) {
            abort(403, 'No tienes permiso para eliminar perfiles.');
        }

        // Cambiar materias asignadas a este profesor a null
        $profesor->materias()->update(['profesor_id' => null]);

        $profesor->delete();

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor eliminado correctamente.');
    }
}
