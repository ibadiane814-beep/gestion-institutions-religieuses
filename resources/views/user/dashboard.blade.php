@extends('layouts.app')
@section('title', 'Mon Espace')

@section('content')

<div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-person-circle me-2" style="color:#60a5fa;"></i> Mon Espace
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0;">
            Bienvenue {{ auth()->user()->nom }} — Citoyen
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

{{-- ACTIONS RAPIDES --}}
<p style="font-size:1rem; font-weight:700; color:#0f172a; margin-bottom:1rem; display:flex; align-items:center; gap:8px;">
    <i class="bi bi-lightning-fill text-warning"></i> Actions rapides
    <span style="flex:1; height:1.5px; background:#e2e8f0; border-radius:2px; display:block;"></span>
</p>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <a href="{{ route('mariages.create') }}" class="card border-0 shadow-sm text-decoration-none" style="border-radius:16px; display:block; border-top:4px solid #e11d48 !important;">
            <div class="card-body p-4 text-center">
                <div style="width:60px; height:60px; background:#fff0f3; border-radius:16px; margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; font-size:1.6rem;">
                    <i class="bi bi-heart-fill" style="color:#e11d48;"></i>
                </div>
                <div style="font-weight:700; color:#0f172a; margin-bottom:0.4rem;">Demande de Mariage</div>
                <div style="font-size:0.82rem; color:#94a3b8; margin-bottom:1rem;">Enregistrez un mariage religieux</div>
                <span style="background:linear-gradient(135deg,#2563eb,#7c3aed); color:#fff; border-radius:8px; padding:0.5rem 1.25rem; font-size:0.85rem; font-weight:600;">Accéder</span>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('deces.create') }}" class="card border-0 shadow-sm text-decoration-none" style="border-radius:16px; display:block; border-top:4px solid #0284c7 !important;">
            <div class="card-body p-4 text-center">
                <div style="width:60px; height:60px; background:#f0f9ff; border-radius:16px; margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; font-size:1.6rem;">
                    <i class="bi bi-moon-stars-fill" style="color:#0284c7;"></i>
                </div>
                <div style="font-weight:700; color:#0f172a; margin-bottom:0.4rem;">Déclaration de Décès</div>
                <div style="font-size:0.82rem; color:#94a3b8; margin-bottom:1rem;">Déclarez un décès dans les registres</div>
                <span style="background:linear-gradient(135deg,#2563eb,#7c3aed); color:#fff; border-radius:8px; padding:0.5rem 1.25rem; font-size:0.85rem; font-weight:600;">Accéder</span>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('naissances.create') }}" class="card border-0 shadow-sm text-decoration-none" style="border-radius:16px; display:block; border-top:4px solid #16a34a !important;">
            <div class="card-body p-4 text-center">
                <div style="width:60px; height:60px; background:#f0fdf4; border-radius:16px; margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; font-size:1.6rem;">
                    <i class="bi bi-stars" style="color:#16a34a;"></i>
                </div>
                <div style="font-weight:700; color:#0f172a; margin-bottom:0.4rem;">Enregistrement Naissance</div>
                <div style="font-size:0.82rem; color:#94a3b8; margin-bottom:1rem;">Enregistrez une nouvelle naissance</div>
                <span style="background:linear-gradient(135deg,#2563eb,#7c3aed); color:#fff; border-radius:8px; padding:0.5rem 1.25rem; font-size:0.85rem; font-weight:600;">Accéder</span>
            </div>
        </a>
    </div>
</div>

{{-- INSTITUTIONS --}}
<p style="font-size:1rem; font-weight:700; color:#0f172a; margin-bottom:1rem; display:flex; align-items:center; gap:8px;">
    <i class="bi bi-buildings-fill text-primary"></i> Institutions à Dakar
    <span style="flex:1; height:1.5px; background:#e2e8f0; border-radius:2px; display:block;"></span>
</p>
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            @forelse($institutions as $inst)
            <tr>
                <td class="fw-semibold">{{ $inst->nom }}</td>
                <td>
                    @if(str_contains(strtolower($inst->type ?? ''), 'mosqu'))
                        <span class="badge" style="background:#eff6ff; color:#2563eb;">🕌 {{ $inst->type }}</span>
                    @elseif(str_contains(strtolower($inst->type ?? ''), 'glise'))
                        <span class="badge" style="background:#f0fdf4; color:#16a34a;">⛪ {{ $inst->type }}</span>
                    @else
                        <span class="badge" style="background:#f8fafc; color:#64748b;">🏛️ {{ $inst->type ?? '—' }}</span>
                    @endif
                </td>
                <td style="color:#64748b;">{{ $inst->adresse ?? '—' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4 text-muted">Aucune institution</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{-- NOTIFICATIONS --}}
<div class="row g-3 mt-2">
    <div class="col-12">
        <p class="section-title"><i class="bi bi-bell-fill text-warning"></i> Dernières notifications</p>
        <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Notification::latest()->take(10)->get() as $notif)
                    <tr style="{{ !$notif->lu ? 'background:#fffbeb;' : '' }}">
                        <td>
                            @if($notif->type === 'mariage')
                                <span class="badge" style="background:#fff0f3; color:#e11d48;">❤️ Mariage</span>
                            @elseif($notif->type === 'deces')
                                <span class="badge" style="background:#f0f9ff; color:#0284c7;">🌙 Décès</span>
                            @else
                                <span class="badge" style="background:#fefce8; color:#ca8a04;">⭐ Naissance</span>
                            @endif
                        </td>
                        <td>{{ $notif->message }}</td>
                        <td style="font-size:0.82rem; color:#94a3b8;">{{ $notif->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if(!$notif->lu)
                                <span class="badge" style="background:#fef3c7; color:#d97706;">Non lu</span>
                            @else
                                <span class="badge" style="background:#f1f5f9; color:#94a3b8;">Lu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <i class="bi bi-bell-slash d-block mb-1 fs-4"></i> Aucune notification
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection