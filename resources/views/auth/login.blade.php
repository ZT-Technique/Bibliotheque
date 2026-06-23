<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administration — INOHA</title>
    
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
                            'green-hover': '#16a34a',
                            'black': '#0f172a',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            background-color: #f9fafb;
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }
        .login-card {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }
        .input-focus:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
        }
    </style>
</head>
<body class="antialiased text-slate-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo area -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('home') }}" class="transition-opacity hover:opacity-80">
                    <img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-16 w-auto">
                </a>
            </div>
            
            <h2 class="text-center text-2xl font-bold tracking-tight text-slate-900">
                Espace Administration
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                Identifiez-vous pour accéder à la gestion
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[440px]">
            <div class="bg-white py-10 px-6 sm:px-12 rounded-2xl border border-slate-200/60 shadow-sm">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                            Adresse email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                            placeholder="nom@exemple.com">
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">
                                Mot de passe
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-inoha-green hover:text-inoha-green-hover transition-colors">
                                    Oublié ?
                                </a>
                            @endif
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 placeholder-slate-400 focus:outline-none input-focus transition-all sm:text-sm font-medium"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-inoha-green focus:ring-inoha-green/20 cursor-pointer">
                        <label for="remember_me" class="ml-3 block text-sm text-slate-500 cursor-pointer font-medium">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center px-4 py-3.5 rounded-xl bg-inoha-green text-white text-sm font-bold shadow-sm hover:bg-inoha-green-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-inoha-green transition-all active:scale-[0.98]">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-10 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    &copy; {{ date('Y') }} INOHA — Université de Kinshasa
                </p>
            </div>
        </div>
    </div>
</body>
</html>


