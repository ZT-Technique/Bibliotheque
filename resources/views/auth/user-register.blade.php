<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Créer un compte — Bibliothèque INOHA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'inoha': {
                            'green': '#22c55e',
                            'green-dark': '#16a34a',
                            'black': '#0f172a',
                        }
                    },
                    fontFamily: { 'sans': ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .input-focus:focus { border-color: #22c55e; box-shadow: 0 0 0 4px rgba(34,197,94,0.1); }
    </style>
</head>
<body class="antialiased text-slate-900 font-sans bg-slate-100 min-h-screen">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        <aside class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-inoha-black via-slate-900 to-inoha-black text-white p-12 flex-col justify-between">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute -top-16 -right-16 w-80 h-80 rounded-full bg-inoha-green blur-3xl"></div>
                <div class="absolute -bottom-16 -left-16 w-80 h-80 rounded-full bg-inoha-green blur-3xl"></div>
            </div>
            <div class="relative">
                <a href="{{ route('home') }}"><img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-16 w-auto brightness-0 invert"></a>
                <h1 class="mt-10 text-4xl font-black leading-tight">Demandez votre accès à la bibliothèque INOHA.</h1>
                <p class="mt-4 text-gray-300 max-w-md">Choisissez votre profil, soumettez votre demande et recevez une réponse officielle par email après examen.</p>
            </div>
            <div class="relative text-sm text-gray-300">© {{ date('Y') }} INOHA - Université de Kinshasa</div>
        </aside>

        <main class="flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-xl">
                <div class="lg:hidden flex justify-center mb-8">
                    <a href="{{ route('home') }}"><img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-16 w-auto"></a>
                </div>

                <h1 class="text-3xl font-black text-slate-900">Créer votre compte</h1>
                <p class="mt-2 text-sm text-slate-500">Chaque inscription est soumise à une validation administrateur.</p>

                <div class="mt-8 bg-white py-8 px-6 sm:px-10 rounded-3xl border border-slate-200 shadow-sm">

            {{-- Benefits banner --}}
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl">
                <p class="text-xs font-semibold text-green-700 uppercase tracking-wide mb-2">Inscription soumise à validation</p>
                <ul class="space-y-1">
                    <li class="flex items-center gap-2 text-sm text-green-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Sélection du profil: Apprenant, Agent ou Invité
                    </li>
                    <li class="flex items-center gap-2 text-sm text-green-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Revue de la demande par un administrateur
                    </li>
                    <li class="flex items-center gap-2 text-sm text-green-800">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Notification par email après approbation ou rejet
                    </li>
                </ul>
            </div>

            <form class="space-y-5" action="{{ route('user.register.post') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
                    <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                        placeholder="Prénom Nom">
                    @error('name')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Adresse email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                        placeholder="nom@exemple.com">
                    @error('email')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Profil demandé</label>
                    <select id="role" name="role" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 focus:outline-none input-focus transition-all sm:text-sm font-medium">
                        <option value="">Choisir un profil</option>
                        <option value="apprenant" {{ old('role') === 'apprenant' ? 'selected' : '' }}>Apprenant</option>
                        <option value="agent" {{ old('role') === 'agent' ? 'selected' : '' }}>Agent</option>
                        <option value="invite" {{ old('role') === 'invite' ? 'selected' : '' }}>Invité</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                        placeholder="8 caractères minimum">
                    @error('password')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                        placeholder="••••••••">
                </div>

                <div class="pt-1">
                    <button type="submit"
                        class="flex w-full justify-center px-4 py-3.5 rounded-xl bg-inoha-black text-white text-sm font-bold shadow-sm hover:bg-inoha-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-inoha-green transition-all active:scale-[0.98]">
                        Créer mon compte
                    </button>
                </div>

                <p class="text-xs text-center text-slate-400">Après soumission, votre compte reste en attente jusqu'à validation admin.</p>
            </form>
                </div>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Déjà un compte ?
                    <a href="{{ route('user.login') }}" class="font-bold text-inoha-green hover:text-inoha-green-dark transition-colors">Se connecter</a>
                </p>
                <p class="mt-3 text-center text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-inoha-green transition-colors">← Retour à l'accueil</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
