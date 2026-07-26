@extends('layouts.app')
@section('title', 'Déclaration de Décès')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">

        <div class="mb-4" style="background: linear-gradient(135deg, #0f172a, #0c4a6e); border-radius: 20px; padding: 2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.6rem; font-weight:800; margin:0;">
                <i class="bi bi-moon-stars-fill me-2" style="color:#60a5fa;"></i> Déclaration de Décès
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin:0.3rem 0 0; font-size:0.9rem;">
                Enregistrement d'un décès dans les registres
            </p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('deces.store') }}">
                    @csrf

                    {{-- Défunt --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="mb-3" style="color:#0284c7; font-weight:700;">
                            <i class="bi bi-person-fill me-1"></i> Informations du défunt
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('defunt_nom') is-invalid @enderror"
                                    name="defunt_nom" value="{{ old('defunt_nom') }}"
                                    placeholder="Nom de famille" required>
                                @error('defunt_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('defunt_prenom') is-invalid @enderror"
                                    name="defunt_prenom" value="{{ old('defunt_prenom') }}"
                                    placeholder="Prénom" required>
                                @error('defunt_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Détails --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="mb-3" style="color:#0284c7; font-weight:700;">
                            <i class="bi bi-info-circle me-1"></i> Détails du décès
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Date du décès <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_deces') is-invalid @enderror"
                                    name="date_deces" value="{{ old('date_deces') }}"
                                    max="{{ date('Y-m-d') }}" required>
                                @error('date_deces')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Lieu</label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror"
                                    name="lieu" value="{{ old('lieu') }}"
                                    placeholder="Ex: Hôpital Principal">
                                @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cause (optionnelle)</label>
                                <input type="text" class="form-control @error('cause') is-invalid @enderror"
                                    name="cause" value="{{ old('cause') }}"
                                    placeholder="Cause du décès">
                                @error('cause')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Soumettre la déclaration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection