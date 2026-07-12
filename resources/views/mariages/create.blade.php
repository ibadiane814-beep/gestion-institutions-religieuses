@extends('layouts.app')

@section('title', 'Demande de Mariage')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-heart"></i> Demande de Mariage</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('mariages.store') }}">
                    @csrf

                    <h5 class="text-primary">Conjoint 1</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="conjoint1_nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('conjoint1_nom') is-invalid @enderror" id="conjoint1_nom" name="conjoint1_nom" value="{{ old('conjoint1_nom') }}" required>
                            @error('conjoint1_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="conjoint1_prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('conjoint1_prenom') is-invalid @enderror" id="conjoint1_prenom" name="conjoint1_prenom" value="{{ old('conjoint1_prenom') }}" required>
                            @error('conjoint1_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <h5 class="text-primary">Conjoint 2</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="conjoint2_nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('conjoint2_nom') is-invalid @enderror" id="conjoint2_nom" name="conjoint2_nom" value="{{ old('conjoint2_nom') }}" required>
                            @error('conjoint2_nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="conjoint2_prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('conjoint2_prenom') is-invalid @enderror" id="conjoint2_prenom" name="conjoint2_prenom" value="{{ old('conjoint2_prenom') }}" required>
                            @error('conjoint2_prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="date_mariage" class="form-label">Date du mariage</label>
                            <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" id="date_mariage" name="date_mariage" value="{{ old('date_mariage') }}" required>
                            @error('date_mariage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input type="text" class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}">
                            @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="officiant" class="form-label">Officiant</label>
                            <input type="text" class="form-control @error('officiant') is-invalid @enderror" id="officiant" name="officiant" value="{{ old('officiant') }}">
                            @error('officiant')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Soumettre la demande</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
