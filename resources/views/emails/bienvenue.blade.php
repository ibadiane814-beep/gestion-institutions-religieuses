<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8">
<style>
    body { font-family:Arial,sans-serif; background:#f8fafc; margin:0; padding:20px; }
    .container { max-width:600px; margin:0 auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.08); }
    .header { background:linear-gradient(135deg,#0f172a,#1e3a5f); padding:30px; text-align:center; }
    .header h1 { color:#fff; margin:0; font-size:24px; }
    .header p { color:rgba(255,255,255,0.6); margin:8px 0 0; }
    .body { padding:30px; }
    .body h2 { color:#0f172a; font-size:18px; }
    .body p { color:#475569; font-size:14px; line-height:1.6; }
    .features { background:#f8fafc; border-radius:10px; padding:20px; margin:20px 0; }
    .feature { font-size:13px; color:#334155; margin-bottom:8px; }
    .btn { display:inline-block; background:linear-gradient(135deg,#2563eb,#7c3aed); color:#fff; padding:12px 28px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; }
    .footer { background:#f8fafc; padding:20px; text-align:center; font-size:12px; color:#94a3b8; }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🏛️ Gestion Religieuse</h1>
        <p>Institutions de Dakar</p>
    </div>
    <div class="body">
        <h2>Bienvenue {{ $user->nom }} ! 🎉</h2>
        <p>Votre compte a été créé avec succès sur la plateforme.</p>
        <div class="features">
            <div class="feature">✅ Enregistrement de mariages religieux</div>
            <div class="feature">✅ Déclaration de décès</div>
            <div class="feature">✅ Enregistrement de naissances</div>
            <div class="feature">✅ Consultation de la carte des institutions</div>
        </div>
        <a href="{{ url('/login') }}" class="btn">Se connecter →</a>
    </div>
    <div class="footer">© {{ date('Y') }} — Gestion des Institutions Religieuses de Dakar | ISI Dakar</div>
</div>
</body>
</html>