@extends('layouts.admin')

@section('title', 'Materias - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('materias.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por nombre, código o semestre..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('materias.index') }}" class="search-clear">
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
                            <th>Créditos</th>
                            <th>Horas</th>
                            <th>Cupo</th>
                            <th>Profesor</th>
                            <th>Departamento</th>
                            <th>Semestre</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materias as $materia)
                            <tr>
                                <td><span class="badge-modern bg-code">{{ $materia->codigo }}</span></td>
                                <td><span style="font-weight: 600;">{{ $materia->nombre }}</span></td>
                                <td>{{ $materia->creditos }}</td>
                                <td>{{ $materia->horas_semanales }}h</td>
                                <td>{{ $materia->cupo_maximo }}</td>
                                <td>{{ $materia->profesor?->nombre }} {{ $materia->profesor?->apellido ?? '' }}</td>
                                <td>
                                    <span class="badge-modern bg-info-tag">
                                        {{ $materia->departamento?->nombre ?? 'Sin asignar' }}
                                    </span>
                                </td>
                                <td><span class="badge-modern bg-code">{{ $materia->semestre }}</span></td>
                                <td>
                                    <span class="badge-modern {{ $materia->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                        {{ $materia->estado }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.25rem; justify-content: center;">
                                        <a href="{{ route('materias.edit', $materia) }}"
                                           class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <x-modal-confirm
                                            :action="route('materias.destroy', $materia)"
                                            :message="'¿Estás seguro de eliminar la materia ' . $materia->nombre . '?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay materias</h6>
                                        <p>Comienza registrando una nueva materia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($materias->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $materias->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
