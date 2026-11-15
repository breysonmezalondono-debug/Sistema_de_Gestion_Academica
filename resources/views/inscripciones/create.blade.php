@extends('layouts.admin')

@section('title', 'Nueva Inscripción - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('inscripciones.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('estudiante_id') is-invalid @enderror" id="estudiante_id" name="estudiante_id" required>
                                <option value=""></option>
                                @foreach($estudiantes as $est)
                                    <option value="{{ $est->id }}" {{ old('estudiante_id', $estudianteId ?? '') == $est->id ? 'selected' : '' }}>
                                        {{ $est->codigo_universitario }} - {{ $est->nombre }} {{ $est->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="estudiante_id">Estudiante <span class="text-danger">*</span></label>
                            @error('estudiante_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('materia_id') is-invalid @enderror" id="materia_id" name="materia_id" required>
                                <option value=""></option>
                                @foreach($materias as $mat)
                                    <option value="{{ $mat->id }}" {{ old('materia_id') == $mat->id ? 'selected' : '' }}>
                                        {{ $mat->codigo }} - {{ $mat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="materia_id">Materia <span class="text-danger">*</span></label>
                            @error('materia_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <input type="date" class="form-control @error('fecha_inscripcion') is-invalid @enderror"
                                   id="fecha_inscripcion" name="fecha_inscripcion"
                                   value="{{ old('fecha_inscripcion', date('Y-m-d')) }}" placeholder=" " required>
                            <label for="fecha_inscripcion">Fecha de inscripción <span class="text-danger">*</span></label>
                            @error('fecha_inscripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('periodo') is-invalid @enderror"
                                   id="periodo" name="periodo" value="{{ old('periodo', date('Y') . '-' . (date('Y')+1)) }}" placeholder=" " required>
                            <label for="periodo">Periodo académico <span class="text-danger">*</span></label>
                            @error('periodo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value=""></option>
                                <option value="Activo" {{ old('estado') === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Cancelado" {{ old('estado') === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="Completado" {{ old('estado') === 'Completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid var(--gray-100);">
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="bi bi-floppy-fill"></i>Guardar inscripción
                    </button>
                    <a href="{{ route('inscripciones.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
