@extends('layouts.app')
@section('title', 'Accueil — Gestion Religieuse Dakar')

@push('styles')
<style>
    /* ── HERO ── */
    .hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #1e293b 100%);
        border-radius: 24px;
        padding: 4rem 3rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        min-height: 320px;
        display: flex;
        align-items: center;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(37,99,235,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .hero::after {
        content: '';
        position: absolute;
        bottom: -100px; left: -60px;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(124,58,237,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    /* Pattern islamique décoratif */
    .hero-pattern {
        position: absolute;
        top: 0; right: 0;
        width: 45%;
        height: 100%;
        opacity: 0.04;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(37,99,235,0.25);
        border: 1px solid rgba(37,99,235,0.4);
        color: #93c5fd;
        border-radius: 20px;
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }
    .hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
        line-height: 1.15;
        margin-bottom: 1rem;
    }
    .hero-title span { color: #60a5fa; }
    .hero-subtitle {
        color: rgba(255,255,255,0.6);
        font-size: 1.05rem;
        max-width: 600px;
        line-height: 1.6;
    }
    .hero-actions { margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; }
    .hero-stats {
        position: absolute;
        right: 3rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .hero-stat-item {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 14px;
        padding: 1rem 1.5rem;
        text-align: center;
        backdrop-filter: blur(10px);
        min-width: 130px;
    }
    .hero-stat-num { font-size: 2rem; font-weight: 800; color: #fff; line-height: 1; }
    .hero-stat-label { font-size: 0.75rem; color: rgba(255,255,255,0.55); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }

    /* ── STATS ── */
    .stat-card {
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        color: inherit;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
    .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
    .stat-number { font-size: 2rem; font-weight: 800; line-height: 1; color: #0f172a; }
    .stat-label { font-size: 0.82rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }
    .stat-card-blue { background: #eff6ff; } .stat-card-green { background: #f0fdf4; }
    .stat-card-red { background: #fff1f2; } .stat-card-amber { background: #fffbeb; }
    .icon-blue { background: #dbeafe; color: #2563eb; } .icon-green { background: #dcfce7; color: #16a34a; }
    .icon-red { background: #fee2e2; color: #dc2626; } .icon-amber { background: #fef3c7; color: #d97706; }

    /* ── ABOUT ── */
    .about-section {
        background: linear-gradient(135deg, #f8fafc, #eff6ff);
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
    }
    .about-icon {
        width: 64px; height: 64px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; color: #fff;
        margin-bottom: 1rem;
    }
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 1rem;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
    }
    .feature-item:hover { border-color: #2563eb; box-shadow: 0 4px 15px rgba(37,99,235,0.08); }
    .feature-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }

    /* ── ACTIONS ── */
    .action-card {
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
        padding: 2rem 1.5rem;
        background: #fff;
        text-align: center;
        transition: all 0.25s;
        text-decoration: none;
        display: block;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
    }
    .action-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        border-radius: 16px 16px 0 0;
        transition: all 0.2s;
    }
    .action-card-mariage::before { background: linear-gradient(90deg, #e11d48, #f43f5e); }
    .action-card-deces::before { background: linear-gradient(90deg, #0284c7, #0ea5e9); }
    .action-card-naissance::before { background: linear-gradient(90deg, #16a34a, #22c55e); }
    .action-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color: transparent; }
    .action-icon { width: 70px; height: 70px; border-radius: 18px; margin: 0 auto 1.25rem; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; }
    .action-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 0.4rem; }
    .action-desc { font-size: 0.82rem; color: #94a3b8; margin-bottom: 1.25rem; line-height: 1.5; }
    .btn-action { background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; border: none; border-radius: 8px; padding: 0.55rem 1.5rem; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; display: inline-block; }
    .btn-action:hover { opacity: 0.9; color: #fff; transform: translateY(-1px); }

    /* ── MAP ── */
    #map { height: 480px; width: 100%; border-radius: 0 0 16px 16px; }
    .map-card { border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); overflow: hidden; border: none; }
    .map-header { background: linear-gradient(135deg, #0f172a, #1e293b); color: #fff; padding: 1.1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; }
    .map-header h5 { margin: 0; font-weight: 700; font-size: 1rem; display: flex; align-items: center; gap: 8px; }
    .map-badge { background: rgba(37,99,235,0.3); border: 1px solid rgba(37,99,235,0.5); color: #93c5fd; border-radius: 20px; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; }

    /* ── SECTION TITLE ── */
    .section-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }
    .section-title::after { content: ''; flex: 1; height: 1.5px; background: #e2e8f0; border-radius: 2px; }
    .leaflet-popup-content-wrapper { border-radius: 12px !important; box-shadow: 0 8px 30px rgba(0,0,0,0.15) !important; }

    @media (max-width: 768px) {
        .hero { padding: 2.5rem 1.5rem; min-height: auto; }
        .hero-title { font-size: 1.8rem; }
        .hero-stats { display: none; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="hero mb-4">
    <div class="hero-pattern"></div>
    <div class="hero-content col-md-7">
        <div class="hero-badge">
            <i class="bi bi-geo-alt-fill"></i> Dakar, Sénégal
        </div>
        <h1 class="hero-title">
            Portail de Gestion des<br>
            <span>Institutions Religieuses</span>
        </h1>
        <p class="hero-subtitle">
            Recensement, géolocalisation et gestion des actes religieux de Dakar — mariages, décès et naissances en toute simplicité.
        </p>
        <div class="hero-actions">
            <a href="{{ route('mariages.create') }}" class="btn btn-primary px-4">
                <i class="bi bi-plus-circle me-2"></i> Nouvelle demande
            </a>
            <a href="{{ route('institutions.index') }}" class="btn px-4" style="background:rgba(255,255,255,0.1); color:#fff; border:1px solid rgba(255,255,255,0.2);">
                <i class="bi bi-buildings me-2"></i> Voir les institutions
            </a>
            <a href="#map" class="btn px-4" style="background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.75); border:1px solid rgba(255,255,255,0.15);">
                <i class="bi bi-map me-2"></i> Carte
            </a>
        </div>
    </div>
    {{-- Mini stats dans le hero --}}
    <div class="hero-stats d-none d-lg-flex">
        <div class="hero-stat-item">
            <div class="hero-stat-num">{{ $institutions->count() }}</div>
            <div class="hero-stat-label">Institutions</div>
        </div>
        <div class="hero-stat-item">
            <div class="hero-stat-num">{{ \App\Models\Mariage::count() }}</div>
            <div class="hero-stat-label">Mariages</div>
        </div>
        <div class="hero-stat-item">
            <div class="hero-stat-num">{{ \App\Models\Naissance::count() }}</div>
            <div class="hero-stat-label">Naissances</div>
        </div>
    </div>
</div>

{{-- STATS DÉTAILLÉES --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-blue">
            <div class="stat-icon icon-blue"><i class="bi bi-buildings-fill"></i></div>
            <div>
                <div class="stat-number counter" data-target="{{ $institutions->count() }}">0</div>
                <div class="stat-label">Institutions</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-green">
            <div class="stat-icon icon-green"><i class="bi bi-heart-fill"></i></div>
            <div>
                <div class="stat-number counter" data-target="{{ \App\Models\Mariage::count() }}">0</div>
                <div class="stat-label">Mariages</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-red">
            <div class="stat-icon icon-red"><i class="bi bi-moon-stars-fill"></i></div>
            <div>
                <div class="stat-number counter" data-target="{{ \App\Models\Deces::count() }}">0</div>
                <div class="stat-label">Décès</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-amber">
            <div class="stat-icon icon-amber"><i class="bi bi-stars"></i></div>
            <div>
                <div class="stat-number counter" data-target="{{ \App\Models\Naissance::count() }}">0</div>
                <div class="stat-label">Naissances</div>
            </div>
        </div>
    </div>
</div>

{{-- À PROPOS --}}
<div class="about-section mb-4">
    <div class="row align-items-center g-4">
        <div class="col-md-5">
            <div class="about-icon"><i class="bi bi-buildings-fill"></i></div>
            <h3 style="font-weight:800; color:#0f172a; font-size:1.5rem;">À propos du projet</h3>
            <p style="color:#64748b; line-height:1.7; margin-top:0.75rem;">
                Cette plateforme permet le recensement et la gestion des institutions religieuses de Dakar (mosquées, églises, etc.) ainsi que l'enregistrement des actes religieux — mariages, décès et naissances — avec géolocalisation interactive.
            </p>
            <a href="{{ route('institutions.index') }}" class="btn btn-primary mt-2">
                <i class="bi bi-arrow-right me-2"></i> Explorer les institutions
            </a>
        </div>
        <div class="col-md-7">
            <div class="row g-3">
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#eff6ff; color:#2563eb;"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Géolocalisation</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Carte interactive des institutions</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#fff0f3; color:#e11d48;"><i class="bi bi-heart-fill"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Mariages</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Enregistrement des actes</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#f0f9ff; color:#0284c7;"><i class="bi bi-moon-stars-fill"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Décès</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Déclarations officielles</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-stars"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Naissances</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Registres de naissances</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#fefce8; color:#ca8a04;"><i class="bi bi-file-pdf"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Export PDF</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Téléchargement des actes</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-item">
                        <div class="feature-icon" style="background:#fdf4ff; color:#9333ea;"><i class="bi bi-shield-check-fill"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:#0f172a;">Sécurisé</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">Accès par rôles</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ACTIONS RAPIDES --}}
<p class="section-title"><i class="bi bi-lightning-fill text-warning"></i> Actions rapides</p>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <a href="{{ route('mariages.create') }}" class="action-card action-card-mariage">
            <div class="action-icon" style="background:#fff0f3;">
                <i class="bi bi-heart-fill" style="color:#e11d48;"></i>
            </div>
            <div class="action-title">Demande de Mariage</div>
            <div class="action-desc">Enregistrez une demande de mariage religieux auprès d'une institution</div>
            <span class="btn-action">Accéder</span>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('deces.create') }}" class="action-card action-card-deces">
            <div class="action-icon" style="background:#f0f9ff;">
                <i class="bi bi-moon-stars-fill" style="color:#0284c7;"></i>
            </div>
            <div class="action-title">Déclaration de Décès</div>
            <div class="action-desc">Déclarez un décès pour les registres religieux officiels</div>
            <span class="btn-action">Accéder</span>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('naissances.create') }}" class="action-card action-card-naissance">
            <div class="action-icon" style="background:#f0fdf4;">
                <i class="bi bi-stars" style="color:#16a34a;"></i>
            </div>
            <div class="action-title">Enregistrement de Naissance</div>
            <div class="action-desc">Enregistrez une nouvelle naissance dans les registres</div>
            <span class="btn-action">Accéder</span>
        </a>
    </div>
</div>

{{-- CARTE --}}
<p class="section-title" id="map-section"><i class="bi bi-map-fill text-primary"></i> Carte des institutions</p>
<div class="map-card mb-4">
    <div class="map-header">
        <h5>
            <i class="bi bi-geo-alt-fill" style="color:#60a5fa;"></i>
            Institutions religieuses de Dakar
        </h5>
        <span class="map-badge">{{ $institutions->count() }} établissements</span>
    </div>
    <div id="map"></div>
</div>

@endsection

@push('scripts')
<script>
    // Compteur animé
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        if (target === 0) { counter.innerText = '0'; return; }
        const increment = Math.ceil(target / speed);
        const update = () => {
            const current = +counter.innerText;
            if (current < target) {
                counter.innerText = Math.min(current + increment, target);
                setTimeout(update, 10);
            }
        };
        update();
    });

    // Carte Leaflet
    var map = L.map('map').setView([14.6937, -17.4441], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    var institutions = @json($institutions);
    var icons = { 'mosquée': '🕌', 'église': '⛪', 'eglise': '⛪', 'default': '🏛️' };

    institutions.forEach(function(inst) {
        if (inst.latitude && inst.longitude) {
            var type = inst.type ? inst.type.toLowerCase() : '';
            var emoji = icons[type] || icons['default'];
            var customIcon = L.divIcon({
                html: '<div style="font-size:1.8rem; filter:drop-shadow(0 2px 4px rgba(0,0,0,0.3));">' + emoji + '</div>',
                iconSize: [36, 36], iconAnchor: [18, 18], className: ''
            });
            var popup = '<div style="min-width:180px; padding:4px;">'
                + '<strong style="font-size:0.95rem; color:#0f172a;">' + inst.nom + '</strong>'
                + (inst.type ? '<br><span style="font-size:0.78rem; color:#64748b; background:#f1f5f9; padding:2px 8px; border-radius:10px; display:inline-block; margin-top:4px;">' + inst.type + '</span>' : '')
                + (inst.adresse ? '<br><span style="font-size:0.8rem; color:#64748b; margin-top:4px; display:block;">📍 ' + inst.adresse + '</span>' : '')
                + (inst.telephone ? '<br><span style="font-size:0.8rem; color:#2563eb;">📞 ' + inst.telephone + '</span>' : '')
                + '</div>';
            L.marker([inst.latitude, inst.longitude], {icon: customIcon})
                .addTo(map).bindPopup(popup, {maxWidth: 250});
        }
    });
</script>
@endpush