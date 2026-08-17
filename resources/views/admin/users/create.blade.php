@extends('layouts.app')
@section('title', 'Nouvel utilisateur')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-7">
        <div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.5rem; font-weight:800; margin:0;">
                <i class="bi bi-person-plus me-2" style="color:#60a5fa;"></i> Nouvel utilisateur
            </h1>
        </div>
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; margin-bottom:1rem;"><i class="bi bi-person me-1"></i> Informations</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" value="{{ old('nom') }}" required>
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmer <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
                            </div>
                        </div>
                    </div>

                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; margin-bottom:1rem;"><i class="bi bi-shield-check me-1"></i> Rôle</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select" name="role" id="roleSelect" onchange="toggleInstitution()" required>
                                    <option value="citoyen" {{ old('role') === 'citoyen' ? 'selected' : '' }}>👤 Citoyen</option>
                                    <option value="responsable" {{ old('role') === 'responsable' ? 'selected' : '' }}>🏛️ Responsable</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6" id="institutionField" style="display:none;">
                                <label class="form-label">Institution</label>
                                <select class="form-select" name="institution_id">
                                    <option value="">-- Choisir une institution --</option>
                                    @foreach($institutions as $inst)
                                        <option value="{{ $inst->id }}" {{ old('institution_id') == $inst->id ? 'selected' : '' }}>
                                            {{ $inst->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Créer l'utilisateur
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
    document.getElementById('institutionField').style.display = role === 'responsable' ? '' : 'none';
}
</script>
@endpush