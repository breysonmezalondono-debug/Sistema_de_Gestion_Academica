@extends('layouts.admin')

@section('title', 'Departamentos - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('departamentos.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por nombre o código..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('departamentos.index') }}" class="search-clear">
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
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departamentos as $departamento)
                            <tr>
                                <td><span class="badge-modern bg-code">{{ $departamento->codigo }}</span></td>
                                <td><span style="font-weight: 600;">{{ $departamento->nombre }}</span></td>
                                <td style="color: var(--gray-500);">{{ Str::limit($departamento->descripcion, 50) }}</td>
                                <td>
                                    <span class="badge-modern {{ $departamento->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                        {{ $departamento->estado }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.25rem; justify-content: center;">
                                        <a href="{{ route('departamentos.edit', $departamento) }}"
                                           class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <x-modal-confirm
                                            :action="route('departamentos.destroy', $departamento)"
                                            :message="'¿Estás seguro de eliminar el departamento ' . $departamento->nombre . '?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay departamentos</h6>
                                        <p>Comienza registrando un nuevo departamento.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($departamentos->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $departamentos->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
