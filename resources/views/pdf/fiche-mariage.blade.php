<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; color: #1e293b; margin: 0; padding: 30px; }
    .header { background: #0f172a; color: #fff; padding: 25px 30px; border-radius: 10px; margin-bottom: 25px; }
    .header h1 { margin: 0; font-size: 22px; }
    .header p { margin: 8px 0 0; opacity: 0.6; font-size: 12px; }
    .section { background: #f8fafc; border-radius: 8px; padding: 15px 20px; margin-bottom: 15px; }
    .section h3 { font-size: 13px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 12px; }
    .row { display: flex; gap: 20px; }
    .field { flex: 1; }
    .field label { font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 3px; }
    .field span { font-size: 14px; font-weight: 600; color: #0f172a; }
    .badge { display: inline-block; background: #fff0f3; color: #e11d48; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
    .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 15px; }
    .seal { text-align: right; margin-top: 40px; }
    .seal-box { display: inline-block; border: 2px dashed #e2e8f0; border-radius: 8px; padding: 15px 25px; color: #94a3b8; font-size: 11px; }
</style>
</head>
<body>
<div class="header">
    <h1>Acte de Mariage Religieux</h1>
    <p>Gestion des Institutions Religieuses de Dakar — N° {{ str_pad($mariage->id, 5, '0', STR_PAD_LEFT) }}</p>
</div>

<div class="section">
    <h3>Conjoint 1</h3>
    <div class="row">
        <div class="field"><label>Nom</label><span>{{ $mariage->conjoint1_nom }}</span></div>
        <div class="field"><label>Prénom</label><span>{{ $mariage->conjoint1_prenom }}</span></div>
    </div>
</div>

<div class="section">
    <h3>Conjoint 2</h3>
    <div class="row">
        <div class="field"><label>Nom</label><span>{{ $mariage->conjoint2_nom }}</span></div>
        <div class="field"><label>Prénom</label><span>{{ $mariage->conjoint2_prenom }}</span></div>
    </div>
</div>

<div class="section">
    <h3>Cérémonie</h3>
    <div class="row">
        <div class="field"><label>Date</label><span class="badge">{{ $mariage->date_mariage->format('d/m/Y') }}</span></div>
        <div class="field"><label>Lieu</label><span>{{ $mariage->lieu ?? '—' }}</span></div>
        <div class="field"><label>Officiant</label><span>{{ $mariage->officiant ?? '—' }}</span></div>
    </div>
</div>

<div class="seal">
    <div class="seal-box">Cachet de l'institution<br><br><br>Signature</div>
</div>

<div class="footer">
    Document généré le {{ date('d/m/Y à H:i') }} — Gestion des Institutions Religieuses de Dakar | ISI Dakar
</div>
</body>
</html>