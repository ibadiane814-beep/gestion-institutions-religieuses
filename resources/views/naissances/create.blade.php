@extends('layouts.app')

@section('title', 'Enregistrement de Naissance')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-gem"></i> Enregistrement de Naissance</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('naissances.store') }}">
                    @csrf

                    <h5 class="text-info">Enfant</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="enfant_nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('enfant_nom') is-invalid @enderror" id="enfant_nom" name="enfant_nom" value="{{ old('enfant_nom') }}" required>
                            @error('enfant_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="enfant_prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('enfant_prenom') is-invalid @enderror" id="enfant_prenom" name="enfant_prenom" value="{{ old('enfant_prenom') }}" required>
                            @error('enfant_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="pere_nom" class="form-label">Nom du père</label>
                            <input type="text" class="form-control @error('pere_nom') is-invalid @enderror" id="pere_nom" name="pere_nom" value="{{ old('pere_nom') }}">
                            @error('pere_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="mere_nom" class="form-label">Nom de la mère</label>
                            <input type="text" class="form-control @error('mere_nom') is-invalid @enderror" id="mere_nom" name="mere_nom" value="{{ old('mere_nom') }}">
                            @error('mere_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lieu" class="form-label">Lieu de naissance</label>
                        <input type="text" class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}">
                        @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info btn-lg">Enregistrer la naissance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
