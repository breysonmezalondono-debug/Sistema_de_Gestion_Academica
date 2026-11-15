<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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
                        <i class="bi bi-key-fill"></i>
                    </div>
                    <h3>Restablecer Contraseña</h3>
                    <p>Ingresa tu nueva contraseña</p>
                </div>

                @if($errors->any())
                    <div class="alert-modern alert-danger d-flex align-items-center mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--gray-700);">Correo electrónico</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}"
                                   placeholder="correo@ejemplo.com" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--gray-700);">Nueva contraseña</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label" style="font-size: 0.8rem; font-weight: 600; color: var(--gray-700);">Confirmar contraseña</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Repite la contraseña" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-modern btn-modern-primary w-100 justify-content-center mb-3" style="padding: 0.7rem 1.25rem;">
                        <i class="bi bi-check-lg"></i>Restablecer contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
