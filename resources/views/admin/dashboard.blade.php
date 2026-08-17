@extends('layouts.app')
@section('title', 'Tableau de Bord Administrateur')

@push('styles')
<style>
    .admin-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .admin-hero h1 { color: #fff; font-size: 1.7rem; font-weight: 800; margin: 0; }
    .admin-hero p { color: rgba(255,255,255,0.55); margin: 0.25rem 0 0; font-size: 0.9rem; }
    .admin-hero-badge {
        background: rgba(37,99,235,0.25);
        border: 1px solid rgba(37,99,235,0.4);
        color: #93c5fd;
        border-radius: 20px;
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .kpi-card {
        border-radius: 16px;
        padding: 1.4rem 1.5rem;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        display: block;
        background: #fff;
        color: inherit;
    }
    .kpi-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: inherit; }
    .kpi-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; margin-bottom: 1rem;
    }
    .kpi-number { font-size: 2rem; font-weight: 800; color: #0f172a; line-height: 1; }
    .kpi-label { font-size: 0.78rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }
    .kpi-trend { font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem; display: flex; align-items: center; gap: 4px; }
    .recent-card { border-radius: 16px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.06); overflow: hidden; background: #fff; }
    .recent-card .card-header { background: #fff; border-bottom: 1.5px solid #f1f5f9; padding: 1.1rem 1.4rem; display: flex; align-items: center; justify-content: space-between; }
    .recent-card .card-header h5 { margin: 0; font-size: 0.95rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
    .recent-card .table th { background: #f8fafc; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 1.2rem; border: none; }
    .recent-card .table td { padding: 0.8rem 1.2rem; font-size: 0.875rem; color: #334155; border-color: #f8fafc; vertical-align: middle; }
    .recent-card .table tbody tr:hover { background: #f8fafc; }
    .badge-type { border-radius: 6px; padding: 0.25rem 0.6rem; font-size: 0.72rem; font-weight: 600; }
    .quick-action { border-radius: 12px; border: 1.5px solid #e2e8f0; padding: 1rem 1.2rem; background: #fff; display: flex; align-items: center; gap: 12px; text-decoration: none; transition: all 0.2s; color: #334155; }
    .quick-action:hover { border-color: #2563eb; background: #eff6ff; color: #2563eb; transform: translateX(3px); }
    .quick-action-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
    .section-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }
    .section-title::after { content: ''; flex: 1; height: 1.5px; background: #e2e8f0; border-radius: 2px; }
</style>
@endpush

@section('content')

<div class="admin-hero">
    <div>
        <h1><i class="bi bi-speedometer2 me-2" style="color:#60a5fa;"></i> Tableau de Bord</h1>
        <p>Vue d'ensemble de la plateforme — {{ now()->format('d M Y') }}</p>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <span class="admin-hero-badge"><i class="bi bi-shield-check-fill"></i> Administrateur</span>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-people me-1"></i> Gérer les utilisateurs
        </a>
    </div>
</div>

<p class="section-title"><i class="bi bi-bar-chart-fill text-primary"></i> Statistiques globales</p>
<div class="row g-3 mb-4">
    <div class="col-md-2 col-6">
        <a href="{{ route('admin.users.index') }}" class="kpi-card">
            <div class="kpi-icon" style="background:#eff6ff; color:#2563eb;"><i class="bi bi-people-fill"></i></div>
            <div class="kpi-number">{{ $stats['utilisateurs'] }}</div>
            <div class="kpi-label">Utilisateurs</div>
            <div class="kpi-trend" style="color:#2563eb;"><i class="bi bi-arrow-up-right"></i> Actifs</div>
        </a>
    </div>
    <div class="col-md-2 col-6">
        <div class="kpi-card">
            <div class="kpi-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-buildings-fill"></i></div>
            <div class="kpi-number">{{ $stats['institutions'] }}</div>
            <div class="kpi-label">Institutions</div>
            <div class="kpi-trend" style="color:#16a34a;"><i class="bi bi-geo-alt-fill"></i> Dakar</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <a href="{{ route('admin.mariages.index') }}" class="kpi-card">
            <div class="kpi-icon" style="background:#fff0f3; color:#e11d48;"><i class="bi bi-heart-fill"></i></div>
            <div class="kpi-number">{{ $stats['mariages'] }}</div>
            <div class="kpi-label">Mariages</div>
            <div class="kpi-trend" style="color:#e11d48;"><i class="bi bi-calendar3"></i> Total</div>
        </a>
    </div>
    <div class="col-md-2 col-6">
        <a href="{{ route('admin.deces.index') }}" class="kpi-card">
            <div class="kpi-icon" style="background:#f0f9ff; color:#0284c7;"><i class="bi bi-moon-stars-fill"></i></div>
            <div class="kpi-number">{{ $stats['deces'] }}</div>
            <div class="kpi-label">Décès</div>
            <div class="kpi-trend" style="color:#0284c7;"><i class="bi bi-calendar3"></i> Total</div>
        </a>
    </div>
    <div class="col-md-2 col-6">
        <a href="{{ route('admin.naissances.index') }}" class="kpi-card">
            <div class="kpi-icon" style="background:#fefce8; color:#ca8a04;"><i class="bi bi-stars"></i></div>
            <div class="kpi-number">{{ $stats['naissances'] }}</div>
            <div class="kpi-label">Naissances</div>
            <div class="kpi-trend" style="color:#ca8a04;"><i class="bi bi-calendar3"></i> Total</div>
        </a>
    </div>
    <div class="col-md-2 col-6">
        <div class="kpi-card">
            <div class="kpi-icon" style="background:#fdf4ff; color:#9333ea;"><i class="bi bi-bell-fill"></i></div>
            <div class="kpi-number">{{ $stats['notifications_non_lues'] }}</div>
            <div class="kpi-label">Notifications</div>
            <div class="kpi-trend" style="color:#9333ea;"><i class="bi bi-circle-fill" style="font-size:0.5rem;"></i> Non lues</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="recent-card">
            <div class="card-header">
                <h5><i class="bi bi-heart-fill" style="color:#e11d48;"></i> Derniers Mariages</h5>
                <a href="{{ route('admin.mariages.index') }}" class="badge text-decoration-none" style="background:#fff0f3; color:#e11d48;">{{ $stats['mariages'] }} total →</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Conjoints</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($derniers_mariages as $m)
                        <tr>
                            <td><span class="fw-semibold">{{ $m->conjoint1_prenom }}</span> <span class="text-muted mx-1">&</span> {{ $m->conjoint2_prenom }}</td>
                            <td><span class="badge-type" style="background:#fff0f3; color:#e11d48;">{{ $m->date_mariage->format('d/m/Y') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center py-4 text-muted"><i class="bi bi-inbox fs-4 d-block mb-1"></i> Aucun mariage</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="recent-card">
            <div class="card-header">
                <h5><i class="bi bi-moon-stars-fill" style="color:#0284c7;"></i> Derniers Décès</h5>
                <a href="{{ route('admin.deces.index') }}" class="badge text-decoration-none" style="background:#f0f9ff; color:#0284c7;">{{ $stats['deces'] }} total →</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Défunt</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($derniers_deces as $d)
                        <tr>
                            <td>{{ $d->defunt_prenom }} {{ $d->defunt_nom }}</td>
                            <td><span class="badge-type" style="background:#f0f9ff; color:#0284c7;">{{ $d->date_deces->format('d/m/Y') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center py-4 text-muted"><i class="bi bi-inbox fs-4 d-block mb-1"></i> Aucun décès</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="recent-card">
            <div class="card-header">
                <h5><i class="bi bi-stars" style="color:#ca8a04;"></i> Dernières Naissances</h5>
                <a href="{{ route('admin.naissances.index') }}" class="badge text-decoration-none" style="background:#fefce8; color:#ca8a04;">{{ $stats['naissances'] }} total →</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Enfant</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($dernieres_naissances as $n)
                        <tr>
                            <td>{{ $n->enfant_prenom }} {{ $n->enfant_nom }}</td>
                            <td><span class="badge-type" style="background:#fefce8; color:#ca8a04;">{{ $n->date_naissance->format('d/m/Y') }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center py-4 text-muted"><i class="bi bi-inbox fs-4 d-block mb-1"></i> Aucune naissance</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12">
        <p class="section-title mt-2"><i class="bi bi-lightning-fill text-warning"></i> Actions rapides</p>
        <div class="row g-2">
            <div class="col-md-2 col-6">
                <a href="{{ route('mariages.create') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#fff0f3; color:#e11d48;"><i class="bi bi-heart-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouveau mariage</div><div style="font-size:0.75rem; color:#94a3b8;">Enregistrer</div></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
            <div class="col-md-2 col-6">
                <a href="{{ route('deces.create') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#f0f9ff; color:#0284c7;"><i class="bi bi-moon-stars-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouveau décès</div><div style="font-size:0.75rem; color:#94a3b8;">Déclarer</div></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
            <div class="col-md-2 col-6">
                <a href="{{ route('naissances.create') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#fefce8; color:#ca8a04;"><i class="bi bi-stars"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouvelle naissance</div><div style="font-size:0.75rem; color:#94a3b8;">Enregistrer</div></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
            <div class="col-md-2 col-6">
                <a href="{{ route('admin.users.index') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#eff6ff; color:#2563eb;"><i class="bi bi-people-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Utilisateurs</div><div style="font-size:0.75rem; color:#94a3b8;">Gérer</div></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
            <div class="col-md-2 col-6">
                <a href="{{ route('admin.institutions.admin.index') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-buildings-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Institutions</div><div style="font-size:0.75rem; color:#94a3b8;">Gérer</div></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
        </div>
    
          
        </div>
    </div>
</div>

{{-- GRAPHIQUES --}}
<div class="row g-3 mt-2">
    <div class="col-md-8">
        <div class="recent-card p-4">
            <h6 style="font-weight:700; margin-bottom:1rem;">
                <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                Activité mensuelle {{ date('Y') }}
            </h6>
            <canvas id="chartActivite" height="100"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="recent-card p-4">
            <h6 style="font-weight:700; margin-bottom:1rem;">
                <i class="bi bi-pie-chart-fill text-primary me-2"></i>
                Répartition globale
            </h6>
            <canvas id="chartRepartition" height="220"></canvas>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('chartActivite').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
            datasets: [
                {
                    label: 'Mariages',
                    data: @json($stats_mensuelles['mariages']),
                    backgroundColor: 'rgba(225,29,72,0.15)',
                    borderColor: '#e11d48',
                    borderWidth: 2,
                    borderRadius: 6,
                },
                {
                    label: 'Décès',
                    data: @json($stats_mensuelles['deces']),
                    backgroundColor: 'rgba(2,132,199,0.15)',
                    borderColor: '#0284c7',
                    borderWidth: 2,
                    borderRadius: 6,
                },
                {
                    label: 'Naissances',
                    data: @json($stats_mensuelles['naissances']),
                    backgroundColor: 'rgba(202,138,4,0.15)',
                    borderColor: '#ca8a04',
                    borderWidth: 2,
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    const ctx2 = document.getElementById('chartRepartition').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Mariages', 'Décès', 'Naissances'],
            datasets: [{
                data: [{{ $stats['mariages'] }}, {{ $stats['deces'] }}, {{ $stats['naissances'] }}],
                backgroundColor: ['#e11d48','#0284c7','#ca8a04'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush