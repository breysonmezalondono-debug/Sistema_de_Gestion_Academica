@extends('layouts.admin')

@section('title', 'Editar Departamento - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('departamentos.update', $departamento) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre" name="nombre" value="{{ old('nombre', $departamento->nombre) }}" placeholder=" " required>
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                   id="codigo" name="codigo" value="{{ old('codigo', $departamento->codigo) }}" placeholder=" " required>
                            <label for="codigo">Código <span class="text-danger">*</span></label>
                            @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating-modern">
                            <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                      id="descripcion" name="descripcion" rows="3" placeholder=" " style="height: 100px;">{{ old('descripcion', $departamento->descripcion) }}</textarea>
                            <label for="descripcion">Descripción</label>
                            @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                <option value=""></option>
                                <option value="Activo" {{ old('estado', $departamento->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $departamento->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid var(--gray-100);">
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="bi bi-floppy-fill"></i>Actualizar departamento
                    </button>
                    <a href="{{ route('departamentos.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
