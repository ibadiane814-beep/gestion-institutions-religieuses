@extends('layouts.app')

@section('title', 'Tableau de Bord Administrateur')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-speedometer2"></i> Tableau de Bord</h1>
</div>

<div class="row mb-4">
    <div class="col-md-2">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
            <div class="card text-bg-primary">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1"></i>
                    <h3>{{ $stats['utilisateurs'] }}</h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-success">
            <div class="card-body text-center">
                <i class="bi bi-building fs-1"></i>
                <h3>{{ $stats['institutions'] }}</h3>
                <p>Institutions</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-danger">
            <div class="card-body text-center">
                <i class="bi bi-heart fs-1"></i>
                <h3>{{ $stats['mariages'] }}</h3>
                <p>Mariages</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-warning">
            <div class="card-body text-center">
                <i class="bi bi-cloud fs-1"></i>
                <h3>{{ $stats['deces'] }}</h3>
                <p>Décès</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-info">
            <div class="card-body text-center">
                <i class="bi bi-gem fs-1"></i>
                <h3>{{ $stats['naissances'] }}</h3>
                <p>Naissances</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-secondary">
            <div class="card-body text-center">
                <i class="bi bi-bell fs-1"></i>
                <h3>{{ $stats['notifications_non_lues'] }}</h3>
                <p>Notifications</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-heart text-danger"></i> Derniers Mariages</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Conjoints</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($derniers_mariages as $m)
                            <tr>
                                <td>{{ $m->conjoint1_prenom }} & {{ $m->conjoint2_prenom }}</td>
                                <td>{{ $m->date_mariage->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">Aucun mariage</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-cloud text-secondary"></i> Derniers Décès</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Défunt</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($derniers_deces as $d)
                            <tr>
                                <td>{{ $d->defunt_prenom }} {{ $d->defunt_nom }}</td>
                                <td>{{ $d->date_deces->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">Aucun décès</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-gem text-info"></i> Dernières Naissances</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Enfant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dernieres_naissances as $n)
                            <tr>
                                <td>{{ $n->enfant_prenom }} {{ $n->enfant_nom }}</td>
                                <td>{{ $n->date_naissance->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center">Aucune naissance</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
