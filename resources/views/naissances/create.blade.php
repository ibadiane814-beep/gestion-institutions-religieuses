@extends('layouts.app')
@section('title', 'Enregistrement de Naissance')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-info text-white rounded-top-4 py-3">
                <h4 class="mb-0"><i class="bi bi-gem me-2"></i> Enregistrement de Naissance</h4>
            </div>
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('naissances.store') }}">
                    @csrf

                    {{-- Section Enfant --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="text-info mb-3"><i class="bi bi-person-fill me-1"></i> Enfant</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="enfant_nom" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('enfant_nom') is-invalid @enderror"
                                    id="enfant_nom" name="enfant_nom" value="{{ old('enfant_nom') }}"
                                    placeholder="Nom de l'enfant" required>
                                @error('enfant_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="enfant_prenom" class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('enfant_prenom') is-invalid @enderror"
                                    id="enfant_prenom" name="enfant_prenom" value="{{ old('enfant_prenom') }}"
                                    placeholder="Prénom de l'enfant" required>
                                @error('enfant_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_naissance" class="form-label fw-semibold">Date de naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                                    id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold">Lieu de naissance</label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror"
                                    id="lieu" name="lieu" value="{{ old('lieu') }}"
                                    placeholder="Ex: Dakar">
                                @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        <div class="col-md-12">
                            <label class="form-label">Email de confirmation <span style="color:#94a3b8; font-weight:400;">(optionnel)</span></label>
                            <input type="email" class="form-control"
                                name="email_confirmation"
                                placeholder="Entrez un email pour recevoir la confirmation"
                                value="{{ old('email_confirmation') }}">
                            <small class="text-muted">Si renseigné, une confirmation sera envoyée à cet email.</small>
                        </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section Parents --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="text-info mb-3"><i class="bi bi-people-fill me-1"></i> Parents</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="pere_prenom" class="form-label fw-semibold">Prénom du père</label>
                                <input type="text" class="form-control @error('pere_prenom') is-invalid @enderror"
                                    id="pere_prenom" name="pere_prenom" value="{{ old('pere_prenom') }}"
                                    placeholder="Prénom du père">
                                @error('pere_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mere_prenom" class="form-label fw-semibold">Prénom de la mère</label>
                                <input type="text" class="form-control @error('mere_prenom') is-invalid @enderror"
                                    id="mere_prenom" name="mere_prenom" value="{{ old('mere_prenom') }}"
                                    placeholder="Prénom de la mère">
                                @error('mere_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info btn-lg text-white fw-bold rounded-3">
                            <i class="bi bi-check-circle me-2"></i> Enregistrer la naissance
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection