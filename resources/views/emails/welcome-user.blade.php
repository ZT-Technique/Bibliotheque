<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bienvenue sur INOHA Bibliothèque</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #F8FAFC; color: #0A0A0A; }
  .wrapper { max-width: 620px; margin: 0 auto; padding: 40px 16px; }
  .card { background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 40px rgba(0,0,0,0.08); }
  .header { background: #0A0A0A; padding: 40px 48px 32px; text-align: center; }
  .header-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); color: #22C55E; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; padding: 6px 16px; border-radius: 100px; margin-bottom: 20px; }
  .header h1 { color: #ffffff; font-size: 26px; font-weight: 800; line-height: 1.3; }
  .header h1 span { color: #22C55E; }
  .body { padding: 48px; }
  .greeting { font-size: 17px; color: #374151; line-height: 1.7; margin-bottom: 32px; }
  .greeting strong { color: #0A0A0A; font-weight: 700; }
  .welcome-banner { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-radius: 16px; padding: 24px; margin-bottom: 32px; }
  .welcome-banner h2 { font-size: 16px; font-weight: 800; color: #14532d; margin-bottom: 4px; }
  .welcome-banner p { font-size: 14px; color: #166534; }
  .features-title { font-size: 13px; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
  .features { list-style: none; margin-bottom: 36px; }
  .features li { padding: 14px 0; border-bottom: 1px solid #F3F4F6; }
  .features li:last-child { border-bottom: none; }
  .feature-name { font-size: 14px; font-weight: 700; color: #0A0A0A; margin-bottom: 4px; }
  .feature-desc { font-size: 13px; color: #6B7280; line-height: 1.5; }
  .cta { text-align: center; margin-bottom: 40px; }
  .cta-btn { display: inline-block; background: #22C55E; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 800; padding: 16px 40px; border-radius: 14px; }
  .cta-hint { margin-top: 12px; font-size: 12px; color: #9CA3AF; }
  .divider { height: 1px; background: #F3F4F6; margin: 0 0 32px; }
  .info-box { background: #F9FAFB; border-radius: 14px; padding: 20px 24px; margin-bottom: 32px; }
  .info-box h3 { font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 12px; }
  .info-row { display: flex; justify-content: space-between; font-size: 13px; padding: 8px 0; border-bottom: 1px solid #E5E7EB; }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: #6B7280; }
  .info-value { color: #0A0A0A; font-weight: 600; }
  .footer { background: #F8FAFC; border-top: 1px solid #E5E7EB; padding: 32px 48px; text-align: center; }
  .footer p { font-size: 12px; color: #9CA3AF; line-height: 1.8; }
  .footer a { color: #22C55E; text-decoration: none; font-weight: 600; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <!-- Header -->
    <div class="header">
      <div class="header-badge">✓ &nbsp; Compte activé</div>
      <h1>Bienvenue dans la<br><span>Bibliothèque INOHA</span></h1>
    </div>

    <!-- Body -->
    <div class="body">
      <p class="greeting">
        Bonjour <strong>{{ $user->name }}</strong>,<br><br>
        Nous sommes ravis de vous accueillir au sein de la communauté <strong>INOHA</strong>. Votre compte a été créé avec succès et vous donne accès à l'ensemble de notre bibliothèque scientifique.
      </p>

      <div class="welcome-banner">
        <h2>✅ &nbsp; Votre espace personnel est prêt</h2>
        <p>Accédez à votre tableau de bord pour explorer la bibliothèque et suivre vos téléchargements.</p>
      </div>

      <p class="features-title">Ce que vous pouvez faire</p>
      <ul class="features">
        <li>
          <div class="feature-name">📥 &nbsp; Télécharger des articles en PDF</div>
          <div class="feature-desc">Accédez à l'intégralité de notre catalogue et téléchargez les publications scientifiques de votre choix.</div>
        </li>
        <li>
          <div class="feature-name">📚 &nbsp; Explorer par thématiques</div>
          <div class="feature-desc">Naviguez dans des milliers de publications organisées par domaines et disciplines scientifiques.</div>
        </li>
        <li>
          <div class="feature-name">🗂️ &nbsp; Suivre votre historique</div>
          <div class="feature-desc">Retrouvez tous vos téléchargements depuis votre espace personnel « Mon Espace ».</div>
        </li>
      </ul>

      <div class="cta">
        <a href="{{ url('/mon-espace') }}" class="cta-btn">Accéder à mon espace →</a>
        <p class="cta-hint">Ou visitez <a href="{{ url('/') }}" style="color:#22C55E;">inoha.org</a> pour parcourir la bibliothèque</p>
      </div>

      <div class="divider"></div>

      <div class="info-box">
        <h3>Récapitulatif de votre compte</h3>
        <div class="info-row">
          <span class="info-label">Nom complet</span>
          <span class="info-value">{{ $user->name }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Adresse email</span>
          <span class="info-value">{{ $user->email }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Date d'inscription</span>
          <span class="info-value">{{ now()->format('d/m/Y') }}</span>
        </div>
        <div class="info-row">
          <span class="info-label">Statut</span>
          <span class="info-value" style="color:#22C55E;">Compte actif</span>
        </div>
      </div>

      <p style="font-size: 13px; color: #6B7280; line-height: 1.7;">
        Vous recevez cet e-mail car vous venez de créer un compte sur la Bibliothèque INOHA. Si vous n'êtes pas à l'origine de cette inscription, veuillez ignorer ce message.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p style="font-weight: 700; color: #6B7280; margin-bottom: 8px;">INOHA — Bibliothèque Scientifique</p>
      <p>
        © {{ date('Y') }} INOHA. Tous droits réservés.<br>
        <a href="{{ url('/') }}">Visitez notre site</a> &nbsp;·&nbsp; <a href="{{ url('/connexion') }}">Se connecter</a>
      </p>
    </div>
  </div>

  <p style="text-align: center; font-size: 11px; color: #9CA3AF; margin-top: 20px;">
    Cet e-mail a été envoyé à {{ $user->email }}.
  </p>
</div>
</body>
</html>
