<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1e293b; margin: 0; padding: 20px; }
    .header { background: #0f172a; color: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
    .header h1 { margin: 0; font-size: 20px; }
    .header p { margin: 5px 0 0; opacity: 0.6; font-size: 11px; }
    .badge { display: inline-block; background: #fff0f3; color: #e11d48; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    thead th { background: #f1f5f9; color: #475569; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; padding: 8px 10px; text-align: left; }
    tbody td { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
    tbody tr:nth-child(even) { background: #f8fafc; }
    .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #94a3b8; }
    .total { background: #eff6ff; padding: 8px 12px; border-radius: 6px; font-weight: bold; font-size: 11px; color: #2563eb; display: inline-block; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="header">
    <h1>❤ Liste des Mariages</h1>
    <p>Gestion des Institutions Religieuses de Dakar — Généré le {{ date('d/m/Y à H:i') }}</p>
</div>
<div class="total">Total : {{ $mariages->count() }} mariage(s)</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Conjoint 1</th>
            <th>Conjoint 2</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Officiant</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mariages as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td><strong>{{ $m->conjoint1_prenom }} {{ $m->conjoint1_nom }}</strong></td>
            <td><strong>{{ $m->conjoint2_prenom }} {{ $m->conjoint2_nom }}</strong></td>
            <td><span class="badge">{{ $m->date_mariage->format('d/m/Y') }}</span></td>
            <td>{{ $m->lieu ?? '—' }}</td>
            <td>{{ $m->officiant ?? '—' }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">Aucun mariage enregistré</td></tr>
        @endforelse
    </tbody>
</table>
<div class="footer">
    © {{ date('Y') }} — Gestion des Institutions Religieuses de Dakar | ISI Dakar
</div>
</body>
</html>