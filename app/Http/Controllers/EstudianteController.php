<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('correo', 'like', "%{$search}%")
                    ->orWhere('codigo_universitario', 'like', "%{$search}%")
                    ->orWhere('programa', 'like', "%{$search}%")
                    ->orWhere('carrera', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        if (Auth::user()->esEstudiante() && Auth::user()->estudiante) {
            return redirect()->route('estudiantes.edit', Auth::user()->estudiante)
                ->with('info', 'Ya tienes un perfil de estudiante. Puedes editarlo aquí.');
        }

        return view('estudiantes.create');
    }

    public function store(StoreEstudianteRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('estudiantes', 'public');
        }

        $data['user_id'] = Auth::id();

        $estudiante = Estudiante::create($data);

        if (Auth::user()->esEstudiante()) {
            return redirect()->route('materias.disponibles')
                ->with('success', 'Perfil completado. Ahora selecciona las materias que deseas estudiar.');
        }

        return redirect()->route('inscripciones.create')
            ->with('success', 'Estudiante creado. Ahora puedes inscribirlo en una materia.')
            ->with('estudiante_reciente', $estudiante->id);
    }

    public function edit(Estudiante $estudiante)
    {
        if (Auth::user()->esEstudiante() && (!$estudiante->user_id || $estudiante->user_id !== Auth::id())) {
            abort(403, 'No puedes editar el perfil de otro estudiante.');
        }

        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(UpdateEstudianteRequest $request, Estudiante $estudiante)
    {
        if (Auth::user()->esEstudiante() && (!$estudiante->user_id || $estudiante->user_id !== Auth::id())) {
            abort(403, 'No puedes editar el perfil de otro estudiante.');
        }

        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            if ($estudiante->fotografia) {
                Storage::disk('public')->delete($estudiante->fotografia);
            }
            $data['fotografia'] = $request->file('fotografia')->store('estudiantes', 'public');
        }

        $estudiante->update($data);

        if (Auth::user()->esEstudiante()) {
            return redirect()->route('dashboard')
                ->with('success', 'Perfil actualizado correctamente.');
        }

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        if (Auth::user()->esEstudiante()) {
            abort(403, 'No tienes permiso para eliminar perfiles.');
        }

        // Cancelar inscripciones activas en lugar de eliminarlas
        $estudiante->inscripciones()
            ->where('estado', 'Activo')
            ->update(['estado' => 'Cancelado']);

        if ($estudiante->fotografia) {
            Storage::disk('public')->delete($estudiante->fotografia);
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }
}
