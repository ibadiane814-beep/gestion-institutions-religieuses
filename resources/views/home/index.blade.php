@extends('layouts.app')

@section('title', 'Accueil')

@push('styles')
<style>
    #map { height: 500px; border-radius: 8px; }
</style>
@endpush

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h1 class="display-5">Bienvenue sur le portail religieux</h1>
        <p class="lead">Gestion des institutions, mariages, décès et naissances</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body text-center">
                <i class="bi bi-building fs-1"></i>
                <h5 class="card-title">{{ $institutions->count() }}</h5>
                <p>Institutions</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body text-center">
                <i class="bi bi-heart fs-1"></i>
                <h5 class="card-title">{{ App\Models\Mariage::count() }}</h5>
                <p>Mariages</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body text-center">
                <i class="bi bi-cloud fs-1"></i>
                <h5 class="card-title">{{ App\Models\Deces::count() }}</h5>
                <p>Décès</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-info mb-3">
            <div class="card-body text-center">
                <i class="bi bi-gem fs-1"></i>
                <h5 class="card-title">{{ App\Models\Naissance::count() }}</h5>
                <p>Naissances</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Carte des institutions</h5>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-heart fs-1 text-danger"></i>
                <h5>Demande de Mariage</h5>
                <p>Enregistrez une demande de mariage religieux</p>
                <a href="{{ route('mariages.create') }}" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-cloud fs-1 text-secondary"></i>
                <h5>Déclaration de Décès</h5>
                <p>Déclarez un décès pour les registres</p>
                <a href="{{ route('deces.create') }}" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-gem fs-1 text-info"></i>
                <h5>Enregistrement de Naissance</h5>
                <p>Enregistrez une nouvelle naissance</p>
                <a href="{{ route('naissances.create') }}" class="btn btn-primary">Accéder</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([14.6937, -17.4441], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const institutions = @json($institutions);

    institutions.forEach(inst => {
        if (inst.latitude && inst.longitude) {
            L.marker([inst.latitude, inst.longitude])
                .addTo(map)
                .bindPopup(`
                    <b>${inst.nom}</b><br>
                    <i class="bi bi-geo-alt"></i> ${inst.adresse ?? 'Adresse non renseignée'}<br>
                    <span class="badge bg-primary">${inst.type}</span>
                `);
        }
    });
</script>
@endpush
