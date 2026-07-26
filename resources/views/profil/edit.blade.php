@extends('layouts.app')
@section('title', 'Mon Profil')
@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-7">
        <div class="mb-4" style="background: linear-gradient(135deg, #0f172a, #1e3a5f); border-radius: 20px; padding: 2rem 2.5rem;">
            <h1 style="color:#fff; font-size:1.6rem; font-weight:800; margin:0;">
                <i class="bi bi-person-circle me-2" style="color:#60a5fa;"></i> Mon Profil
            </h1>
            <p style="color:rgba(255,255,255,0.5); margin:0.3rem 0 0;">Gérer vos informations personnelles</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('profil.update') }}">
                    @csrf @method('PUT')

                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; color:#0f172a; margin-bottom:1rem;">
                            <i class="bi bi-person me-1"></i> Informations générales
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom complet <span class="text-danger">*</span></label>
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
                        </div>
                    </div>

                    <div class="bg-light rounded-3 p-3 mb-4">
                        <h5 style="font-weight:700; color:#0f172a; margin-bottom:1rem;">
                            <i class="bi bi-lock me-1"></i> Changer le mot de passe
                        </h5>
                        <p style="font-size:0.83rem; color:#94a3b8; margin-bottom:1rem;">Laissez vide pour conserver l'actuel</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="••••••••">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmer</label>
                                <input type="password" class="form-control"
                                    name="password_confirmation" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4 flex-fill">
                            <i class="bi bi-check-circle me-2"></i> Sauvegarder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection