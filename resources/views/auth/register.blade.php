<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .auth-wrapper {
            background:
                radial-gradient(ellipse at 80% 20%, rgba(10, 102, 194, 0.15), transparent 50%),
                radial-gradient(ellipse at 20% 80%, rgba(10, 102, 194, 0.08), transparent 50%),
                linear-gradient(135deg, #020408 0%, #060C14 45%, #0A1018 100%);
        }

        .auth-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                conic-gradient(from 90deg at 50% 50%, transparent 0deg, rgba(10, 102, 194, 0.03) 60deg, transparent 120deg),
                conic-gradient(from 270deg at 50% 50%, transparent 0deg, rgba(10, 102, 194, 0.02) 60deg, transparent 120deg);
            animation: rotate 30s linear infinite;
            pointer-events: none;
        }

        @keyframes rotate {
            to { transform: rotate(360deg); }
        }

        .auth-card {
            position: relative;
            z-index: 1;
            border: 1px solid rgba(10, 102, 194, 0.15);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(10, 102, 194, 0.03);
            background: rgba(4, 7, 14, 0.94);
            backdrop-filter: blur(20px);
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #0A66C2, #2563EB, #0A66C2, transparent);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: -200% 0; }
            50% { background-position: 200% 0; }
        }

        .auth-header .auth-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0A66C2, #0A2540);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.6rem;
            color: #fff;
            box-shadow: 0 0 30px rgba(10, 102, 194, 0.2);
            transition: transform 0.3s ease;
        }

        .auth-header .auth-icon:hover {
            transform: scale(1.05);
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #3A4B66;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(10, 102, 194, 0.2), transparent);
        }

        .auth-benefits {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(10, 102, 194, 0.1);
        }

        .auth-benefits div {
            text-align: center;
            padding: 0.75rem 0.5rem;
            border-radius: 12px;
            background: rgba(10, 102, 194, 0.05);
            border: 1px solid rgba(10, 102, 194, 0.08);
            transition: all 0.3s ease;
        }

        .auth-benefits div:hover {
            background: rgba(10, 102, 194, 0.1);
            border-color: rgba(10, 102, 194, 0.2);
            transform: translateY(-2px);
        }

        .auth-benefits i {
            font-size: 1.2rem;
            color: #5B8FCC;
            margin-bottom: 0.25rem;
        }

        .auth-benefits span {
            display: block;
            font-size: 0.65rem;
            color: #5B8FCC;
            font-weight: 500;
        }

        .btn-auth {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
            text-decoration: none;
            line-height: 1.4;
            background: linear-gradient(135deg, #0A66C2, #0A2540);
            color: white;
            box-shadow: 0 4px 15px rgba(10, 102, 194, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-auth:hover {
            box-shadow: 0 8px 30px rgba(10, 102, 194, 0.4);
            transform: translateY(-2px);
            color: white;
        }

        .btn-auth:active {
            transform: scale(0.97);
        }

        .role-options {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.25rem;
        }

        .role-option {
            flex: 1;
            position: relative;
        }

        .role-option input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .role-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            padding: 0.75rem 0.5rem;
            border: 1.5px solid rgba(10, 102, 194, 0.1);
            border-radius: 12px;
            background: rgba(10, 102, 194, 0.03);
            color: rgba(160, 174, 192, 0.6);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .role-option input:checked + label {
            border-color: #0A66C2;
            background: rgba(10, 102, 194, 0.1);
            color: #8BB8F0;
            box-shadow: 0 0 15px rgba(10, 102, 194, 0.15);
        }

        .role-option label i {
            font-size: 1.3rem;
        }

        .role-option input:hover + label {
            border-color: rgba(10, 102, 194, 0.25);
            background: rgba(10, 102, 194, 0.06);
        }

        .btn-auth::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255,255,255,0) 30%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0) 70%);
            background-size: 200% 100%;
            animation: btnShimmer 3s infinite linear;
            pointer-events: none;
        }

        @keyframes btnShimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card" style="max-width: 460px;">
            <div class="auth-card-body" style="padding: 2.5rem 2rem;">
                <div class="auth-header">
                    <div class="auth-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; letter-spacing: -0.02em;">Crear Cuenta</h3>
                    <p style="font-size: 0.85rem;">Regístrate para acceder al sistema</p>
                </div>

                @if($errors->any())
                    <div class="alert-modern alert-danger mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        @foreach($errors->all() as $error)
                            <span>{{ $error }}</span>@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('/register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-person"></i>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required>
                        </div>
                        @error('name')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required>
                        </div>
                        @error('email')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                        </div>
                        @error('password')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de cuenta</label>
                        <div class="role-options">
                            <div class="role-option">
                                <input type="radio" name="role" id="role_estudiante" value="estudiante" {{ old('role', 'estudiante') === 'estudiante' ? 'checked' : '' }} required>
                                <label for="role_estudiante">
                                    <i class="bi bi-mortarboard-fill"></i>
                                    <span>Estudiante</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" id="role_profesor" value="profesor" {{ old('role') === 'profesor' ? 'checked' : '' }}>
                                <label for="role_profesor">
                                    <i class="bi bi-person-badge-fill"></i>
                                    <span>Profesor</span>
                                </label>
                            </div>
                        </div>
                        @error('role')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="bi bi-person-plus"></i>Crear cuenta
                    </button>
                </form>

                <div class="auth-divider">ya tienes cuenta?</div>

                <div class="text-center">
                    <p class="auth-footer-text" style="margin: 0; font-size: 0.85rem; color: #5B8FCC;">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="auth-link" style="font-weight: 700;">Inicia sesión</a>
                    </p>
                </div>

                <div class="auth-benefits">
                    <div>
                        <i class="bi bi-shield-check"></i>
                        <span>Datos seguros</span>
                    </div>
                    <div>
                        <i class="bi bi-headset"></i>
                        <span>Soporte 24/7</span>
                    </div>
                    <div>
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Actualizado</span>
                    </div>
                    <div>
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>En crecimiento</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
