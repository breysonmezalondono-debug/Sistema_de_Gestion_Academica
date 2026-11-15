@extends('layouts.admin')

@section('title', 'Estudiantes - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('estudiantes.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por código, nombre o correo..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('estudiantes.index') }}" class="search-clear">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre completo</th>
                            <th>Correo</th>
                            <th>Carrera</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $estudiante)
                            <tr>
                                <td><span class="badge-modern bg-code">{{ $estudiante->codigo_universitario }}</span></td>
                                <td>
                                    <span style="font-weight: 600;">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</span>
                                </td>
                                <td style="color: var(--gray-500);">{{ $estudiante->correo }}</td>
                                <td>{{ $estudiante->carrera }}</td>
                                <td>
                                    <span class="badge-modern {{ $estudiante->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                        {{ $estudiante->estado }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.25rem; justify-content: center;">
                                        <a href="{{ route('estudiantes.edit', $estudiante) }}"
                                           class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <x-modal-confirm
                                            :action="route('estudiantes.destroy', $estudiante)"
                                            :message="'¿Estás seguro de eliminar a ' . $estudiante->nombre . ' ' . $estudiante->apellido . '?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay estudiantes</h6>
                                        <p>Comienza registrando un nuevo estudiante.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($estudiantes->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $estudiantes->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
