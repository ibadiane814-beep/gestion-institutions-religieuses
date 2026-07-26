@extends('layouts.app')
@section('title', 'Demande de Mariage')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">

        <div class="mb-4" style="background: linear-gradient(135deg, #0f172a, #4c0519); border-radius: 20px; padding: 2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.6rem; font-weight:800; margin:0;">
                <i class="bi bi-heart-fill me-2" style="color:#f87171;"></i> Demande de Mariage
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin:0.3rem 0 0; font-size:0.9rem;">
                Enregistrement d'un mariage religieux
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

                <form method="POST" action="{{ route('mariages.store') }}">
                    @csrf

                    {{-- Conjoint 1 --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="mb-3" style="color:#e11d48; font-weight:700;">
                            <i class="bi bi-person-fill me-1"></i> Conjoint 1
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('conjoint1_nom') is-invalid @enderror"
                                    name="conjoint1_nom" value="{{ old('conjoint1_nom') }}"
                                    placeholder="Nom de famille" required>
                                @error('conjoint1_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('conjoint1_prenom') is-invalid @enderror"
                                    name="conjoint1_prenom" value="{{ old('conjoint1_prenom') }}"
                                    placeholder="Prénom" required>
                                @error('conjoint1_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Conjoint 2 --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="mb-3" style="color:#e11d48; font-weight:700;">
                            <i class="bi bi-person-fill me-1"></i> Conjoint 2
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('conjoint2_nom') is-invalid @enderror"
                                    name="conjoint2_nom" value="{{ old('conjoint2_nom') }}"
                                    placeholder="Nom de famille" required>
                                @error('conjoint2_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('conjoint2_prenom') is-invalid @enderror"
                                    name="conjoint2_prenom" value="{{ old('conjoint2_prenom') }}"
                                    placeholder="Prénom" required>
                                @error('conjoint2_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Infos cérémonie --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 class="mb-3" style="color:#e11d48; font-weight:700;">
                            <i class="bi bi-calendar-event me-1"></i> Cérémonie
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Date du mariage <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_mariage') is-invalid @enderror"
                                    name="date_mariage" value="{{ old('date_mariage') }}"
                                    max="{{ date('Y-m-d') }}" required>
                                @error('date_mariage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Lieu</label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror"
                                    name="lieu" value="{{ old('lieu') }}"
                                    placeholder="Ex: Grande Mosquée de Dakar">
                                @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Officiant</label>
                                <input type="text" class="form-control @error('officiant') is-invalid @enderror"
                                    name="officiant" value="{{ old('officiant') }}"
                                    placeholder="Nom de l'imam / pasteur">
                                @error('officiant')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection