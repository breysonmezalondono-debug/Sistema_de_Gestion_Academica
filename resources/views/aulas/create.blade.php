@extends('layouts.admin')

@section('title', 'Nueva Aula - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('aulas.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                   id="numero" name="numero" value="{{ old('numero') }}" placeholder=" " required>
                            <label for="numero">Número de aula <span class="text-danger">*</span></label>
                            @error('numero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('edificio') is-invalid @enderror"
                                   id="edificio" name="edificio" value="{{ old('edificio') }}" placeholder=" " required>
                            <label for="edificio">Edificio <span class="text-danger">*</span></label>
                            @error('edificio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('capacidad') is-invalid @enderror"
                                   id="capacidad" name="capacidad" value="{{ old('capacidad') }}" min="1" max="500" placeholder=" " required>
                            <label for="capacidad">Capacidad <span class="text-danger">*</span></label>
                            @error('capacidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('piso') is-invalid @enderror"
                                   id="piso" name="piso" value="{{ old('piso') }}" min="0" max="50" placeholder=" " required>
                            <label for="piso">Piso <span class="text-danger">*</span></label>
                            @error('piso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating-modern">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value=""></option>
                                <option value="Activo" {{ old('estado') === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid var(--gray-100);">
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="bi bi-floppy-fill"></i>Guardar aula
                    </button>
                    <a href="{{ route('aulas.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
