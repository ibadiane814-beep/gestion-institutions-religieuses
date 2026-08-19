<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8">
<style>
    body { font-family: Arial, sans-serif; background:#f8fafc; margin:0; padding:20px; }
    .container { max-width:600px; margin:0 auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08); }
    .header { background:linear-gradient(135deg,#0f172a,#4c0519); padding:30px; text-align:center; }
    .header h1 { color:#fff; margin:0; font-size:22px; }
    .header p { color:rgba(255,255,255,0.6); margin:8px 0 0; font-size:13px; }
    .body { padding:30px; }
    .body h2 { color:#0f172a; font-size:18px; }
    .body p { color:#475569; font-size:14px; line-height:1.6; }
    .info-box { background:#fff0f3; border-left:4px solid #e11d48; border-radius:8px; padding:15px 20px; margin:20px 0; }
    .info-row { margin-bottom:8px; font-size:13px; }
    .info-label { color:#94a3b8; font-size:11px; font-weight:600; text-transform:uppercase; display:block; }
    .info-value { color:#0f172a; font-weight:600; }
    .footer { background:#f8fafc; padding:20px; text-align:center; font-size:12px; color:#94a3b8; }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>❤️ Demande de Mariage</h1>
        <p>Gestion des Institutions Religieuses de Dakar</p>
    </div>
    <div class="body">
        <h2>Votre demande a été enregistrée !</h2>
        <p>Nous confirmons l'enregistrement de votre demande de mariage religieux.</p>
        <div class="info-box">
            <div class="info-row"><span class="info-label">Conjoint 1</span><span class="info-value">{{ $mariage->conjoint1_prenom }} {{ $mariage->conjoint1_nom }}</span></div>
            <div class="info-row"><span class="info-label">Conjoint 2</span><span class="info-value">{{ $mariage->conjoint2_prenom }} {{ $mariage->conjoint2_nom }}</span></div>
            <div class="info-row"><span class="info-label">Date</span><span class="info-value">{{ $mariage->date_mariage->format('d/m/Y') }}</span></div>
            <div class="info-row"><span class="info-label">Lieu</span><span class="info-value">{{ $mariage->lieu ?? '—' }}</span></div>
            <div class="info-row"><span class="info-label">Officiant</span><span class="info-value">{{ $mariage->officiant ?? '—' }}</span></div>
        </div>
        <p>Conservez cet email comme preuve d'enregistrement.</p>
    </div>
    <div class="footer">© {{ date('Y') }} — Gestion des Institutions Religieuses de Dakar | ISI Dakar</div>
</div>
</body>
</html>