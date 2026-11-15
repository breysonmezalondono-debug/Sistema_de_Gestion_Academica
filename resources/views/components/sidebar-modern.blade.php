<aside class="sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <div class="sidebar-section">Principal</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span class="link-text">Dashboard</span>
        </a>

        @if(Auth::user()->esEstudiante())
            <div class="sidebar-section">Mi Cuenta</div>
            @php
                $miEstudiante = Auth::user()->estudiante;
            @endphp
            @if($miEstudiante)
                <a href="{{ route('estudiantes.edit', $miEstudiante) }}"
                   class="sidebar-link {{ request()->routeIs('estudiantes.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i>
                    <span class="link-text">Mi Perfil</span>
                </a>
                <a href="{{ route('materias.disponibles') }}"
                   class="sidebar-link {{ request()->routeIs('materias.disponibles') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span class="link-text">Mis Materias</span>
                </a>
            @else
                <a href="{{ route('estudiantes.create') }}"
                   class="sidebar-link {{ request()->routeIs('estudiantes.create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus-fill"></i>
                    <span class="link-text">Completar Perfil</span>
                </a>
            @endif
        @endif

        @if(!Auth::user()->esEstudiante())
            <div class="sidebar-section">Gestión</div>

            <a href="{{ route('estudiantes.index') }}"
               class="sidebar-link {{ request()->routeIs('estudiantes.*') && !request()->routeIs('estudiantes.create') && !request()->routeIs('estudiantes.edit') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span class="link-text">Estudiantes</span>
            </a>

            <a href="{{ route('profesores.index') }}"
               class="sidebar-link {{ request()->routeIs('profesores.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge-fill"></i>
                <span class="link-text">Profesores</span>
            </a>

            <a href="{{ route('materias.index') }}"
               class="sidebar-link {{ request()->routeIs('materias.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span class="link-text">Materias</span>
            </a>

            <div class="sidebar-section">Configuración</div>

            <a href="{{ route('departamentos.index') }}"
               class="sidebar-link {{ request()->routeIs('departamentos.*') ? 'active' : '' }}">
                <i class="bi bi-building-gear"></i>
                <span class="link-text">Departamentos</span>
            </a>

            <a href="{{ route('aulas.index') }}"
               class="sidebar-link {{ request()->routeIs('aulas.*') ? 'active' : '' }}">
                <i class="bi bi-door-open-fill"></i>
                <span class="link-text">Aulas</span>
            </a>

            <a href="{{ route('inscripciones.index') }}"
               class="sidebar-link {{ request()->routeIs('inscripciones.*') ? 'active' : '' }}">
                <i class="bi bi-pencil-square"></i>
                <span class="link-text">Inscripciones</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" class="d-flex">
            @csrf
            <button type="submit" class="sidebar-toggle-btn" style="color: rgba(239,68,68,0.6);">
                <i class="bi bi-box-arrow-right"></i>
                <span class="link-text">Cerrar sesión</span>
            </button>
        </form>
        <button class="sidebar-toggle-btn mt-1 d-none d-lg-flex" id="sidebarCollapse">
            <i class="bi bi-chevron-left"></i>
            <span class="link-text">Colapsar</span>
        </button>
    </div>
</aside>
