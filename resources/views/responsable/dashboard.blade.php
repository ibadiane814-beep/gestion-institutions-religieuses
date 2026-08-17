@extends('layouts.app')
@section('title', 'Dashboard Responsable')

@section('content')

<div class="mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%); border-radius: 20px; padding: 2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-building me-2" style="color:#60a5fa;"></i> Mon Dashboard
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0; font-size:0.9rem;">
            Bienvenue {{ auth()->user()->nom }} —
            @if(auth()->user()->institution)
                {{ auth()->user()->institution->nom }}
            @else
                Aucune institution assignée
            @endif
        </p>
    </div>
    <a href="{{ route('profil.edit') }}" class="btn btn-primary btn-sm px-3">
        <i class="bi bi-person me-1"></i> Mon profil
    </a>
</div>

{{-- STATS --}}
<div class="row g-3 mb-4">
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                <div style="width:48px; height:48px; background:#fff0f3; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; margin-bottom:1rem;">
                    <i class="bi bi-heart-fill" style="color:#e11d48;"></i>
                </div>
                <div style="font-size:2rem; font-weight:800; color:#0f172a;">{{ $totalMariages }}</div>
                <div style="font-size:0.78rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px;">Mariages enregistrés</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                <div style="width:48px; height:48px; background:#f0f9ff; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; margin-bottom:1rem;">
                    <i class="bi bi-moon-stars-fill" style="color:#0284c7;"></i>
                </div>
                <div style="font-size:2rem; font-weight:800; color:#0f172a;">{{ $totalDeces }}</div>
                <div style="font-size:0.78rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px;">Décès enregistrés</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                <div style="width:48px; height:48px; background:#fefce8; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; margin-bottom:1rem;">
                    <i class="bi bi-stars" style="color:#ca8a04;"></i>
                </div>
                <div style="font-size:2rem; font-weight:800; color:#0f172a;">{{ $totalNaissances }}</div>
                <div style="font-size:0.78rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px;">Naissances enregistrées</div>
            </div>
        </div>
    </div>
</div>

{{-- DERNIERS ACTES --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
            <div style="background:#fff; border-bottom:1.5px solid #f1f5f9; padding:1.1rem 1.4rem; display:flex; align-items:center; justify-content:space-between;">
                <h5 style="margin:0; font-size:0.95rem; font-weight:700; color:#0f172a;">
                    <i class="bi bi-heart-fill me-2" style="color:#e11d48;"></i> Derniers Mariages
                </h5>
                <a href="{{ route('mariages.create') }}" class="btn btn-sm btn-primary">+ Nouveau</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Conjoints</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($derniersMariages as $m)
                    <tr>
                        <td>{{ $m->conjoint1_prenom }} & {{ $m->conjoint2_prenom }}</td>
                        <td><span style="background:#fff0f3; color:#e11d48; border-radius:6px; padding:2px 8px; font-size:0.8rem; font-weight:600;">{{ $m->date_mariage->format('d/m/Y') }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-4 text-muted"><i class="bi bi-inbox d-block mb-1"></i> Aucun mariage</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
            <div style="background:#fff; border-bottom:1.5px solid #f1f5f9; padding:1.1rem 1.4rem; display:flex; align-items:center; justify-content:space-between;">
                <h5 style="margin:0; font-size:0.95rem; font-weight:700; color:#0f172a;">
                    <i class="bi bi-stars me-2" style="color:#ca8a04;"></i> Dernières Naissances
                </h5>
                <a href="{{ route('naissances.create') }}" class="btn btn-sm btn-primary">+ Nouveau</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Enfant</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($dernieresNaissances as $n)
                    <tr>
                        <td>{{ $n->enfant_prenom }} {{ $n->enfant_nom }}</td>
                        <td><span style="background:#fefce8; color:#ca8a04; border-radius:6px; padding:2px 8px; font-size:0.8rem; font-weight:600;">{{ $n->date_naissance->format('d/m/Y') }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-4 text-muted"><i class="bi bi-inbox d-block mb-1"></i> Aucune naissance</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ACTIONS RAPIDES --}}
<div class="row g-3 mt-2">
    <div class="col-12">
        <p style="font-size:1rem; font-weight:700; color:#0f172a; margin-bottom:1rem; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-lightning-fill text-warning"></i> Actions rapides
            <span style="flex:1; height:1.5px; background:#e2e8f0; border-radius:2px; display:block;"></span>
        </p>
        <div class="row g-2">
            <div class="col-md-3 col-6">
                <a href="{{ route('mariages.create') }}" style="border-radius:12px; border:1.5px solid #e2e8f0; padding:1rem 1.2rem; background:#fff; display:flex; align-items:center; gap:12px; text-decoration:none; transition:all 0.2s; color:#334155;">
                    <div style="width:38px; height:38px; border-radius:10px; background:#fff0f3; color:#e11d48; display:flex; align-items:center; justify-content:center;"><i class="bi bi-heart-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouveau mariage</div><div style="font-size:0.75rem; color:#94a3b8;">Enregistrer</div></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('deces.create') }}" style="border-radius:12px; border:1.5px solid #e2e8f0; padding:1rem 1.2rem; background:#fff; display:flex; align-items:center; gap:12px; text-decoration:none; color:#334155;">
                    <div style="width:38px; height:38px; border-radius:10px; background:#f0f9ff; color:#0284c7; display:flex; align-items:center; justify-content:center;"><i class="bi bi-moon-stars-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouveau décès</div><div style="font-size:0.75rem; color:#94a3b8;">Déclarer</div></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('naissances.create') }}" style="border-radius:12px; border:1.5px solid #e2e8f0; padding:1rem 1.2rem; background:#fff; display:flex; align-items:center; gap:12px; text-decoration:none; color:#334155;">
                    <div style="width:38px; height:38px; border-radius:10px; background:#fefce8; color:#ca8a04; display:flex; align-items:center; justify-content:center;"><i class="bi bi-stars"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Nouvelle naissance</div><div style="font-size:0.75rem; color:#94a3b8;">Enregistrer</div></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('institutions.index') }}" style="border-radius:12px; border:1.5px solid #e2e8f0; padding:1rem 1.2rem; background:#fff; display:flex; align-items:center; gap:12px; text-decoration:none; color:#334155;">
                    <div style="width:38px; height:38px; border-radius:10px; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center;"><i class="bi bi-buildings-fill"></i></div>
                    <div><div style="font-weight:600; font-size:0.875rem;">Institutions</div><div style="font-size:0.75rem; color:#94a3b8;">Consulter</div></div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection