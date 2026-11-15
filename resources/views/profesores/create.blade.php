@extends('layouts.admin')

@section('title', 'Nuevo Profesor - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('profesores.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                   id="codigo" name="codigo" value="{{ old('codigo') }}" placeholder=" " required>
                            <label for="codigo">Código <span class="text-danger">*</span></label>
                            @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder=" " required>
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                   id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder=" " required>
                            <label for="apellido">Apellido <span class="text-danger">*</span></label>
                            @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('especialidad') is-invalid @enderror"
                                   id="especialidad" name="especialidad" value="{{ old('especialidad') }}" placeholder=" " required>
                            <label for="especialidad">Especialidad <span class="text-danger">*</span></label>
                            @error('especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <select class="form-select @error('departamento_id') is-invalid @enderror" id="departamento_id" name="departamento_id">
                                <option value=""></option>
                                @foreach($departamentos as $dept)
                                    <option value="{{ $dept->id }}" {{ old('departamento_id') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="departamento_id">Departamento</label>
                            @error('departamento_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                   id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder=" " required>
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating-modern">
                            <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                   id="correo" name="correo" value="{{ old('correo') }}" placeholder=" " required>
                            <label for="correo">Correo electrónico <span class="text-danger">*</span></label>
                            @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating-modern">
                            <input type="date" class="form-control @error('fecha_contratacion') is-invalid @enderror"
                                   id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion') }}" placeholder=" " required>
                            <label for="fecha_contratacion">Fecha de contratación <span class="text-danger">*</span></label>
                            @error('fecha_contratacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                   id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder=" " required>
                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                            @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-floating-modern">
                            <input type="number" step="0.01" class="form-control @error('salario') is-invalid @enderror"
                                   id="salario" name="salario" value="{{ old('salario') }}" min="0" placeholder=" ">
                            <label for="salario">Salario</label>
                            @error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
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
                        <i class="bi bi-floppy-fill"></i>Guardar profesor
                    </button>
                    <a href="{{ route('profesores.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
