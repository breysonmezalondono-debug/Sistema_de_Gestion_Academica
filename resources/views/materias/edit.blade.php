@extends('layouts.admin')

@section('title', 'Editar Materia - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('materias.update', $materia) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre" name="nombre" value="{{ old('nombre', $materia->nombre) }}" placeholder=" " required>
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                   id="codigo" name="codigo" value="{{ old('codigo', $materia->codigo) }}" placeholder=" " required>
                            <label for="codigo">Código <span class="text-danger">*</span></label>
                            @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('creditos') is-invalid @enderror"
                                   id="creditos" name="creditos" value="{{ old('creditos', $materia->creditos) }}" min="1" max="20" placeholder=" " required>
                            <label for="creditos">Créditos <span class="text-danger">*</span></label>
                            @error('creditos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('horas_semanales') is-invalid @enderror"
                                   id="horas_semanales" name="horas_semanales"
                                   value="{{ old('horas_semanales', $materia->horas_semanales) }}" min="0" max="40" placeholder=" " required>
                            <label for="horas_semanales">Horas semanales <span class="text-danger">*</span></label>
                            @error('horas_semanales')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('cupo_maximo') is-invalid @enderror"
                                   id="cupo_maximo" name="cupo_maximo"
                                   value="{{ old('cupo_maximo', $materia->cupo_maximo) }}" min="1" max="200" placeholder=" " required>
                            <label for="cupo_maximo">Cupo máximo <span class="text-danger">*</span></label>
                            @error('cupo_maximo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating-modern">
                            <select class="form-select @error('semestre') is-invalid @enderror" id="semestre" name="semestre" required>
                                <option value=""></option>
                                @foreach(['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Séptimo', 'Octavo', 'Noveno', 'Décimo'] as $s)
                                    <option value="{{ $s }}" {{ old('semestre', $materia->semestre) === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            <label for="semestre">Semestre <span class="text-danger">*</span></label>
                            @error('semestre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('profesor_id') is-invalid @enderror" id="profesor_id" name="profesor_id">
                                <option value=""></option>
                                @foreach($profesores as $profesor)
                                    <option value="{{ $profesor->id }}" {{ old('profesor_id', $materia->profesor_id) == $profesor->id ? 'selected' : '' }}>
                                        {{ $profesor->nombre }} {{ $profesor->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="profesor_id">Profesor asignado</label>
                            @error('profesor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('departamento_id') is-invalid @enderror" id="departamento_id" name="departamento_id">
                                <option value=""></option>
                                @foreach($departamentos as $dept)
                                    <option value="{{ $dept->id }}" {{ old('departamento_id', $materia->departamento_id) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="departamento_id">Departamento</label>
                            @error('departamento_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value=""></option>
                                <option value="Activo" {{ old('estado', $materia->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $materia->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid var(--gray-100);">
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="bi bi-floppy-fill"></i>Actualizar materia
                    </button>
                    <a href="{{ route('materias.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
