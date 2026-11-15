@extends('layouts.admin')

@section('title', 'Inscripciones - Sistema de Gestión Académica')

@section('content')

    <div class="card-modern">
        <div class="card-body">
            <div class="toolbar">
                <div class="toolbar-left">
                    <form method="GET" action="{{ route('inscripciones.index') }}">
                        <div class="search-wrapper">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Buscar por estudiante o materia..."
                                   value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('inscripciones.index') }}" class="search-clear">
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
                            <th>Estudiante</th>
                            <th>Materia</th>
                            <th>Fecha inscripción</th>
                            <th>Periodo</th>
                            <th>Estado</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inscripciones as $inscripcion)
                            <tr>
                                <td>
                                    <span style="font-weight: 600;">
                                        {{ $inscripcion->estudiante->nombre }} {{ $inscripcion->estudiante->apellido }}
                                    </span>
                                </td>
                                <td>{{ $inscripcion->materia->nombre }}</td>
                                <td style="color: var(--gray-500);">{{ $inscripcion->fecha_inscripcion->format('d/m/Y') }}</td>
                                <td><span class="badge-modern bg-code">{{ $inscripcion->periodo }}</span></td>
                                <td>
                                    @if($inscripcion->estado === 'Activo')
                                        <span class="badge-modern bg-active">Activo</span>
                                    @elseif($inscripcion->estado === 'Completado')
                                        <span class="badge-modern bg-info-tag">Completado</span>
                                    @else
                                        <span class="badge-modern bg-inactive">Cancelado</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <x-modal-confirm
                                        :action="route('inscripciones.destroy', $inscripcion)"
                                        message="¿Estás seguro de eliminar esta inscripción?"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h6>No hay inscripciones</h6>
                                        <p>Comienza registrando una nueva inscripción.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($inscripciones->hasPages())
                <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid var(--gray-100);">
                    {{ $inscripciones->links('vendor.pagination.modern') }}
                </div>
            @endif
        </div>
    </div>
@endsection
