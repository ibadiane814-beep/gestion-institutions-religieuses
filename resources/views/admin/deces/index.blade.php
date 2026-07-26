@extends('layouts.app')
@section('title', 'Gestion des Décès')

@section('content')

<div class="mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #0c4a6e 100%); border-radius: 20px; padding: 2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-moon-stars-fill me-2" style="color:#60a5fa;"></i> Gestion des Décès
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0; font-size:0.9rem;">
            {{ $deces->total() }} décès enregistré(s)
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.deces.pdf') }}" class="btn btn-success px-4">
            <i class="bi bi-file-pdf me-2"></i> Exporter PDF
        </a>
        <a href="{{ route('deces.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i> Nouveau décès
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
            placeholder="Rechercher un décès..." onkeyup="filtrer()">
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0" id="tableDeces">
        <thead>
            <tr>
                <th>#</th>
                <th>Défunt</th>
                <th>Date du décès</th>
                <th>Lieu</th>
                <th>Cause</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @forelse($deces as $d)
                <tr>
                    <td class="text-muted">{{ $d->id }}</td>
                    <td><span class="fw-semibold">{{ $d->defunt_prenom }} {{ $d->defunt_nom }}</span></td>
                    <td>
                        <span class="badge" style="background:#f0f9ff; color:#0284c7; border-radius:6px; padding:0.3rem 0.7rem; font-weight:600;">
                            {{ $d->date_deces->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>{{ $d->lieu ?? '—' }}</td>
                    <td>{{ $d->cause ?? '—' }}</td>
                    <td>
                       <div class="d-flex gap-1">
                            <a href="{{ route('admin.deces.fiche-pdf', $d) }}" class="btn btn-sm btn-outline-success" title="Télécharger la fiche">
                                <i class="bi bi-file-pdf"></i>
                            </a>
                            <form action="{{ route('admin.deces.destroy', $d) }}" method="POST"
                                onsubmit="return confirm('Supprimer ce décès ?')">
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
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Aucun décès enregistré
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

<div class="mt-3">{{ $deces->links() }}</div>

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