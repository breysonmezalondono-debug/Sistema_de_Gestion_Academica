@extends('layouts.admin')

@section('title', 'Sistema de Gestión Académica')

@section('content')

    <div class="row g-4 mb-4">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card primary-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalEstudiantes }}</div>
                        <div class="stat-label">Estudiantes</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card success-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalProfesores }}</div>
                        <div class="stat-label">Profesores</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card warning-grad">
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
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card info-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalDepartamentos }}</div>
                        <div class="stat-label">Departamentos</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-building-gear"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card secondary-grad">
                <div class="stat-content">
                    <div>
                        <div class="stat-number">{{ $totalAulas }}</div>
                        <div class="stat-label">Aulas</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card danger-grad">
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
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <h5><i class="bi bi-pie-chart-fill me-2" style="color: var(--primary);"></i>Estudiantes por estado</h5>
                </div>
                <div class="card-body">
                    <canvas id="estudiantesChart" height="140"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-modern">
                <div class="card-header">
                    <h5><i class="bi bi-bar-chart-fill me-2" style="color: var(--warning);"></i>Materias por semestre</h5>
                </div>
                <div class="card-body">
                    <canvas id="materiasChart" height="140"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card-modern h-100">
                <div class="card-header">
                    <h5><i class="bi bi-clock-history me-2" style="color: var(--success);"></i>Últimos estudiantes</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group-modern">
                        @forelse($ultimosEstudiantes as $est)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong style="font-size: 0.85rem;">{{ $est->nombre }} {{ $est->apellido }}</strong>
                                    <br><small style="color: var(--gray-400); font-size: 0.75rem;">{{ $est->correo }}</small>
                                </div>
                                <span class="badge-modern {{ $est->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                    {{ $est->estado }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h6>Sin registros</h6>
                                <p>No hay estudiantes registrados</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-modern h-100">
                <div class="card-header">
                    <h5><i class="bi bi-clock-history me-2" style="color: var(--primary);"></i>Últimas materias</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group-modern">
                        @forelse($ultimasMaterias as $mat)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong style="font-size: 0.85rem;">{{ $mat->nombre }}</strong>
                                    <br><small style="color: var(--gray-400); font-size: 0.75rem;">
                                        {{ $mat->profesor?->nombre }} {{ $mat->profesor?->apellido ?? 'Sin asignar' }}
                                    </small>
                                </div>
                                <span class="badge-modern bg-code">{{ $mat->codigo }}</span>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h6>Sin registros</h6>
                                <p>No hay materias registradas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-modern h-100">
                <div class="card-header">
                    <h5><i class="bi bi-clock-history me-2" style="color: var(--info);"></i>Últimos profesores</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group-modern">
                        @forelse($ultimosProfesores as $prof)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong style="font-size: 0.85rem;">{{ $prof->nombre }} {{ $prof->apellido }}</strong>
                                    <br><small style="color: var(--gray-400); font-size: 0.75rem;">{{ $prof->especialidad }}</small>
                                </div>
                                <span class="badge-modern {{ $prof->estado === 'Activo' ? 'bg-active' : 'bg-inactive' }}">
                                    {{ $prof->estado }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h6>Sin registros</h6>
                                <p>No hay profesores registrados</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@php
    $estudiantesData = json_encode(array_pad($estudiantesPorEstado ?? [], 2, 0), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    $materiasLabels = json_encode($materiasPorSemestre->pluck('semestre')->toArray(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    $materiasData = json_encode($materiasPorSemestre->pluck('total')->toArray(), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
@endphp
<script>
document.addEventListener('DOMContentLoaded', function () {
    const estudiantesData = {!! $estudiantesData !!};
    const materiasLabels = {!! $materiasLabels !!};
    const materiasData = {!! $materiasData !!};

    new Chart(document.getElementById('estudiantesChart'), {
        type: 'doughnut',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                data: estudiantesData,
                backgroundColor: ['#10B981', '#EF4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 16, usePointStyle: true, font: { family: 'Inter', size: 12 } }
                }
            }
        }
    });

    new Chart(document.getElementById('materiasChart'), {
        type: 'bar',
        data: {
            labels: materiasLabels,
            datasets: [{
                label: 'Materias',
                data: materiasData,
                backgroundColor: '#0A66C2',
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'Inter', size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 } } }
            }
        }
    });
});
</script>
@endpush
