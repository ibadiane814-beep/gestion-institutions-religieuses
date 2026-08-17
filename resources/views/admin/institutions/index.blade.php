@extends('layouts.app')
@section('title', 'Gestion des Institutions')
@section('content')

<div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-buildings-fill me-2" style="color:#60a5fa;"></i> Gestion des Institutions
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0;">{{ $institutions->total() }} institution(s)</p>
    </div>
    <a href="{{ route('admin.institutions.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-circle me-2"></i> Nouvelle institution
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Responsable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($institutions as $inst)
            <tr>
                <td class="text-muted">{{ $inst->id }}</td>
                <td class="fw-semibold">{{ $inst->nom }}</td>
                <td>{{ $inst->type ?? '—' }}</td>
                <td>{{ $inst->adresse ?? '—' }}</td>
                <td>
                    @if($inst->responsable)
                        <span class="badge" style="background:#f0fdf4; color:#16a34a;">{{ $inst->responsable->nom }}</span>
                    @else
                        <span class="badge" style="background:#f1f5f9; color:#94a3b8;">Non assigné</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.institutions.edit', $inst) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.institutions.destroy', $inst) }}" method="POST"
                            onsubmit="return confirm('Supprimer cette institution ?')">
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
                    <i class="bi bi-buildings fs-2 d-block mb-2"></i> Aucune institution
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $institutions->links() }}</div>
@endsection