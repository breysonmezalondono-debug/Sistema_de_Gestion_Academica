@extends('layouts.admin')

@section('title', 'Mi Panel - Sistema de Gestión Académica')

@section('content')

    @if(!$miEstudiante)
        <div class="alert-modern alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>Aún no has completado tu perfil de estudiante.</span>
            <a href="{{ route('estudiantes.create') }}" class="btn-modern btn-modern-primary btn-modern-sm ms-3">
                <i class="bi bi-person-plus"></i>Completar perfil
            </a>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-modern alert-success mb-4">
            <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
        </div>
    @endif

    @if($miEstudiante && $totalInscripciones === 0)
        <div class="alert-modern mb-4" style="background: rgba(10, 102, 194, 0.08); border-color: rgba(10, 102, 194, 0.12); color: #8BB8F0;">
            <i class="bi bi-info-circle-fill"></i>
            <span>Aún no estás inscrito en ninguna materia.</span>
            <a href="{{ route('materias.disponibles') }}" class="btn-modern btn-modern-primary btn-modern-sm ms-3">
                <i class="bi bi-journal-text"></i>Ver materias disponibles
            </a>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card primary-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalInscripciones }}</div>
                        <div class="stat-label">Inscripciones</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card success-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalMaterias }}</div>
                        <div class="stat-label">Materias</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card info-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $inscripcionesActivas }}</div>
                        <div class="stat-label">Activas</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card warning-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $inscripcionesCompletadas }}</div>
                        <div class="stat-label">Completadas</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-award"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($totalInscripciones > 0)
        @php
            $semestresInscritos = $misInscripciones->pluck('materia.semestre')->unique()->sort()->values();
        @endphp
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card-modern h-100">
                    <div class="card-header">
                        <h5><i class="bi bi-bookmark-fill me-2" style="color: var(--warning);"></i>Semestres cursando</h5>
                    </div>
                    <div class="card-body">
                        @if($semestresInscritos->isNotEmpty())
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                @foreach($semestresInscritos as $sem)
                                    <span class="badge-modern bg-active" style="font-size: 0.8rem; padding: 0.3rem 0.8rem;">
                                        <i class="bi bi-bookmark-check"></i> {{ $sem }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p style="color: var(--gray-500);">Sin semestres asignados</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-modern h-100">
                    <div class="card-header">
                        <h5><i class="bi bi-graph-up-arrow me-2" style="color: var(--success);"></i>Mi progreso</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $total = $inscripcionesActivas + $inscripcionesCompletadas;
                            $pct = $total > 0 ? round(($inscripcionesCompletadas / $total) * 100) : 0;
                        @endphp
                        <div class="mb-2 d-flex justify-content-between">
                            <span style="color: var(--gray-500); font-size: 0.85rem;">Completado</span>
                            <span style="font-weight: 700; font-size: 1.1rem;">{{ $pct }}%</span>
                        </div>
                        <div style="height: 8px; background: rgba(10, 102, 194, 0.1); border-radius: 4px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $pct }}%; background: linear-gradient(90deg, #059669, #10B981); border-radius: 4px; transition: width 0.5s ease;"></div>
                        </div>
                        <div class="mt-2 d-flex justify-content-between" style="font-size: 0.75rem; color: var(--gray-500);">
                            <span>{{ $inscripcionesActivas }} activas</span>
                            <span>{{ $inscripcionesCompletadas }} completadas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-modern">
            <div class="card-header">
                <h5><i class="bi bi-table me-2" style="color: var(--primary);"></i>Mis materias inscritas</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Semestre</th>
                                <th>Profesor</th>
                                <th>Aula</th>
                                <th>Período</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($misInscripciones as $insc)
                                @php
                                    $mat = $insc->materia;
                                    $aulaTexto = $mat && $mat->aula ? "{$mat->aula->numero} - {$mat->aula->edificio}" : 'Por asignar';
                                @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $mat->nombre ?? 'N/A' }}</strong>
                                        @if($mat)
                                            <br><small style="color: var(--gray-500);">{{ $mat->codigo }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $mat->semestre ?? 'N/A' }}</td>
                                    <td>{{ $mat && $mat->profesor ? $mat->profesor->nombre . ' ' . $mat->profesor->apellido : 'Sin asignar' }}</td>
                                    <td>
                                        @if($mat && $mat->aula)
                                            <i class="bi bi-door-open" style="color: var(--primary);"></i>
                                            {{ $aulaTexto }}
                                        @else
                                            <span style="color: var(--gray-500);">—</span>
                                        @endif
                                    </td>
                                    <td><span class="badge-modern bg-code">{{ $insc->periodo }}</span></td>
                                    <td>
                                        <span class="badge-modern {{ $insc->estado === 'Activo' ? 'bg-active' : ($insc->estado === 'Completado' ? 'bg-info-tag' : 'bg-inactive') }}">
                                            {{ $insc->estado }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
