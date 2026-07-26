@extends('layouts.app')
@section('title', 'Gestion des Mariages')

@section('content')

<div class="mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #4c0519 100%); border-radius: 20px; padding: 2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-heart-fill me-2" style="color:#f87171;"></i> Gestion des Mariages
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0; font-size:0.9rem;">
            {{ $mariages->total() }} mariage(s) enregistré(s)
        </p>
    </div>
   <div class="d-flex gap-2">
        <a href="{{ route('admin.mariages.pdf') }}" class="btn btn-success px-4">
            <i class="bi bi-file-pdf me-2"></i> Exporter PDF
        </a>
        <a href="{{ route('mariages.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i> Nouveau mariage
        </a>
    </div>
</div>

{{-- RECHERCHE --}}
<div class="mb-3">
    <div class="input-group" style="max-width:400px;">
        <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-search text-muted"></i>
        </span>
        <input type="text" id="recherche" class="form-control border-start-0"
            placeholder="Rechercher un mariage..." onkeyup="filtrer()">
    </div>
</div>
{{-- FILTRES PAR DATE --}}
<form method="GET" class="d-flex gap-2 mb-3 flex-wrap">
    <select name="mois" class="form-select" style="max-width:160px;">
        <option value="">Tous les mois</option>
        @foreach(['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'] as $i => $m)
            <option value="{{ $i+1 }}" {{ request('mois') == $i+1 ? 'selected' : '' }}>{{ $m }}</option>
        @endforeach
    </select>
    <select name="annee" class="form-select" style="max-width:120px;">
        <option value="">Toutes les années</option>
        @for($y = date('Y'); $y >= 2020; $y--)
            <option value="{{ $y }}" {{ request('annee') == $y ? 'selected' : '' }}>{{ $y }}</option>
        @endfor
    </select>
    <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i> Filtrer</button>
    <a href="{{ route('admin.mariages.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
</form>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0" id="tableMariages">
        <thead>
            <tr>
                <th>#</th>
                <th>Conjoint 1</th>
                <th>Conjoint 2</th>
                <th>Date du mariage</th>
                <th>Lieu</th>
                <th>Officiant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @forelse($mariages as $m)
                <tr>
                    <td class="text-muted">{{ $m->id }}</td>
                    <td><span class="fw-semibold">{{ $m->conjoint1_prenom }} {{ $m->conjoint1_nom }}</span></td>
                    <td><span class="fw-semibold">{{ $m->conjoint2_prenom }} {{ $m->conjoint2_nom }}</span></td>
                    <td>
                        <span class="badge" style="background:#fff0f3; color:#e11d48; border-radius:6px; padding:0.3rem 0.7rem; font-weight:600;">
                            {{ $m->date_mariage->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>{{ $m->lieu ?? '—' }}</td>
                    <td>{{ $m->officiant ?? '—' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.mariages.fiche-pdf', $m) }}" class="btn btn-sm btn-outline-success" title="Télécharger la fiche">
                                <i class="bi bi-file-pdf"></i>
                            </a>
                            <form action="{{ route('admin.mariages.destroy', $m) }}" method="POST"
                                onsubmit="return confirm('Supprimer ce mariage ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Aucun mariage enregistré
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="aucunResultat" class="text-center py-4 text-muted d-none">
    <i class="bi bi-search fs-2 d-block mb-2"></i>
    Aucun résultat trouvé
</div>

<div class="mt-3">{{ $mariages->links() }}</div>

@endsection

@push('scripts')
<script>
function filtrer() {
    const val = document.getElementById('recherche').value.toLowerCase();
    const rows = document.querySelectorAll('#tbody tr');
    let count = 0;
    rows.forEach(row => {
        const txt = row.textContent.toLowerCase();
        if (txt.includes(val)) {
            row.style.display = '';
            count++;
        } else {
            row.style.display = 'none';
        }
    });
    document.getElementById('aucunResultat').classList.toggle('d-none', count > 0);
}
</script>
@endpush