<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;

Route::get('/', [SistemaController::class, 'inicio'])->name('inicio');

Route::get('/estudiantes', [SistemaController::class, 'estudiantes'])->name('estudiantes.index');
Route::get('/estudiantes/crear', [SistemaController::class, 'crearEstudiante'])->name('estudiantes.create');
Route::post('/estudiantes', [SistemaController::class, 'guardarEstudiante'])->name('estudiantes.store');
Route::get('/estudiantes/{id}/editar', [SistemaController::class, 'editarEstudiante'])->name('estudiantes.edit');
Route::put('/estudiantes/{id}', [SistemaController::class, 'actualizarEstudiante'])->name('estudiantes.update');
Route::delete('/estudiantes/{id}', [SistemaController::class, 'eliminarEstudiante'])->name('estudiantes.destroy');


Route::get('/profesores', [SistemaController::class, 'profesores'])->name('profesores.index');
Route::get('/profesores/crear', [SistemaController::class, 'crearProfesor'])->name('profesores.create');
Route::post('/profesores', [SistemaController::class, 'guardarProfesor'])->name('profesores.store');
Route::get('/profesores/{id}/editar', [SistemaController::class, 'editarProfesor'])->name('profesores.edit');
Route::put('/profesores/{id}', [SistemaController::class, 'actualizarProfesor'])->name('profesores.update');
Route::delete('/profesores/{id}', [SistemaController::class, 'eliminarProfesor'])->name('profesores.destroy');


Route::get('/materias', [SistemaController::class, 'materias'])->name('materias.index');
Route::get('/materias/crear', [SistemaController::class, 'crearMateria'])->name('materias.create');
Route::post('/materias', [SistemaController::class, 'guardarMateria'])->name('materias.store');
Route::get('/materias/{id}/editar', [SistemaController::class, 'editarMateria'])->name('materias.edit');
Route::put('/materias/{id}', [SistemaController::class, 'actualizarMateria'])->name('materias.update');
Route::delete('/materias/{id}', [SistemaController::class, 'eliminarMateria'])->name('materias.destroy');
