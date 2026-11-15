<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('numero', 'like', "%{$search}%")
                    ->orWhere('edificio', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('aulas.index', compact('aulas'));
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:aulas',
            'edificio' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'piso' => 'required|integer|min:0',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Aula::create($validated);

        return redirect()->route('aulas.index')
            ->with('success', 'Aula creada correctamente.');
    }

    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula'));
    }

    public function update(Request $request, Aula $aula)
    {
        $validated = $request->validate([
            'numero' => 'required|string|unique:aulas,numero,' . $aula->id,
            'edificio' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'piso' => 'required|integer|min:0',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $aula->update($validated);

        return redirect()->route('aulas.index')
            ->with('success', 'Aula actualizada correctamente.');
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();

        return redirect()->route('aulas.index')
            ->with('success', 'Aula eliminada correctamente.');
    }
}