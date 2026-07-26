@extends('layouts.app')
@section('title', 'Institutions Religieuses')

@push('styles')
<style>
   #map { height: 350px; border-radius: 0 0 16px 16px; }
    nav[aria-label="pagination"] svg,
    .pagination svg {
        width: 14px !important;
        height: 14px !important;
        display: inline !important;
    }
    nav[aria-label="pagination"] span,
    .pagination span {
        font-size: 0.85rem !important;
    }
    .inst-card {
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        padding: 1.25rem;
        background: #fff;
        transition: all 0.2s;
        height: 100%;
    }
    .inst-card:hover {
        border-color: #2563eb;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37,99,235,0.1);
    }
    .inst-icon { font-size: 2rem; margin-bottom: 0.75rem; }
    .inst-name { font-weight: 700; font-size: 0.95rem; color: #0f172a; margin-bottom: 0.25rem; }
    .inst-type { font-size: 0.75rem; font-weight: 600; border-radius: 6px; padding: 0.2rem 0.6rem; display: inline-block; margin-bottom: 0.5rem; }
    .inst-info { font-size: 0.8rem; color: #64748b; display: flex; align-items: center; gap: 5px; margin-top: 0.3rem; }
</style>
@endpush

@section('content')

<div class="mb-4" style="background: linear-gradient(135deg, #0f172a, #1e3a5f); border-radius: 20px; padding: 2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-buildings-fill me-2" style="color:#60a5fa;"></i> Institutions Religieuses
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0; font-size:0.9rem;">
            {{ $institutions->total() }} institution(s) à Dakar
        </p>
    </div>
</div>

{{-- FILTRES --}}
<form method="GET" class="d-flex gap-2 mb-4 flex-wrap">
    <div class="input-group" style="max-width:300px;">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="text" name="search" class="form-control border-start-0"
            placeholder="Rechercher..." value="{{ request('search') }}">
    </div>
    <select name="type" class="form-select" style="max-width:180px;">
        <option value="">Tous les types</option>
        @foreach($types as $type)
            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i> Filtrer</button>
    <a href="{{ route('institutions.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
</form>

{{-- CARTE --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px; overflow:hidden;">
    <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 1rem 1.5rem; display:flex; align-items:center; justify-content:space-between;">
        <h5 style="color:#fff; margin:0; font-weight:700; font-size:0.95rem;">
            <i class="bi bi-geo-alt-fill me-2" style="color:#60a5fa;"></i> Carte des institutions
        </h5>
        <span style="background:rgba(37,99,235,0.3); border:1px solid rgba(37,99,235,0.5); color:#93c5fd; border-radius:20px; padding:0.25rem 0.75rem; font-size:0.75rem; font-weight:600;">
            {{ $institutions->total() }} établissements
        </span>
    </div>
    <div id="map"></div>
</div>

{{-- GRILLE --}}
<div class="row g-3">
    @forelse($institutions as $inst)
        <div class="col-md-3 col-sm-6">
            <div class="inst-card">
                <div class="inst-icon">
                    @if(str_contains(strtolower($inst->type ?? ''), 'mosqu'))
                        🕌
                    @elseif(str_contains(strtolower($inst->type ?? ''), 'glise'))
                        ⛪
                    @else
                        🏛️
                    @endif
                </div>
                <div class="inst-name">{{ $inst->nom }}</div>
                @if($inst->type)
                    <span class="inst-type" style="background:#eff6ff; color:#2563eb;">{{ ucfirst($inst->type) }}</span>
                @endif
                @if($inst->adresse)
                    <div class="inst-info"><i class="bi bi-geo-alt"></i> {{ $inst->adresse }}</div>
                @endif
                @if($inst->telephone)
                    <div class="inst-info"><i class="bi bi-telephone"></i> {{ $inst->telephone }}</div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="bi bi-buildings fs-2 d-block mb-2"></i>
            Aucune institution trouvée
        </div>
    @endforelse
</div>

<div class="mt-3">{{ $institutions->links() }}</div>

@endsection

@push('scripts')
<script>
    var map = L.map('map').setView([14.6937, -17.4441], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var institutions = @json($institutions->items());
    institutions.forEach(function(inst) {
        if (inst.latitude && inst.longitude) {
            var type = inst.type ? inst.type.toLowerCase() : '';
            var emoji = type.includes('mosqu') ? '🕌' : type.includes('glise') ? '⛪' : '🏛️';
            var icon = L.divIcon({
                html: '<div style="font-size:1.8rem; filter:drop-shadow(0 2px 4px rgba(0,0,0,0.3));">' + emoji + '</div>',
                iconSize: [36, 36], iconAnchor: [18, 18], className: ''
            });
            L.marker([inst.latitude, inst.longitude], {icon: icon})
                .addTo(map)
                .bindPopup('<strong>' + inst.nom + '</strong>' + (inst.adresse ? '<br><small>' + inst.adresse + '</small>' : ''));
        }
    });
</script>
@endpush