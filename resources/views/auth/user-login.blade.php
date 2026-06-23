<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion — Bibliothèque INOHA</title>
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
        <aside class="hidden lg:flex relative overflow-hidden bg-inoha-black text-white p-12 flex-col justify-between">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute -top-20 -left-20 w-96 h-96 rounded-full bg-inoha-green blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-72 h-72 rounded-full bg-inoha-green blur-3xl"></div>
            </div>
            <div class="relative">
                <a href="{{ route('home') }}"><img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-16 w-auto brightness-0 invert"></a>
                <h1 class="mt-10 text-4xl font-black leading-tight">Reconnectez-vous à votre espace de recherche.</h1>
                <p class="mt-4 text-gray-300 max-w-md">Suivez vos téléchargements, gérez vos favoris et poursuivez vos explorations académiques en quelques clics.</p>
            </div>
            <div class="relative text-sm text-gray-300">
                © {{ date('Y') }} INOHA - Université de Kinshasa
            </div>
        </aside>

        <main class="flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">
                <div class="lg:hidden flex justify-center mb-8">
                    <a href="{{ route('home') }}"><img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-16 w-auto"></a>
                </div>

                <h2 class="text-3xl font-black text-slate-900">Connexion</h2>
                <p class="mt-2 text-sm text-slate-500">Accédez à votre tableau utilisateur INOHA.</p>

                <div class="mt-8 bg-white py-8 px-6 sm:px-8 rounded-3xl border border-slate-200 shadow-sm">

            {{-- Flash success --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Flash error (e.g. redirect after trying to download) --}}
            @if(session('download_error'))
                <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl text-amber-700 text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('download_error') }}</span>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('user.login.post') }}" method="POST">
                @csrf

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
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Mot de passe</label>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-inoha-green focus:ring-inoha-green/20 cursor-pointer">
                    <label for="remember" class="ml-3 block text-sm text-slate-500 cursor-pointer font-medium">Se souvenir de moi</label>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center px-4 py-3.5 rounded-xl bg-inoha-black text-white text-sm font-bold shadow-sm hover:bg-inoha-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-inoha-green transition-all active:scale-[0.98]">
                        Se connecter
                    </button>
                </div>
            </form>
                </div>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Pas encore de compte ?
                    <a href="{{ route('user.register') }}" class="font-bold text-inoha-green hover:text-inoha-green-dark transition-colors">Créer un compte</a>
                </p>
                <p class="mt-3 text-center text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="hover:text-inoha-green transition-colors">← Retour à l'accueil</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
