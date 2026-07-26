<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1e293b; margin: 0; padding: 20px; }
    .header { background: #0f172a; color: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
    .header h1 { margin: 0; font-size: 20px; }
    .header p { margin: 5px 0 0; opacity: 0.6; font-size: 11px; }
    .badge { display: inline-block; background: #f0f9ff; color: #0284c7; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    thead th { background: #f1f5f9; color: #475569; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; padding: 8px 10px; text-align: left; }
    tbody td { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
    tbody tr:nth-child(even) { background: #f8fafc; }
    .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #94a3b8; }
    .total { background: #f0f9ff; padding: 8px 12px; border-radius: 6px; font-weight: bold; font-size: 11px; color: #0284c7; display: inline-block; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="header">
    <h1>Liste des Décès</h1>
    <p>Gestion des Institutions Religieuses de Dakar — Généré le {{ date('d/m/Y à H:i') }}</p>
</div>
<div class="total">Total : {{ $deces->count() }} décès</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Défunt</th>
            <th>Date du décès</th>
            <th>Lieu</th>
            <th>Cause</th>
        </tr>
    </thead>
    <tbody>
        @forelse($deces as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td><strong>{{ $d->defunt_prenom }} {{ $d->defunt_nom }}</strong></td>
            <td><span class="badge">{{ $d->date_deces->format('d/m/Y') }}</span></td>
            <td>{{ $d->lieu ?? '—' }}</td>
            <td>{{ $d->cause ?? '—' }}</td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">Aucun décès enregistré</td></tr>
        @endforelse
    </tbody>
</table>
<div class="footer">
    © {{ date('Y') }} — Gestion des Institutions Religieuses de Dakar | ISI Dakar
</div>
</body>
</html>