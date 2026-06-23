<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouvelle demande d'inscription</title>
<style>
body { font-family: Arial, sans-serif; background: #f6f8fb; color: #111827; margin: 0; padding: 24px; }
.card { max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e5e7eb; overflow: hidden; }
.header { background: #0a0a0a; color: #ffffff; padding: 28px; }
.header h1 { margin: 0; font-size: 20px; }
.content { padding: 28px; line-height: 1.65; }
.cta { display: inline-block; margin-top: 16px; padding: 12px 18px; border-radius: 10px; background: #22c55e; color: #fff !important; text-decoration: none; font-weight: 700; }
.footer { padding: 20px 28px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
</style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1>Nouvelle demande d'inscription</h1>
    </div>
    <div class="content">
      <p>Une nouvelle demande d'accès a été soumise.</p>
      <p>
        <strong>Nom:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Profil demandé:</strong> {{ ucfirst($user->role ?? 'apprenant') }}
      </p>
      <a class="cta" href="{{ route('admin.users.index', ['tab' => 'pending']) }}">Ouvrir les demandes en attente</a>
    </div>
    <div class="footer">
      Bibliothèque INOHA - Notification système
    </div>
  </div>
</body>
</html>
