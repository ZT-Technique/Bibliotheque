<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demande de compte en cours d'examen</title>
<style>
body { font-family: Arial, sans-serif; background: #f6f8fb; color: #111827; margin: 0; padding: 24px; }
.card { max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e5e7eb; overflow: hidden; }
.header { background: #0a0a0a; color: #ffffff; padding: 28px; }
.header h1 { margin: 0; font-size: 22px; }
.header p { margin: 10px 0 0; color: #d1d5db; }
.content { padding: 28px; line-height: 1.65; }
.badge { display: inline-block; padding: 6px 12px; border-radius: 999px; background: #ecfdf3; color: #15803d; font-weight: 700; font-size: 12px; letter-spacing: .4px; text-transform: uppercase; }
.box { margin-top: 18px; padding: 16px; border-radius: 12px; background: #f9fafb; border: 1px solid #e5e7eb; }
.footer { padding: 20px 28px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
</style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1>Bibliothèque INOHA</h1>
      <p>Votre demande d'accès a bien été reçue.</p>
    </div>
    <div class="content">
      <span class="badge">En cours d'examen</span>
      <p>Bonjour {{ $user->name }},</p>
      <p>Merci pour votre inscription à la Bibliothèque INOHA. Votre demande est actuellement en cours d'examen par l'équipe administrative.</p>
      <div class="box">
        <strong>Détails de la demande</strong><br>
        Email: {{ $user->email }}<br>
        Profil demandé: {{ ucfirst($user->role ?? 'apprenant') }}<br>
        Date: {{ now()->format('d/m/Y H:i') }}
      </div>
      <p>Vous recevrez un second email dès que la demande sera approuvée ou rejetée.</p>
      <p>Merci de votre confiance.</p>
    </div>
    <div class="footer">
      © {{ date('Y') }} INOHA - Université de Kinshasa
    </div>
  </div>
</body>
</html>
