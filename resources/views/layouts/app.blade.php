<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Institutions Religieuses')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #0f172a;
            --accent: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 24px rgba(0,0,0,0.07);
            --radius: 14px;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: var(--light-bg);
            color: var(--secondary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(15, 23, 42, 0.97) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff !important;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.3px;
        }

        .navbar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.75) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 0.85rem !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
        }

        .dropdown-menu {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 8px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .dropdown-item {
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .dropdown-item i {
            width: 18px;
            color: var(--accent);
        }

        .btn-nav-login {
            background: rgba(255,255,255,0.1);
            color: #fff !important;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            padding: 0.45rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-nav-login:hover {
            background: rgba(255,255,255,0.18);
            border-color: rgba(255,255,255,0.3);
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: #fff !important;
            border: none;
            border-radius: 8px;
            padding: 0.45rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-nav-register:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .user-badge {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 8px;
            padding: 0.4rem 0.85rem;
        }

        /* ── MAIN ── */
        main { flex: 1; padding: 2rem 0; }

        /* ── ALERTS ── */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ── CARDS ── */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--secondary), #1e293b);
            color: #fff;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        /* ── FORMS ── */
        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.83rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.4rem;
        }

        /* ── BUTTONS ── */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.65rem 1.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            border: none;
            color: #fff;
        }

        .btn-primary:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.35);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
        }

        .btn-info {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            border: none;
            color: #fff !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
        }

        .btn-outline-secondary {
            border: 1.5px solid #e2e8f0;
            color: #64748b;
        }

        .btn-outline-secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #334155;
        }

        /* ── SECTION HEADERS ── */
        .section-header {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #fff;
            border-radius: 14px;
            padding: 1.5rem 2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .section-header .icon-box {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* ── FOOTER ── */
        footer {
            background: #0f172a;
            color: rgba(255,255,255,0.5);
            text-align: center;
            padding: 1.5rem 0;
            font-size: 0.85rem;
            margin-top: auto;
        }

        footer span { color: rgba(255,255,255,0.8); font-weight: 500; }

        /* ── BADGES ── */
        .badge { border-radius: 6px; font-weight: 600; }

        /* ── TABLES ── */
        .table { border-radius: 12px; overflow: hidden; }
        .table thead th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 0.9rem 1rem;
        }
        .table tbody td {
            padding: 0.9rem 1rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }
        .table tbody tr:hover { background: #f8fafc; }

        @stack('extra-styles')
    </style>
    <style>
    [data-theme="dark"] body { background: #0f172a !important; }
    [data-theme="dark"] .card { background: #1e293b !important; color: #e2e8f0 !important; }
    [data-theme="dark"] .bg-light { background: #1e293b !important; }
    [data-theme="dark"] .form-control { background: #1e293b !important; color: #e2e8f0 !important; border-color: #334155 !important; }
    [data-theme="dark"] .form-select { background: #1e293b !important; color: #e2e8f0 !important; border-color: #334155 !important; }
    [data-theme="dark"] .table { color: #e2e8f0 !important; }
    [data-theme="dark"] .table thead th { background: #0f172a !important; }
    [data-theme="dark"] .table tbody tr:hover { background: #1e293b !important; }
    [data-theme="dark"] main { background: #0f172a !important; }
    [data-theme="dark"] .inst-card { background: #1e293b !important; border-color: #334155 !important; color: #e2e8f0 !important; }
    [data-theme="dark"] .input-group-text { background: #1e293b !important; border-color: #334155 !important; color: #94a3b8 !important; }
</style>

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="brand-icon">
                    <i class="bi bi-buildings-fill text-white"></i>
                </div>
                Gestion Religieuse
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-house me-1"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('institutions.index') }}">
                            <i class="bi bi-buildings me-1"></i> Institutions
                        </a>
                    </li>
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-file-earmark-text me-1"></i> Formulaires
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('mariages.create') }}">
                                    <i class="bi bi-heart-fill"></i> Demande de mariage
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('deces.create') }}">
                                    <i class="bi bi-moon-stars-fill"></i> Déclaration de décès
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('naissances.create') }}">
                                    <i class="bi bi-star-fill"></i> Enregistrement de naissance
                                </a>
                            </li>
                        </ul>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Administration
                            </a>
                        </li>
                        @elseif(auth()->user()->role === 'responsable')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('responsable.dashboard') }}">
                                <i class="bi bi-building me-1"></i> Mon Dashboard
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                 <form action="{{ route('recherche') }}" method="GET" class="d-flex">
        <div class="input-group" style="max-width:250px;">
            <input type="text" name="q" class="form-control form-control-sm"
                placeholder="Rechercher..."
                style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; border-radius:8px 0 0 8px;"
                value="{{ request('q') }}">
            <button type="submit" class="btn btn-sm"
                style="background:rgba(37,99,235,0.6); border:none; color:#fff; border-radius:0 8px 8px 0;">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
</li>
                    
                    <li class="nav-item">
                        <button onclick="toggleTheme()" id="themeBtn" class="btn btn-nav-login">
                            <i id="themeIcon" class="bi bi-moon-fill"></i>
                        </button>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-badge" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ auth()->user()->nom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profil.edit') }}">
                                        <i class="bi bi-person-circle" style="color:#60a5fa;"></i>
                                        Mon profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" style="border-color:rgba(255,255,255,0.08);"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right" style="color: #ef4444"></i>
                                            Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn-nav-login" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-nav-register" href="{{ route('register') }}">
                                Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- MAIN --}}
    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="bi bi-exclamation-circle-fill fs-5"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
   <footer style="background: linear-gradient(135deg, #0f172a, #1e293b); color: rgba(255,255,255,0.7); margin-top: auto;">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:1rem;">
                        <div style="width:40px; height:40px; background:linear-gradient(135deg,#2563eb,#7c3aed); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-buildings-fill text-white"></i>
                        </div>
                        <span style="color:#fff; font-weight:700; font-size:1.1rem;">Gestion Religieuse</span>
                    </div>
                    <p style="font-size:0.85rem; line-height:1.7; color:rgba(255,255,255,0.5);">
                        Plateforme de recensement et de gestion des institutions religieuses de Dakar. Mariages, décès et naissances en toute simplicité.
                    </p>
                    <div style="display:flex; gap:8px; margin-top:1rem;">
                        <div style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="bi bi-geo-alt-fill" style="color:#60a5fa;"></i>
                        </div>
                        <div style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="bi bi-envelope-fill" style="color:#60a5fa;"></i>
                        </div>
                        <div style="width:36px; height:36px; background:rgba(255,255,255,0.08); border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="bi bi-telephone-fill" style="color:#60a5fa;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 style="color:#fff; font-weight:700; margin-bottom:1rem; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.5px;">Navigation</h6>
                    <ul style="list-style:none; padding:0; margin:0;">
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('home') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-chevron-right me-1" style="font-size:0.7rem;"></i>Accueil</a></li>
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('institutions.index') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-chevron-right me-1" style="font-size:0.7rem;"></i>Institutions</a></li>
                        @auth
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('profil.edit') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-chevron-right me-1" style="font-size:0.7rem;"></i>Mon profil</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 style="color:#fff; font-weight:700; margin-bottom:1rem; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.5px;">Formulaires</h6>
                    <ul style="list-style:none; padding:0; margin:0;">
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('mariages.create') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-heart-fill me-1" style="color:#e11d48; font-size:0.7rem;"></i>Demande de mariage</a></li>
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('deces.create') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-moon-stars-fill me-1" style="color:#0284c7; font-size:0.7rem;"></i>Déclaration de décès</a></li>
                        <li style="margin-bottom:0.5rem;"><a href="{{ route('naissances.create') }}" style="color:rgba(255,255,255,0.55); text-decoration:none; font-size:0.85rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="bi bi-stars me-1" style="color:#16a34a; font-size:0.7rem;"></i>Enregistrement naissance</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 style="color:#fff; font-weight:700; margin-bottom:1rem; font-size:0.9rem; text-transform:uppercase; letter-spacing:0.5px;">Informations</h6>
                    <ul style="list-style:none; padding:0; margin:0;">
                        <li style="margin-bottom:0.75rem; display:flex; align-items:center; gap:8px;">
                            <i class="bi bi-geo-alt-fill" style="color:#60a5fa;"></i>
                            <span style="font-size:0.85rem; color:rgba(255,255,255,0.55);">Dakar, Sénégal</span>
                        </li>
                        <li style="margin-bottom:0.75rem; display:flex; align-items:center; gap:8px;">
                            <i class="bi bi-building" style="color:#60a5fa;"></i>
                            <span style="font-size:0.85rem; color:rgba(255,255,255,0.55);">Institut Supérieur d'Informatique</span>
                        </li>
                        <li style="margin-bottom:0.75rem; display:flex; align-items:center; gap:8px;">
                            <i class="bi bi-mortarboard-fill" style="color:#60a5fa;"></i>
                            <span style="font-size:0.85rem; color:rgba(255,255,255,0.55);">Licence Génie Logiciel 2025-2026</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.08); margin:2rem 0 1.5rem;">
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <p style="margin:0; font-size:0.82rem; color:rgba(255,255,255,0.4);">
                    &copy; {{ date('Y') }} — <span style="color:rgba(255,255,255,0.7);">Gestion des Institutions Religieuses de Dakar</span>
                </p>
                <p style="margin:0; font-size:0.82rem; color:rgba(255,255,255,0.4);">
                    Développé par <span style="color:#60a5fa; font-weight:600;">Elhadji Ismaila BADIANE</span> · <span style="color:rgba(255,255,255,0.5);">ISI Dakar</span>
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
    <script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    if (savedTheme === 'dark') document.body.style.background = '#0f172a';
    updateThemeIcon(savedTheme);

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        document.body.style.background = next === 'dark' ? '#0f172a' : '';
        localStorage.setItem('theme', next);
        updateThemeIcon(next);
    }

    function updateThemeIcon(theme) {
        const icon = document.getElementById('themeIcon');
        if (icon) icon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
    }
</script>
</body>
</html>