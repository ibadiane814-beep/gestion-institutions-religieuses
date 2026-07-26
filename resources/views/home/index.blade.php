@extends('layouts.app')
@section('title', 'Accueil — Gestion Religieuse Dakar')

@push('styles')
<style>
    #map { height: 480px; width: 100%; border-radius: 0 0 14px 14px; }

    .hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #1e293b 100%);
        border-radius: 20px;
        padding: 3.5rem 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(37,99,235,0.25) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -40px;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(124,58,237,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .hero-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.65);
        font-size: 1.05rem;
        margin-top: 0.5rem;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(37,99,235,0.25);
        border: 1px solid rgba(37,99,235,0.4);
        color: #93c5fd;
        border-radius: 20px;
        padding: 0.35rem 0.85rem;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .stat-card {
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .stat-number {
        font-size: 1.9rem;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .stat-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 2px;
    }

    .stat-card-blue  { background: #eff6ff; }
    .stat-card-green { background: #f0fdf4; }
    .stat-card-red   { background: #fff1f2; }
    .stat-card-amber { background: #fffbeb; }

    .icon-blue  { background: #dbeafe; color: #2563eb; }
    .icon-green { background: #dcfce7; color: #16a34a; }
    .icon-red   { background: #fee2e2; color: #dc2626; }
    .icon-amber { background: #fef3c7; color: #d97706; }

    .map-card {
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        overflow: hidden;
        border: none;
    }

    .map-header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #fff;
        padding: 1.1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .map-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .map-badge {
        background: rgba(37,99,235,0.3);
        border: 1px solid rgba(37,99,235,0.5);
        color: #93c5fd;
        border-radius: 20px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .action-card {
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
        padding: 1.5rem;
        background: #fff;
        text-align: center;
        transition: all 0.25s;
        text-decoration: none;
        display: block;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }

    .action-card:hover {
        border-color: #2563eb;
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(37,99,235,0.12);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .action-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.3rem;
    }

    .action-desc {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    .btn-action {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-block;
    }

    .btn-action:hover {
        opacity: 0.9;
        color: #fff;
        transform: translateY(-1px);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1.5px;
        background: #e2e8f0;
        border-radius: 2px;
    }

    .leaflet-popup-content-wrapper {
        border-radius: 12px !important;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="hero mb-4">
    <div class="position-relative" style="z-index:1">
        <div class="hero-badge">
            <i class="bi bi-geo-alt-fill"></i> Dakar, Sénégal
        </div>
        <h1 class="hero-title">Portail de Gestion des<br>Institutions Religieuses</h1>
        <p class="hero-subtitle">Recensement, géolocalisation et gestion des actes religieux — mariages, décès et naissances</p>
        <div class="d-flex gap-3 mt-3 flex-wrap">
            <a href="{{ route('mariages.create') }}" class="btn btn-primary px-4">
                <i class="bi bi-plus-circle me-2"></i> Nouvelle demande
            </a>
            <a href="#map" class="btn btn-outline-secondary px-4" style="border-color:rgba(255,255,255,0.2); color:rgba(255,255,255,0.75)">
                <i class="bi bi-map me-2"></i> Voir la carte
            </a>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-blue">
            <div class="stat-icon icon-blue">
                <i class="bi bi-buildings-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ $institutions->count() }}</div>
                <div class="stat-label">Institutions</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-green">
            <div class="stat-icon icon-green">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ \App\Models\Mariage::count() }}</div>
                <div class="stat-label">Mariages</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-red">
            <div class="stat-icon icon-red">
                <i class="bi bi-moon-stars-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ \App\Models\Deces::count() }}</div>
                <div class="stat-label">Décès</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card stat-card-amber">
            <div class="stat-icon icon-amber">
                <i class="bi bi-stars"></i>
            </div>
            <div>
                <div class="stat-number">{{ \App\Models\Naissance::count() }}</div>
                <div class="stat-label">Naissances</div>
            </div>
        </div>
    </div>
</div>

{{-- ACTIONS RAPIDES --}}
<p class="section-title"><i class="bi bi-lightning-fill text-warning"></i> Actions rapides</p>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <a href="{{ route('mariages.create') }}" class="action-card">
            <div class="action-icon" style="background:#fff0f3;">
                <i class="bi bi-heart-fill" style="color:#e11d48;"></i>
            </div>
            <div class="action-title">Demande de Mariage</div>
            <div class="action-desc">Enregistrez une demande de mariage religieux</div>
            <span class="btn-action">Accéder</span>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('deces.create') }}" class="action-card">
            <div class="action-icon" style="background:#f0f9ff;">
                <i class="bi bi-moon-stars-fill" style="color:#0284c7;"></i>
            </div>
            <div class="action-title">Déclaration de Décès</div>
            <div class="action-desc">Déclarez un décès pour les registres</div>
            <span class="btn-action">Accéder</span>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('naissances.create') }}" class="action-card">
            <div class="action-icon" style="background:#f0fdf4;">
                <i class="bi bi-stars" style="color:#16a34a;"></i>
            </div>
            <div class="action-title">Enregistrement de Naissance</div>
            <div class="action-desc">Enregistrez une nouvelle naissance</div>
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
    var map = L.map('map').setView([14.6937, -17.4441], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    var institutions = @json($institutions);

    var icons = {
        'mosquée': '🕌',
        'église':  '⛪',
        'eglise':  '⛪',
        'default': '🏛️'
    };

    institutions.forEach(function(inst) {
        if (inst.latitude && inst.longitude) {
            var type = inst.type ? inst.type.toLowerCase() : '';
            var emoji = icons[type] || icons['default'];

            var customIcon = L.divIcon({
                html: '<div style="font-size:1.8rem; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">' + emoji + '</div>',
                iconSize: [36, 36],
                iconAnchor: [18, 18],
                className: ''
            });

            var popup = '<div style="min-width:180px; padding:4px;">'
                + '<strong style="font-size:0.95rem; color:#0f172a;">' + inst.nom + '</strong>'
                + (inst.type ? '<br><span style="font-size:0.78rem; color:#64748b; background:#f1f5f9; padding:2px 8px; border-radius:10px; display:inline-block; margin-top:4px;">' + inst.type + '</span>' : '')
                + (inst.adresse ? '<br><span style="font-size:0.8rem; color:#64748b; margin-top:4px; display:block;"><i>📍 ' + inst.adresse + '</i></span>' : '')
                + (inst.telephone ? '<br><span style="font-size:0.8rem; color:#2563eb;">📞 ' + inst.telephone + '</span>' : '')
                + '</div>';

            L.marker([inst.latitude, inst.longitude], {icon: customIcon})
                .addTo(map)
                .bindPopup(popup, {maxWidth: 250});
        }
    });
</script>
@endpush