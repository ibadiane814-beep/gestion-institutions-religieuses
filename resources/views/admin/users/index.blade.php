@extends('layouts.app')
@section('title', 'Gestion des Utilisateurs')

@section('content')

<div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
    <div>
        <h1 style="color:#fff; font-size:1.7rem; font-weight:800; margin:0;">
            <i class="bi bi-people-fill me-2" style="color:#60a5fa;"></i> Gestion des Utilisateurs
        </h1>
        <p style="color:rgba(255,255,255,0.55); margin:0.25rem 0 0;">{{ $users->total() }} utilisateur(s)</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-person-plus me-2"></i> Nouvel utilisateur
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Institution</th>
                <th>Inscrit le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-muted">{{ $user->id }}</td>
                    <td class="fw-semibold">{{ $user->nom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge" style="background:#fff0f3; color:#e11d48;">👑 Admin</span>
                        @elseif($user->role === 'responsable')
                            <span class="badge" style="background:#f0fdf4; color:#16a34a;">🏛️ Responsable</span>
                        @else
                            <span class="badge" style="background:#f8fafc; color:#64748b;">👤 Citoyen</span>
                        @endif
                    </td>
                    <td>
                        @if($user->institution)
                            <span class="badge" style="background:#eff6ff; color:#2563eb;">{{ $user->institution->nom }}</span>
                        @else
                            <span style="color:#94a3b8;">—</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-people fs-2 d-block mb-2"></i>
                        Aucun utilisateur
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $users->links() }}</div>

@endsection