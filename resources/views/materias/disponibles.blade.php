@extends('layouts.admin')

@section('title', 'Materias Disponibles - Sistema de Gestión Académica')

@section('content')

    @if(session('success'))
        <div class="alert-modern alert-success mb-4">
            <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert-modern alert-info mb-4" style="background: rgba(6, 182, 212, 0.08); border-color: rgba(6, 182, 212, 0.12); color: #22D3EE;">
            <i class="bi bi-info-circle-fill"></i>{{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-modern alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i>{{ session('error') }}
        </div>
    @endif

    @if(empty($materias))
        <div class="card-modern">
            <div class="card-body">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h6>No hay materias disponibles</h6>
                    <p>Actualmente no hay materias activas para inscribirse.</p>
                </div>
            </div>
        </div>
    @else
        @foreach($materias->groupBy('semestre') as $semestre => $materiasSemestre)
            <div class="card-modern mb-4">
                <div class="card-header">
                    <h5><i class="bi bi-bookmark-fill me-2" style="color: var(--warning);"></i>Semestre {{ $semestre }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Materia</th>
                                    <th>Profesor</th>
                                    <th>Créditos</th>
                                    <th>Aula</th>
                                    <th>Horas</th>
                                    <th style="text-align: center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materiasSemestre as $materia)
                                    @php
                                        $inscrito = in_array($materia->id, $misMateriasIds);
                                        $aulaTexto = $materia->aula ? "{$materia->aula->numero} - {$materia->aula->edificio}" : 'Sin asignar';
                                    @endphp
                                    <tr>
                                        <td><span class="badge-modern bg-code">{{ $materia->codigo }}</span></td>
                                        <td><strong>{{ $materia->nombre }}</strong></td>
                                        <td>{{ $materia->profesor?->nombre }} {{ $materia->profesor?->apellido ?? 'Sin asignar' }}</td>
                                        <td>{{ $materia->creditos }}</td>
                                        <td>
                                            @if($materia->aula)
                                                <i class="bi bi-door-open me-1" style="color: var(--primary);"></i>
                                                {{ $aulaTexto }}
                                            @else
                                                <span style="color: var(--gray-500);">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $materia->horas_semanales }}h/sem</td>
                                        <td style="text-align: center;">
                                            @if($inscrito)
                                                <span class="badge-modern bg-active">
                                                    <i class="bi bi-check-lg"></i> Inscrito
                                                </span>
                                            @else
                                                <form action="{{ route('materias.self-enroll', $materia) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-modern btn-modern-primary btn-modern-sm">
                                                        <i class="bi bi-plus-lg"></i>Inscribirse
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
