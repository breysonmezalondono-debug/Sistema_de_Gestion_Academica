<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .auth-wrapper {
            background:
                radial-gradient(ellipse at 20% 50%, rgba(10, 102, 194, 0.15), transparent 50%),
                radial-gradient(ellipse at 80% 50%, rgba(10, 102, 194, 0.08), transparent 50%),
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
                conic-gradient(from 0deg at 50% 50%, transparent 0deg, rgba(10, 102, 194, 0.03) 60deg, transparent 120deg),
                conic-gradient(from 180deg at 50% 50%, transparent 0deg, rgba(10, 102, 194, 0.02) 60deg, transparent 120deg);
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

        .auth-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(10, 102, 194, 0.1);
        }

        .auth-features div {
            text-align: center;
            padding: 0.75rem 0.5rem;
            border-radius: 12px;
            background: rgba(10, 102, 194, 0.05);
            border: 1px solid rgba(10, 102, 194, 0.08);
            transition: all 0.3s ease;
        }

        .auth-features div:hover {
            background: rgba(10, 102, 194, 0.1);
            border-color: rgba(10, 102, 194, 0.2);
            transform: translateY(-2px);
        }

        .auth-features i {
            font-size: 1.2rem;
            color: #5B8FCC;
            margin-bottom: 0.25rem;
        }

        .auth-features span {
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
        <div class="auth-card" style="max-width: 420px;">
            <div class="auth-card-body" style="padding: 2.5rem 2rem;">
                <div class="auth-header">
                    <div class="auth-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; letter-spacing: -0.02em;">Bienvenido</h3>
                    <p style="font-size: 0.85rem;">Accede a tu cuenta</p>
                </div>

                @if(session('success'))
                    <div class="alert-modern alert-success mb-3">
                        <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-modern alert-danger mb-3">
                        <i class="bi bi-exclamation-triangle-fill"></i>{{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                        </div>
                        @error('email')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-icon-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                        </div>
                        @error('password')<div class="invalid-feedback d-block"><small>{{ $message }}</small></div>@enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Recordar sesión</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="auth-link" style="font-size: 0.8rem;">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="bi bi-box-arrow-in-right"></i>Ingresar
                    </button>
                </form>

                <div class="auth-divider">o continúa con</div>

                <div class="text-center">
                    <p class="auth-footer-text" style="margin: 0; font-size: 0.85rem; color: #5B8FCC;">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="auth-link" style="font-weight: 700;">Regístrate</a>
                    </p>
                </div>

                <div class="auth-features">
                    <div>
                        <i class="bi bi-shield-check"></i>
                        <span>Seguro</span>
                    </div>
                    <div>
                        <i class="bi bi-lightning-charge"></i>
                        <span>Rápido</span>
                    </div>
                    <div>
                        <i class="bi bi-layers"></i>
                        <span>Moderno</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
