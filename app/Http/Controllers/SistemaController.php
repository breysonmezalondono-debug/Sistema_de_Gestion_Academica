<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Profesor;
use App\Models\Materia;

class SistemaController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function estudiantes()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes', compact('estudiantes'));
    }

    public function crearEstudiante()
    {
        return view('crearEstudiante');
    }

    public function guardarEstudiante(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:120',
            'correo' => 'required|email|max:255|unique:estudiantes',
            'programa' => 'required|string|max:255',
        ]);

        Estudiante::create($request->only([
            'nombre','apellido','edad','correo','programa'
        ]));

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante guardado correctamente');
    }

    public function editarEstudiante($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('crearEstudiante', compact('estudiante'));
    }

    public function actualizarEstudiante(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:120',
            'correo' => 'required|email|max:255|unique:estudiantes,correo,'.$id,
            'programa' => 'required|string|max:255',
        ]);

        $estudiante->update($request->only([
            'nombre','apellido','edad','correo','programa'
        ]));

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado');
    }

    public function eliminarEstudiante($id)
    {
        Estudiante::destroy($id);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado');
    }

    public function profesores()
    {
        $profesores = Profesor::all();
        return view('profesores', compact('profesores'));
    }

    public function crearProfesor()
    {
        return view('crearProfesor');
    }

    public function guardarProfesor(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:profesores',
        ]);

        Profesor::create($request->only([
            'nombre','apellido','correo'
        ]));

        return redirect()->route('profesores.index')->with('success', 'Profesor guardado correctamente');
    }

    public function editarProfesor($id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('crearProfesor', compact('profesor'));
    }

    public function actualizarProfesor(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:profesores,correo,'.$id,
        ]);

        $profesor->update($request->only([
            'nombre','apellido','correo'
        ]));

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado');
    }

    public function eliminarProfesor($id)
    {
        Profesor::destroy($id);
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado');
    }

    public function materias()
    {
        $materias = Materia::all();
        return view('materias', compact('materias'));
    }

    public function crearMateria()
    {
        return view('crearMateria');
    }

    public function guardarMateria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'creditos' => 'required|integer|min:1|max:10',
        ]);

        Materia::create($request->only([
            'nombre','descripcion','creditos'
        ]));

        return redirect()->route('materias.index')->with('success', 'Materia guardada correctamente');
    }

    public function editarMateria($id)
    {
        $materia = Materia::findOrFail($id);
        return view('crearMateria', compact('materia'));
    }

    public function actualizarMateria(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'creditos' => 'required|integer|min:1|max:10',
        ]);

        $materia->update($request->only([
            'nombre','descripcion','creditos'
        ]));

        return redirect()->route('materias.index')->with('success', 'Materia actualizada');
    }

    public function eliminarMateria($id)
    {
        Materia::destroy($id);
        return redirect()->route('materias.index')->with('success', 'Materia eliminada');
    }
}
