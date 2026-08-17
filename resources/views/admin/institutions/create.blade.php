@extends('layouts.app')
@section('title', 'Nouvelle institution')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        <div class="mb-4" style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:20px; padding:2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.5rem; font-weight:800; margin:0;">
                <i class="bi bi-buildings-fill me-2" style="color:#60a5fa;"></i> Nouvelle institution
            </h1>
        </div>
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.institutions.store') }}">
                    @csrf
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; margin-bottom:1rem;"><i class="bi bi-info-circle me-1"></i> Informations</h5>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" value="{{ old('nom') }}" required>
                                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type">
                                    <option value="">-- Choisir --</option>
                                    <option value="Mosquée" {{ old('type') === 'Mosquée' ? 'selected' : '' }}>🕌 Mosquée</option>
                                    <option value="Église" {{ old('type') === 'Église' ? 'selected' : '' }}>⛪ Église</option>
                                    <option value="Autre" {{ old('type') === 'Autre' ? 'selected' : '' }}>🏛️ Autre</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-control" name="adresse" value="{{ old('adresse') }}" placeholder="Ex: Médina, Dakar">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="2">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; margin-bottom:1rem;"><i class="bi bi-geo-alt me-1"></i> Géolocalisation</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Latitude</label>
                                <input type="number" step="any" class="form-control" name="latitude" value="{{ old('latitude') }}" placeholder="Ex: 14.6937">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Longitude</label>
                                <input type="number" step="any" class="form-control" name="longitude" value="{{ old('longitude') }}" placeholder="Ex: -17.4441">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.institutions.admin.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Créer l'institution
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection