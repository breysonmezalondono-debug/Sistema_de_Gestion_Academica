@extends('layouts.admin')

@section('title', 'Aulas - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('aulas.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por número, edificio..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('aulas.index') }}" class="search-clear">
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
                            <th>Número</th>
                            <th>Edificio</th>
                            <th>Capacidad</th>
                            <th>Piso</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aulas as $aula)
                            <tr>
                                <td><span class="badge-modern bg-code">{{ $aula->numero }}</span></td>
                                <td>{{ $aula->edificio }}</td>
                                <td>{{ $aula->capacidad }}</td>
                                <td>{{ $aula->piso }}</td>
                                <td>
                                    <span class="badge-modern {{ $aula->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                        {{ $aula->estado }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 0.25rem; justify-content: center;">
                                        <a href="{{ route('aulas.edit', $aula) }}"
                                           class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <x-modal-confirm
                                            :action="route('aulas.destroy', $aula)"
                                            :message="'¿Estás seguro de eliminar el aula ' . $aula->numero . '?'"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay aulas</h6>
                                        <p>Comienza registrando una nueva aula.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($aulas->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $aulas->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
