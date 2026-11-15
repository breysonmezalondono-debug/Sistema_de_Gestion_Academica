@extends('layouts.admin')

@section('title', 'Editar Estudiante - Sistema de Gestión Académica')

@section('content')
    <div class="card-modern">
        <div class="card-body">
            <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('codigo_universitario') is-invalid @enderror"
                                   id="codigo_universitario" name="codigo_universitario"
                                   value="{{ old('codigo_universitario', $estudiante->codigo_universitario) }}" placeholder=" " required>
                            <label for="codigo_universitario">Código universitario <span class="text-danger">*</span></label>
                            @error('codigo_universitario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre" name="nombre" value="{{ old('nombre', $estudiante->nombre) }}" placeholder=" " required>
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                   id="apellido" name="apellido" value="{{ old('apellido', $estudiante->apellido) }}" placeholder=" " required>
                            <label for="apellido">Apellido <span class="text-danger">*</span></label>
                            @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating-modern">
                            <input type="number" class="form-control @error('edad') is-invalid @enderror"
                                   id="edad" name="edad" value="{{ old('edad', $estudiante->edad) }}" min="1" max="120" placeholder=" " required>
                            <label for="edad">Edad <span class="text-danger">*</span></label>
                            @error('edad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating-modern">
                            <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                                <option value=""></option>
                                <option value="Masculino" {{ old('sexo', $estudiante->sexo) === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo', $estudiante->sexo) === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('sexo', $estudiante->sexo) === 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            <label for="sexo">Sexo <span class="text-danger">*</span></label>
                            @error('sexo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating-modern">
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                   id="fecha_nacimiento" name="fecha_nacimiento"
                                   value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento?->format('Y-m-d')) }}" placeholder=" " required>
                            <label for="fecha_nacimiento">Fecha de nacimiento <span class="text-danger">*</span></label>
                            @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                   id="telefono" name="telefono" value="{{ old('telefono', $estudiante->telefono) }}" placeholder=" " required>
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                   id="correo" name="correo" value="{{ old('correo', $estudiante->correo) }}" placeholder=" " required>
                            <label for="correo">Correo electrónico <span class="text-danger">*</span></label>
                            @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                   id="direccion" name="direccion" value="{{ old('direccion', $estudiante->direccion) }}" placeholder=" " required>
                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                            @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('programa') is-invalid @enderror"
                                   id="programa" name="programa" value="{{ old('programa', $estudiante->programa) }}" placeholder=" " required>
                            <label for="programa">Programa <span class="text-danger">*</span></label>
                            @error('programa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-floating-modern">
                            <input type="text" class="form-control @error('carrera') is-invalid @enderror"
                                   id="carrera" name="carrera" value="{{ old('carrera', $estudiante->carrera) }}" placeholder=" " required>
                            <label for="carrera">Carrera <span class="text-danger">*</span></label>
                            @error('carrera')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating-modern">
                            <input type="file" class="form-control @error('fotografia') is-invalid @enderror"
                                   id="fotografia" name="fotografia" accept="image/*" placeholder=" ">
                            <label for="fotografia">Fotografía</label>
                            @if($estudiante->fotografia)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $estudiante->fotografia) }}"
                                         alt="Foto" style="width: 64px; height: 64px; border-radius: 12px; object-fit: cover; border: 2px solid var(--gray-100);">
                                </div>
                            @endif
                            @error('fotografia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3" style="border-top: 1px solid var(--gray-100);">
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="bi bi-floppy-fill"></i>Actualizar estudiante
                    </button>
                    <a href="{{ route('estudiantes.index') }}" class="btn-modern btn-modern-outline">
                        <i class="bi bi-x-lg"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
