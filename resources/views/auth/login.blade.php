<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Gestion Religieuse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .auth-container {
            width: 100%;
            max-width: 420px;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .auth-logo .icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #fff;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 30px rgba(37,99,235,0.4);
        }
        .auth-logo h1 {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0;
        }
        .auth-logo p {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            margin: 0.3rem 0 0;
        }
        .auth-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 2.5rem;
        }
        .auth-card h2 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .auth-card .subtitle {
            color: rgba(255,255,255,0.45);
            font-size: 0.85rem;
            margin-bottom: 2rem;
        }
        .form-label {
            color: rgba(255,255,255,0.7);
            font-size: 0.82rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.4rem;
        }
        .form-control {
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: #fff;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.1);
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
            color: #fff;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #fca5a5; font-size: 0.8rem; }
        .input-group-text {
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-right: none;
            color: rgba(255,255,255,0.4);
            border-radius: 12px 0 0 12px;
        }
        .input-group .form-control { border-left: none; border-radius: 0 12px 12px 0; }
        .input-group .form-control:focus { border-left: none; }
        .form-check-input {
            background-color: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
        }
        .form-check-input:checked { background-color: #2563eb; border-color: #2563eb; }
        .form-check-label { color: rgba(255,255,255,0.6); font-size: 0.85rem; }
        .btn-auth {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-size: 0.95rem;
            font-weight: 700;
            width: 100%;
            transition: all 0.2s;
        }
        .btn-auth:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
            color: #fff;
        }
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255,255,255,0.45);
            font-size: 0.85rem;
        }
        .auth-footer a {
            color: #60a5fa;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-footer a:hover { color: #93c5fd; }
        .divider {
            border-color: rgba(255,255,255,0.08);
            margin: 1.5rem 0;
        }
        .alert-danger {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-logo">
            <div class="icon-box">
                <i class="bi bi-buildings-fill"></i>
            </div>
            <h1>Gestion Religieuse</h1>
            <p>Institutions de Dakar</p>
        </div>

        <div class="auth-card">
            <h2>Bon retour ! 👋</h2>
            <p class="subtitle">Connectez-vous à votre compte</p>

            @if(session('error'))
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="exemple@email.com"
                            required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password"
                            placeholder="••••••••"
                            required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                </button>
            </form>

            <hr class="divider">

            <div class="auth-footer">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Créer un compte</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>