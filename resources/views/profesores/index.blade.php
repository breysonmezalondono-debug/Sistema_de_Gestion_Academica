@extends('layouts.admin')

@section('title', 'Profesores - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('profesores.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por código, nombre o especialidad..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('profesores.index') }}" class="search-clear">
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
                            <th>Especialidad</th>
                            <th>Departamento</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profesores as $profesor)
                            <tr>
                                <td><span class="badge-modern bg-code">{{ $profesor->codigo }}</span></td>
                                <td>
                                    <span style="font-weight: 600;">{{ $profesor->nombre }} {{ $profesor->apellido }}</span>
                                </td>
                                <td>{{ $profesor->especialidad }}</td>
                                <td>
                                    <span class="badge-modern bg-info-tag">
                                        {{ $profesor->departamento?->nombre ?? 'Sin asignar' }}
                                    </span>
                                </td>
                                <td style="color: var(--gray-500);">{{ $profesor->correo }}</td>
                                <td>
                                    <span class="badge-modern {{ $profesor->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                        {{ $profesor->estado }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.25rem; justify-content: center;">
                                        <a href="{{ route('profesores.edit', $profesor) }}"
                                           class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <x-modal-confirm
                                            :action="route('profesores.destroy', $profesor)"
                                            :message="'¿Estás seguro de eliminar a ' . $profesor->nombre . ' ' . $profesor->apellido . '?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay profesores</h6>
                                        <p>Comienza registrando un nuevo profesor.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($profesores->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $profesores->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
