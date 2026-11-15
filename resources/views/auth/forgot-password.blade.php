<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card card">
            <div class="card-body">
                <div class="auth-header">
                    <div class="auth-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h3>Recuperar Contraseña</h3>
                    <p>Ingresa tu correo y te enviaremos un enlace</p>
                </div>

                @if(session('success'))
                    <div class="alert-modern alert-success d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-modern alert-danger d-flex align-items-center mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--gray-700);">Correo electrónico</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="correo@ejemplo.com" required autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-modern btn-modern-primary w-100 justify-content-center mb-3" style="padding: 0.7rem 1.25rem;">
                        <i class="bi bi-send"></i>Enviar enlace
                    </button>
                </form>

                <p class="text-center mb-0" style="font-size: 0.85rem; color: var(--gray-500);">
                    <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">
                        <i class="bi bi-arrow-left me-1"></i>Volver al inicio de sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
