<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para perfiles propios (estudiantes y profesores)
    Route::get('/estudiantes/crear', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{estudiante}/editar', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');

    Route::get('/profesores/crear', [ProfesorController::class, 'create'])->name('profesores.create');
    Route::post('/profesores', [ProfesorController::class, 'store'])->name('profesores.store');
    Route::get('/profesores/{profesor}/editar', [ProfesorController::class, 'edit'])->name('profesores.edit');
    Route::put('/profesores/{profesor}', [ProfesorController::class, 'update'])->name('profesores.update');

    // Rutas para estudiantes: seleccionar materias e inscribirse
    Route::get('/mis-materias', [MateriaController::class, 'disponibles'])->name('materias.disponibles');
    Route::post('/mis-materias/inscribir/{materia}', [InscripcionController::class, 'selfEnroll'])->name('materias.self-enroll');

    // Gestión completa: solo admin/profesor
    Route::middleware('role:admin,profesor')->group(function () {
        Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');
        Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');

        Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
        Route::delete('/profesores/{profesor}', [ProfesorController::class, 'destroy'])->name('profesores.destroy');

        Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
        Route::get('/materias/crear', [MateriaController::class, 'create'])->name('materias.create');
        Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
        Route::get('/materias/{materia}/editar', [MateriaController::class, 'edit'])->name('materias.edit');
        Route::put('/materias/{materia}', [MateriaController::class, 'update'])->name('materias.update');
        Route::delete('/materias/{materia}', [MateriaController::class, 'destroy'])->name('materias.destroy');

        Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
        Route::get('/departamentos/crear', [DepartamentoController::class, 'create'])->name('departamentos.create');
        Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');
        Route::get('/departamentos/{departamento}/editar', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
        Route::put('/departamentos/{departamento}', [DepartamentoController::class, 'update'])->name('departamentos.update');
        Route::delete('/departamentos/{departamento}', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');

        Route::get('/aulas', [AulaController::class, 'index'])->name('aulas.index');
        Route::get('/aulas/crear', [AulaController::class, 'create'])->name('aulas.create');
        Route::post('/aulas', [AulaController::class, 'store'])->name('aulas.store');
        Route::get('/aulas/{aula}/editar', [AulaController::class, 'edit'])->name('aulas.edit');
        Route::put('/aulas/{aula}', [AulaController::class, 'update'])->name('aulas.update');
        Route::delete('/aulas/{aula}', [AulaController::class, 'destroy'])->name('aulas.destroy');

        Route::get('/inscripciones', [InscripcionController::class, 'index'])->name('inscripciones.index');
        Route::get('/inscripciones/crear', [InscripcionController::class, 'create'])->name('inscripciones.create');
        Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
        Route::delete('/inscripciones/{estudianteMateria}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy');
    });
});