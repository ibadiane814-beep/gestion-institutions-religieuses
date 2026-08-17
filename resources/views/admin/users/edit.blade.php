@extends('layouts.app')
@section('title', 'Modifier l\'utilisateur')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-7">

        <div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.5rem; font-weight:800; margin:0;">
                <i class="bi bi-pencil-fill me-2" style="color:#60a5fa;"></i> Modifier l'utilisateur
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin:0.3rem 0 0;">{{ $user->nom }} — {{ $user->email }}</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf @method('PUT')

                    {{-- Informations générales --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; color:#0f172a; margin-bottom:1rem;">
                            <i class="bi bi-person me-1"></i> Informations générales
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" value="{{ old('nom', $user->nom) }}" required>
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="text" class="form-control"
                                    name="telephone" value="{{ old('telephone', $user->telephone) }}"
                                    placeholder="+221 77 000 00 00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-control"
                                    name="adresse" value="{{ old('adresse', $user->adresse) }}"
                                    placeholder="Dakar, Sénégal">
                            </div>
                        </div>
                    </div>

                    {{-- Rôle et Institution --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; color:#0f172a; margin-bottom:1rem;">
                            <i class="bi bi-shield-check me-1"></i> Rôle et Institution
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror"
                                    name="role" id="roleSelect" required onchange="toggleInstitution()">
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                    <option value="responsable" {{ old('role', $user->role) === 'responsable' ? 'selected' : '' }}>🏛️ Responsable</option>
                                    <option value="citoyen" {{ old('role', $user->role) === 'citoyen' ? 'selected' : '' }}>👤 Citoyen</option>
                                </select>
                                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6" id="institutionField" style="{{ old('role', $user->role) !== 'responsable' ? 'display:none;' : '' }}">
                                <label class="form-label">Institution assignée</label>
                                <select class="form-select @error('institution_id') is-invalid @enderror" name="institution_id">
                                    <option value="">-- Aucune institution --</option>
                                    @foreach($institutions as $inst)
                                        <option value="{{ $inst->id }}"
                                            {{ old('institution_id', $user->institution_id) == $inst->id ? 'selected' : '' }}>
                                            {{ $inst->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('institution_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Badge rôle actuel --}}
                        <div class="mt-3">
                            <small class="text-muted">Rôle actuel : </small>
                            @if($user->role === 'admin')
                                <span class="badge" style="background:#eff6ff; color:#2563eb;">👑 Admin</span>
                            @elseif($user->role === 'responsable')
                                <span class="badge" style="background:#f0fdf4; color:#16a34a;">🏛️ Responsable</span>
                                @if($user->institution)
                                    <span class="badge ms-1" style="background:#fefce8; color:#ca8a04;">{{ $user->institution->nom }}</span>
                                @endif
                            @else
                                <span class="badge" style="background:#f8fafc; color:#64748b;">👤 Citoyen</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleInstitution() {
    const role = document.getElementById('roleSelect').value;
    const field = document.getElementById('institutionField');
    field.style.display = role === 'responsable' ? '' : 'none';
}
</script>
@endpush