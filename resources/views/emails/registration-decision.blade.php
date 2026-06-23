<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Décision sur votre demande</title>
<style>
body { font-family: Arial, sans-serif; background: #f6f8fb; color: #111827; margin: 0; padding: 24px; }
.card { max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 16px; border: 1px solid #e5e7eb; overflow: hidden; }
.header { background: {{ $approved ? '#14532d' : '#7f1d1d' }}; color: #ffffff; padding: 28px; }
.header h1 { margin: 0; font-size: 22px; }
.content { padding: 28px; line-height: 1.65; }
.cta { display: inline-block; margin-top: 16px; padding: 12px 18px; border-radius: 10px; background: #22c55e; color: #fff !important; text-decoration: none; font-weight: 700; }
.footer { padding: 20px 28px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
</style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1>{{ $approved ? 'Compte approuvé' : 'Demande non approuvée' }}</h1>
    </div>
    <div class="content">
      <p>Bonjour {{ $user->name }},</p>

      @if($approved)
        <p>Bonne nouvelle: votre compte Bibliothèque INOHA a été approuvé. Vous pouvez maintenant vous connecter et accéder aux contenus selon votre profil.</p>
        <a class="cta" href="{{ route('user.login') }}">Se connecter</a>
      @else
        <p>Après examen, votre demande d'inscription n'a pas été approuvée pour le moment.</p>
        @if(!empty($reason))
          <p><strong>Motif communiqué:</strong> {{ $reason }}</p>
        @endif
        <p>Vous pouvez contacter l'administrateur pour plus d'informations ou soumettre une nouvelle demande ultérieurement.</p>
      @endif
    </div>
    <div class="footer">
      © {{ date('Y') }} INOHA - Université de Kinshasa
    </div>
  </div>
</body>
</html>
