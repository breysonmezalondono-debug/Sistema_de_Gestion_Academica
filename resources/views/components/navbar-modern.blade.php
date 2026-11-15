<nav class="navbar-modern">
    <div class="navbar-left">
        <button class="navbar-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="navbar-search d-none d-md-block">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Buscar en el sistema..." onfocus="this.blur()">
        </div>
    </div>

    <div class="navbar-right">
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="navbar-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="navbar-user-info">
                    <span class="navbar-user-name">{{ Auth::user()->name }}</span>
                    <span class="navbar-user-email">{{ Auth::user()->email }}</span>
                </div>
                <span class="badge-modern bg-code" style="font-size: 0.6rem; text-transform: uppercase;">
                    {{ Auth::user()->role }}
                </span>
                </div>
                <i class="bi bi-chevron-down ms-1" style="font-size: 0.7rem; color: var(--gray-400);"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end modern-dropdown">
                <li>
                    <span class="dropdown-item-text small text-muted px-3 py-2">
                        <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->email }}
                    </span>
                </li>
                <li><hr class="dropdown-divider mx-2"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit" style="color: #DC2626;">
                            <i class="bi bi-box-arrow-right"></i>Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
