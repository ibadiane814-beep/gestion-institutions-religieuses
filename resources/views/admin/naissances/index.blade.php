@extends('layouts.app')
@section('title', 'Gestion des Naissances')

@section('content')

<div class="mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #14532d 100%); border-radius: 20px; padding: 2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-stars me-2" style="color:#fcd34d;"></i> Gestion des Naissances
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0; font-size:0.9rem;">
            {{ $naissances->total() }} naissance(s) enregistrée(s)
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.naissances.pdf') }}" class="btn btn-success px-4">
            <i class="bi bi-file-pdf me-2"></i> Exporter PDF
        </a>
        <a href="{{ route('naissances.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i> Nouvelle naissance
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
            placeholder="Rechercher une naissance..." onkeyup="filtrer()">
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Enfant</th>
                <th>Date de naissance</th>
                <th>Prénom du père</th>
                <th>Prénom de la mère</th>
                <th>Lieu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @forelse($naissances as $n)
                <tr>
                    <td class="text-muted">{{ $n->id }}</td>
                    <td><span class="fw-semibold">{{ $n->enfant_prenom }} {{ $n->enfant_nom }}</span></td>
                    <td>
                        <span class="badge" style="background:#fefce8; color:#ca8a04; border-radius:6px; padding:0.3rem 0.7rem; font-weight:600;">
                            {{ $n->date_naissance->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>{{ $n->pere_prenom ?? '—' }}</td>
                    <td>{{ $n->mere_prenom ?? '—' }}</td>
                    <td>{{ $n->lieu ?? '—' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.naissances.fiche-pdf', $n) }}" class="btn btn-sm btn-outline-success" title="Télécharger la fiche">
                                <i class="bi bi-file-pdf"></i>
                            </a>
                            <form action="{{ route('admin.naissances.destroy', $n) }}" method="POST"
                                onsubmit="return confirm('Supprimer cette naissance ?')">
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
                        Aucune naissance enregistrée
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

<div class="mt-3">{{ $naissances->links() }}</div>

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