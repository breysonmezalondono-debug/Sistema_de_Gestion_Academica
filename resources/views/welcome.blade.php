<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Académica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-body">
    <div class="landing-shell">
        <section class="landing-hero">
            <div class="landing-hero-content">
                <span class="landing-badge">Plataforma educativa moderna</span>
                <h1>Sistema de Gestión Académica</h1>
                <p>Gestiona estudiantes, profesores, materias, aulas e inscripciones desde una plataforma moderna, clara y fácil de usar.</p>
                <div class="landing-actions">
                    <a href="{{ route('login') }}" class="btn-modern btn-modern-primary">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn-modern btn-modern-outline">Crear cuenta</a>
                </div>
                <ul class="landing-highlights">
                    <li><i class="bi bi-shield-check"></i> Acceso seguro</li>
                    <li><i class="bi bi-lightning-charge"></i> Operaciones ágiles</li>
                    <li><i class="bi bi-graph-up-arrow"></i> Panel ejecutivo</li>
                </ul>
            </div>
            <div class="landing-card">
                <div class="landing-card-top">
                    <div class="landing-icon"><i class="bi bi-mortarboard-fill"></i></div>
                    <h3>Todo en un solo lugar</h3>
                </div>
                <div class="landing-metrics">
                    <div>
                        <strong>+500</strong>
                        <span>Registros</span>
                    </div>
                    <div>
                        <strong>24/7</strong>
                        <span>Disponibilidad</span>
                    </div>
                    <div>
                        <strong>100%</strong>
                        <span>Organizado</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
