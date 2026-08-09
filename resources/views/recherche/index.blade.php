@extends('layouts.app')
@section('title', 'Résultats de recherche')
@section('content')

<div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem;">
    <h1 style="color:#fff; font-size:1.5rem; font-weight:800; margin:0;">
        <i class="bi bi-search me-2" style="color:#60a5fa;"></i>
        Résultats pour "{{ $q }}"
    </h1>
    <p style="color:rgba(255,255,255,0.5); margin:0.3rem 0 0;">
        {{ $institutions->count() + $mariages->count() + $deces->count() + $naissances->count() }} résultat(s) trouvé(s)
    </p>
</div>

{{-- Institutions --}}
@if($institutions->count() > 0)
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px; overflow:hidden;">
    <div class="card-header" style="background:#eff6ff; border:none; padding:1rem 1.5rem;">
        <h5 style="margin:0; font-weight:700; color:#2563eb;"><i class="bi bi-buildings-fill me-2"></i>Institutions ({{ $institutions->count() }})</h5>
    </div>
    <table class="table mb-0">
        <thead><tr><th>Nom</th><th>Type</th><th>Adresse</th></tr></thead>
        <tbody>
            @foreach($institutions as $i)
            <tr>
                <td class="fw-semibold">{{ $i->nom }}</td>
                <td>{{ $i->type ?? '—' }}</td>
                <td>{{ $i->adresse ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- Mariages --}}
@if($mariages->count() > 0)
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px; overflow:hidden;">
    <div class="card-header" style="background:#fff0f3; border:none; padding:1rem 1.5rem;">
        <h5 style="margin:0; font-weight:700; color:#e11d48;"><i class="bi bi-heart-fill me-2"></i>Mariages ({{ $mariages->count() }})</h5>
    </div>
    <table class="table mb-0">
        <thead><tr><th>Conjoint 1</th><th>Conjoint 2</th><th>Date</th><th>Lieu</th></tr></thead>
        <tbody>
            @foreach($mariages as $m)
            <tr>
                <td>{{ $m->conjoint1_prenom }} {{ $m->conjoint1_nom }}</td>
                <td>{{ $m->conjoint2_prenom }} {{ $m->conjoint2_nom }}</td>
                <td><span style="background:#fff0f3; color:#e11d48; border-radius:6px; padding:2px 8px; font-size:0.8rem; font-weight:600;">{{ $m->date_mariage->format('d/m/Y') }}</span></td>
                <td>{{ $m->lieu ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- Décès --}}
@if($deces->count() > 0)
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px; overflow:hidden;">
    <div class="card-header" style="background:#f0f9ff; border:none; padding:1rem 1.5rem;">
        <h5 style="margin:0; font-weight:700; color:#0284c7;"><i class="bi bi-moon-stars-fill me-2"></i>Décès ({{ $deces->count() }})</h5>
    </div>
    <table class="table mb-0">
        <thead><tr><th>Défunt</th><th>Date</th><th>Lieu</th></tr></thead>
        <tbody>
            @foreach($deces as $d)
            <tr>
                <td>{{ $d->defunt_prenom }} {{ $d->defunt_nom }}</td>
                <td><span style="background:#f0f9ff; color:#0284c7; border-radius:6px; padding:2px 8px; font-size:0.8rem; font-weight:600;">{{ $d->date_deces->format('d/m/Y') }}</span></td>
                <td>{{ $d->lieu ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- Naissances --}}
@if($naissances->count() > 0)
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px; overflow:hidden;">
    <div class="card-header" style="background:#fefce8; border:none; padding:1rem 1.5rem;">
        <h5 style="margin:0; font-weight:700; color:#ca8a04;"><i class="bi bi-stars me-2"></i>Naissances ({{ $naissances->count() }})</h5>
    </div>
    <table class="table mb-0">
        <thead><tr><th>Enfant</th><th>Date</th><th>Lieu</th></tr></thead>
        <tbody>
            @foreach($naissances as $n)
            <tr>
                <td>{{ $n->enfant_prenom }} {{ $n->enfant_nom }}</td>
                <td><span style="background:#fefce8; color:#ca8a04; border-radius:6px; padding:2px 8px; font-size:0.8rem; font-weight:600;">{{ $n->date_naissance->format('d/m/Y') }}</span></td>
                <td>{{ $n->lieu ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if($institutions->count() + $mariages->count() + $deces->count() + $naissances->count() === 0)
<div class="text-center py-5 text-muted">
    <i class="bi bi-search fs-2 d-block mb-3"></i>
    <h5>Aucun résultat pour "{{ $q }}"</h5>
    <p>Essayez avec d'autres mots clés</p>
</div>
@endif

@endsection