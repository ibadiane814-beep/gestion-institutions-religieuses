@extends('layouts.app')

@section('title', 'Déclaration de Décès')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-cloud"></i> Déclaration de Décès</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('deces.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="defunt_nom" class="form-label">Nom du défunt</label>
                            <input type="text" class="form-control @error('defunt_nom') is-invalid @enderror" id="defunt_nom" name="defunt_nom" value="{{ old('defunt_nom') }}" required>
                            @error('defunt_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="defunt_prenom" class="form-label">Prénom du défunt</label>
                            <input type="text" class="form-control @error('defunt_prenom') is-invalid @enderror" id="defunt_prenom" name="defunt_prenom" value="{{ old('defunt_prenom') }}" required>
                            @error('defunt_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="date_deces" class="form-label">Date du décès</label>
                            <input type="date" class="form-control @error('date_deces') is-invalid @enderror" id="date_deces" name="date_deces" value="{{ old('date_deces') }}" required>
                            @error('date_deces')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input type="text" class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}">
                            @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cause" class="form-label">Cause (optionnelle)</label>
                            <input type="text" class="form-control @error('cause') is-invalid @enderror" id="cause" name="cause" value="{{ old('cause') }}">
                            @error('cause')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg">Soumettre la déclaration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
