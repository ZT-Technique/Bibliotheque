<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bibliothèque Électronique INOHA') | Bibliothèque Électronique INOHA</title>
    <meta name="description" content="@yield('meta_description', 'Bibliothèque électronique INOHA : articles scientifiques, mémoires, rapports et ressources académiques accessibles en ligne.')">
    <meta name="keywords" content="@yield('meta_keywords', 'bibliothèque électronique, INOHA, articles scientifiques, mémoires, rapports, recherche')">
    <meta property="og:site_name" content="Bibliothèque Électronique INOHA">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="@yield('meta_og_title', trim($__env->yieldContent('title', 'Bibliothèque Électronique INOHA') . ' | Bibliothèque Électronique INOHA'))">
    <meta property="og:description" content="@yield('meta_og_description', $__env->yieldContent('meta_description', 'Bibliothèque électronique INOHA : articles scientifiques, mémoires, rapports et ressources académiques accessibles en ligne.'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('meta_og_image', route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_og_title', trim($__env->yieldContent('title', 'Bibliothèque Électronique INOHA') . ' | Bibliothèque Électronique INOHA'))">
    <meta name="twitter:description" content="@yield('meta_og_description', $__env->yieldContent('meta_description', 'Bibliothèque électronique INOHA : articles scientifiques, mémoires, rapports et ressources académiques accessibles en ligne.'))">
    <meta name="twitter:image" content="@yield('meta_og_image', route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']))">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Source+Serif+4:wght@600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        inoha: {
                            green: '#16a34a',
                            black: '#08110c',
                            gray: '#f4f7f2',
                            sand: '#e8eddc',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Source Serif 4', 'serif'],
                    },
                    boxShadow: {
                        floating: '0 18px 45px rgba(8, 17, 12, 0.12)',
                    }
                }
            }
        }
    </script>

    <style>
        .safe-pb {
            padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 5.5rem);
        }

        .toast-enter {
            animation: toast-in .28s ease-out;
        }

        .switch-dot {
            transition: transform .2s ease, background-color .2s ease;
        }

        input:checked + .switch-track .switch-dot {
            transform: translateX(1.35rem);
        }

        @keyframes toast-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-inoha-gray font-sans text-inoha-black antialiased">
    @php
        $currentUser = auth()->user();
        $isAdmin = $currentUser && (($currentUser->is_admin ?? false) || ($currentUser->effective_role ?? null) === 'admin');
        $dashboardRoute = $isAdmin ? route('admin.dashboard') : ($currentUser ? route('user.dashboard') : route('user.login'));
        $dashboardLabel = $currentUser ? ($isAdmin ? 'Admin' : 'Mon espace') : 'Connexion';
    @endphp

    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-40 bg-white border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-12 sm:h-14 w-auto">
                    </a>

                    <nav class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-[0.1em] uppercase">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-inoha-green border-b-2 border-inoha-green pb-1' : 'text-inoha-black hover:text-inoha-green' }} transition-colors">ACCUEIL</a>
                        <a href="{{ route('themes.index') }}" class="{{ request()->routeIs('themes.*') ? 'text-inoha-green border-b-2 border-inoha-green pb-1' : 'text-inoha-black hover:text-inoha-green' }} transition-colors">CATÉGORIES</a>
                        <div class="relative group">
                            <button type="button" class="{{ request()->routeIs('about') ? 'text-inoha-green border-b-2 border-inoha-green pb-1' : 'text-inoha-black hover:text-inoha-green' }} inline-flex items-center gap-2 transition-colors">
                                <span>À PROPOS</span>
                                <svg class="h-3.5 w-3.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition absolute left-0 top-full pt-2 z-50">
                                <div class="w-64 rounded-xl border border-gray-100 bg-white shadow-floating overflow-hidden">
                                    <a href="{{ route('about') }}#bibliotheque" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">À PROPOS DE LA BIBLIOTHÈQUE</a>
                                    <a href="{{ route('about') }}#inoha" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 border-t border-gray-100">À PROPOS DE L'INOHA</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-inoha-green border-b-2 border-inoha-green pb-1' : 'text-inoha-black hover:text-inoha-green' }} transition-colors">FAQ</a>
                        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-inoha-green border-b-2 border-inoha-green pb-1' : 'text-inoha-black hover:text-inoha-green' }} transition-colors">CONTACT</a>
                    </nav>

                    <div class="hidden md:flex items-center gap-4">
                        @guest
                            <a href="{{ route('user.login') }}" class="text-inoha-black text-sm font-semibold uppercase tracking-[0.1em] hover:text-inoha-green transition-colors">CONNEXION</a>
                            <a href="{{ route('user.register') }}" class="bg-inoha-green text-white px-5 py-2.5 rounded-lg text-sm font-semibold uppercase tracking-[0.1em] hover:bg-green-700 transition-colors">INSCRIPTION</a>
                        @else
                            <button type="button" data-open-notifications class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-black/10 bg-white text-gray-700 shadow-sm transition hover:border-inoha-green hover:text-inoha-green" aria-label="Préférences d'alertes">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                            <a href="{{ $dashboardRoute }}" class="bg-inoha-green text-white px-5 py-2.5 rounded-lg font-medium hover:bg-green-700 transition-colors">{{ $dashboardLabel }}</a>
                        @endguest
                    </div>

                    <button id="mobile-menu-btn" type="button" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-black/10 bg-white text-gray-700" aria-label="Menu principal">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div id="mobile-menu-overlay" class="fixed inset-0 z-[72] hidden bg-black/40"></div>
        <aside id="mobile-menu-drawer" class="fixed left-0 top-0 bottom-0 z-[73] w-80 max-w-[85vw] bg-white shadow-floating -translate-x-full transition-transform duration-300 md:hidden">
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-100">
                <img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-10 w-auto">
                <button id="mobile-menu-close" type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-black/10 text-gray-700" aria-label="Fermer le menu">&times;</button>
            </div>

            <nav class="px-4 py-4 space-y-3 text-sm font-semibold tracking-[0.12em] uppercase">
                <p class="px-1 text-[10px] font-bold tracking-[0.18em] text-gray-400">Navigation</p>
                <a href="{{ route('home') }}" class="block rounded-xl px-3 py-3 {{ request()->routeIs('home') ? 'bg-inoha-green text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">ACCUEIL</a>
                <a href="{{ route('themes.index') }}" class="block rounded-xl px-3 py-3 {{ request()->routeIs('themes.*') ? 'bg-inoha-green text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">CATÉGORIES</a>

                <div class="rounded-xl border border-gray-100 overflow-hidden">
                    <button type="button" id="mobile-about-toggle" class="w-full flex items-center justify-between px-3 py-3 text-left text-gray-700 hover:bg-gray-50">
                        <span>À PROPOS</span>
                        <svg id="mobile-about-chevron" class="h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobile-about-dropdown" class="hidden border-t border-gray-100 bg-gray-50/60">
                        <a href="{{ route('about') }}#bibliotheque" class="block px-3 py-2 text-xs font-semibold tracking-[0.1em] text-gray-700 hover:bg-gray-50">À PROPOS DE LA BIBLIOTHÈQUE</a>
                        <a href="{{ route('about') }}#inoha" class="block px-3 py-2 text-xs font-semibold tracking-[0.1em] text-gray-700 hover:bg-gray-50">À PROPOS DE L'INOHA</a>
                    </div>
                </div>

                <a href="{{ route('faq') }}" class="block rounded-xl px-3 py-3 {{ request()->routeIs('faq') ? 'bg-inoha-green text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="block rounded-xl px-3 py-3 {{ request()->routeIs('contact') ? 'bg-inoha-green text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">CONTACT</a>
            </nav>

            <div class="mt-auto px-4 pb-6 pt-2">
                @guest
                    <a href="{{ route('user.login') }}" class="block text-center rounded-lg bg-inoha-green text-white px-4 py-3 text-sm font-bold uppercase tracking-[0.14em]">Connexion</a>
                @else
                    <a href="{{ $dashboardRoute }}" class="block text-center rounded-lg bg-inoha-green text-white px-4 py-3 text-sm font-bold uppercase tracking-[0.14em]">{{ $isAdmin ? 'Admin' : 'Mon espace' }}</a>
                @endguest
            </div>
        </aside>

        <div class="fixed right-4 top-20 z-[70] flex w-[min(24rem,calc(100vw-2rem))] flex-col gap-3">
            @foreach (['success' => 'green', 'error' => 'rose', 'download_error' => 'amber', 'access_error' => 'amber'] as $flashKey => $flashColor)
                @if(session($flashKey))
                    <div data-toast class="toast-enter rounded-2xl border border-{{ $flashColor }}-200 bg-white px-4 py-3 text-sm text-gray-800 shadow-floating">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-{{ $flashColor }}-100 text-{{ $flashColor }}-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $flashColor === 'green' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01' }}" />
                                </svg>
                            </span>
                            <div class="flex-1 leading-6">{{ session($flashKey) }}</div>
                            <button type="button" data-toast-close class="text-gray-400 transition hover:text-gray-700" aria-label="Fermer">&times;</button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <main class="safe-pb flex-1">
            @yield('content')
        </main>

        <footer class="hidden md:block bg-inoha-black text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                    <div class="lg:col-span-1">
                        <img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA Logo" class="h-14 w-auto mb-4 brightness-0 invert">
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">
                            Institut One Health pour l'Afrique - Universite de Kinshasa. Promouvoir l'approche One Health pour la sante humaine, animale et environnementale.
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-4">Liens rapides</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Accueil</a></li>
                            <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Bibliothèque</a></li>
                            <li><button type="button" data-open-search class="text-gray-400 hover:text-inoha-green transition-colors">Recherche</button></li>
                            <li><a href="{{ route('themes.index') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Thèmes</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-4">Ressources</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Articles scientifiques</a></li>
                            <li><a href="{{ route('themes.index') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Mémoires et thématiques</a></li>
                            <li><a href="{{ route('themes.index') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Rapports de recherche</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-inoha-green transition-colors">À propos d'INOHA</a></li>
                            <li><a href="{{ route('faq') }}" class="text-gray-400 hover:text-inoha-green transition-colors">Questions fréquentes</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-4">Contact</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li>Universite de Kinshasa<br>B.P. 190 Kinshasa XI, RDC</li>
                            <li><a href="mailto:contact@inoha.cd" class="hover:text-inoha-green transition-colors">contact@inoha.cd</a></li>
                            <li>+243 XX XXX XXXX</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-gray-500 text-sm">{{ date('Y') }} INOHA - Institut One Health pour l'Afrique. Tous droits reserves.</p>
                    <div class="flex items-center gap-6 text-sm">
                        <span class="text-gray-500">Politique de confidentialite</span>
                        <span class="text-gray-500">Conditions d'utilisation</span>
                    </div>
                </div>
            </div>
        </footer>

        <footer class="md:hidden border-t border-black/5 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-gray-600">
                Bibliothèque électronique INOHA
            </div>
        </footer>
    </div>

    <div class="fixed inset-0 z-[80] hidden bg-black/55 px-4 py-6 backdrop-blur-sm" id="search-modal">
        <div class="mx-auto flex h-full w-full max-w-3xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-floating">
            <div class="flex items-center gap-3 border-b border-black/5 px-4 py-4 sm:px-6">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-inoha-gray text-inoha-green">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <form action="{{ route('articles.index') }}" method="GET" class="flex-1">
                    <input id="global-search-input" type="search" name="search" value="{{ request('search') }}" autocomplete="off" placeholder="Rechercher un article, un auteur, un mot-clé ou un thème" class="w-full border-0 bg-transparent text-base text-inoha-black placeholder:text-gray-400 focus:outline-none">
                </form>
                <button type="button" id="close-search-modal" class="rounded-full p-2 text-gray-400 transition hover:bg-black/5 hover:text-gray-700" aria-label="Fermer la recherche">&times;</button>
            </div>

            <div class="overflow-y-auto px-4 py-4 sm:px-6">
                <div class="mb-4 rounded-2xl bg-inoha-gray p-4 text-sm text-gray-600">La recherche suggère des articles et des thèmes dès les premiers caractères, puis lance une recherche complète dans la bibliothèque.</div>
                <div id="search-empty-state" class="rounded-2xl border border-dashed border-black/10 px-4 py-8 text-center text-sm text-gray-500">Saisissez au moins 2 caractères pour afficher des suggestions.</div>
                <div id="search-loading-state" class="hidden px-2 py-4 text-sm text-gray-500">Recherche en cours...</div>
                <div id="search-results" class="hidden space-y-6"></div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-[75] hidden bg-black/45 px-4 py-6 backdrop-blur-sm" id="notifications-modal">
        <div class="ml-auto w-full max-w-md overflow-hidden rounded-[2rem] bg-white shadow-floating">
            <div class="flex items-center justify-between border-b border-black/5 px-5 py-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.22em] text-inoha-green">Alertes</p>
                    <h2 class="font-serif text-2xl font-semibold text-inoha-black">Préférences de notifications</h2>
                </div>
                <button type="button" id="close-notifications-modal" class="rounded-full p-2 text-gray-400 transition hover:bg-black/5 hover:text-gray-700" aria-label="Fermer">&times;</button>
            </div>
            <div class="space-y-4 px-5 py-5">
                <label class="flex items-center justify-between gap-4 rounded-2xl border border-black/5 p-4">
                    <div>
                        <p class="font-medium text-inoha-black">Alertes de compte</p>
                        <p class="text-sm text-gray-500">Validation d'inscription, messages importants et accès à votre espace.</p>
                    </div>
                    <input type="checkbox" class="sr-only notification-switch" data-key="account-alerts">
                    <span class="switch-track inline-flex h-7 w-12 flex-none items-center rounded-full bg-gray-200 p-1">
                        <span class="switch-dot h-5 w-5 rounded-full bg-white shadow"></span>
                    </span>
                </label>
                <label class="flex items-center justify-between gap-4 rounded-2xl border border-black/5 p-4">
                    <div>
                        <p class="font-medium text-inoha-black">Nouveaux contenus</p>
                        <p class="text-sm text-gray-500">Être averti lorsqu'un nouveau mémoire, article ou rapport est publié.</p>
                    </div>
                    <input type="checkbox" class="sr-only notification-switch" data-key="content-alerts">
                    <span class="switch-track inline-flex h-7 w-12 flex-none items-center rounded-full bg-gray-200 p-1">
                        <span class="switch-dot h-5 w-5 rounded-full bg-white shadow"></span>
                    </span>
                </label>
                <label class="flex items-center justify-between gap-4 rounded-2xl border border-black/5 p-4">
                    <div>
                        <p class="font-medium text-inoha-black">Rappels de consultation</p>
                        <p class="text-sm text-gray-500">Conserver un rappel local pour reprendre vos recherches plus tard.</p>
                    </div>
                    <input type="checkbox" class="sr-only notification-switch" data-key="reading-reminders">
                    <span class="switch-track inline-flex h-7 w-12 flex-none items-center rounded-full bg-gray-200 p-1">
                        <span class="switch-dot h-5 w-5 rounded-full bg-white shadow"></span>
                    </span>
                </label>
            </div>
        </div>
    </div>

    <nav class="fixed inset-x-3 bottom-3 z-[65] rounded-[1.75rem] border border-black/10 bg-white/95 px-2 py-2 shadow-floating backdrop-blur lg:hidden" aria-label="Navigation rapide mobile">
        <div class="grid grid-cols-4 gap-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 text-[11px] font-medium {{ request()->routeIs('home') ? 'bg-inoha-black text-white' : 'text-gray-600' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5l9-7 9 7M5.25 9.75V20.25H18.75V9.75" /></svg>
                <span>ACCUEIL</span>
            </a>
            <a href="{{ route('themes.index') }}" class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 text-[11px] font-medium {{ request()->routeIs('themes.*') ? 'bg-inoha-black text-white' : 'text-gray-600' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.53 0 1.04.21 1.41.59l7 7a2 2 0 010 2.82l-7 7a2 2 0 01-2.82 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" /></svg>
                <span>CATÉGORIES</span>
            </a>
            <button type="button" data-open-search class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 text-[11px] font-medium text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <span>RECHERCHE</span>
            </button>
            <a href="{{ $dashboardRoute }}" class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 text-[11px] font-medium {{ request()->routeIs('user.*') || request()->routeIs('admin.*') || request()->routeIs('user.login') ? 'bg-inoha-black text-white' : 'text-gray-600' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.5a7.5 7.5 0 0115 0" /></svg>
                <span>{{ $currentUser ? 'ESPACE' : 'CONNEXION' }}</span>
            </a>
        </div>
    </nav>

    <script>
        (() => {
            const searchModal = document.getElementById('search-modal');
            const notificationsModal = document.getElementById('notifications-modal');
            const searchInput = document.getElementById('global-search-input');
            const resultsContainer = document.getElementById('search-results');
            const emptyState = document.getElementById('search-empty-state');
            const loadingState = document.getElementById('search-loading-state');
            let searchTimer = null;

            const openModal = (modal) => {
                if (!modal) {
                    return;
                }
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                if (modal === searchModal && searchInput) {
                    window.setTimeout(() => searchInput.focus(), 30);
                }
            };

            const closeModal = (modal) => {
                if (!modal) {
                    return;
                }
                modal.classList.add('hidden');
                if (searchModal?.classList.contains('hidden') && notificationsModal?.classList.contains('hidden')) {
                    document.body.classList.remove('overflow-hidden');
                }
            };

            document.querySelectorAll('[data-open-search]').forEach((button) => {
                button.addEventListener('click', () => openModal(searchModal));
            });

            document.querySelectorAll('[data-open-notifications]').forEach((button) => {
                button.addEventListener('click', () => openModal(notificationsModal));
            });

            document.getElementById('close-search-modal')?.addEventListener('click', () => closeModal(searchModal));
            document.getElementById('close-notifications-modal')?.addEventListener('click', () => closeModal(notificationsModal));

            [searchModal, notificationsModal].forEach((modal) => {
                modal?.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeModal(modal);
                    }
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeModal(searchModal);
                    closeModal(notificationsModal);
                    closeMobileMenu();
                }
            });

            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const mobileAboutToggle = document.getElementById('mobile-about-toggle');
            const mobileAboutDropdown = document.getElementById('mobile-about-dropdown');
            const mobileAboutChevron = document.getElementById('mobile-about-chevron');

            const openMobileMenu = () => {
                mobileMenuDrawer?.classList.remove('-translate-x-full');
                mobileMenuOverlay?.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const closeMobileMenu = () => {
                mobileMenuDrawer?.classList.add('-translate-x-full');
                mobileMenuOverlay?.classList.add('hidden');
                if (searchModal?.classList.contains('hidden') && notificationsModal?.classList.contains('hidden')) {
                    document.body.classList.remove('overflow-hidden');
                }
            };

            mobileMenuBtn?.addEventListener('click', openMobileMenu);
            mobileMenuClose?.addEventListener('click', closeMobileMenu);
            mobileMenuOverlay?.addEventListener('click', closeMobileMenu);

            mobileAboutToggle?.addEventListener('click', () => {
                const isHidden = mobileAboutDropdown?.classList.contains('hidden');
                mobileAboutDropdown?.classList.toggle('hidden', !isHidden);
                mobileAboutChevron?.classList.toggle('rotate-180', isHidden);
            });

            document.querySelectorAll('#mobile-menu-drawer a, #mobile-menu-drawer [data-open-search]').forEach((item) => {
                item.addEventListener('click', () => closeMobileMenu());
            });

            const renderSuggestions = (payload) => {
                const hasArticles = payload.articles.length > 0;
                const hasThemes = payload.themes.length > 0;

                if (!hasArticles && !hasThemes) {
                    resultsContainer.classList.add('hidden');
                    emptyState.textContent = 'Aucun résultat rapide trouvé. Lancez la recherche complète pour élargir les résultats.';
                    emptyState.classList.remove('hidden');
                    return;
                }

                const articleBlock = hasArticles ? `
                    <section>
                        <h3 class="mb-3 text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Articles</h3>
                        <div class="space-y-2">
                            ${payload.articles.map((item) => `
                                <a href="${item.url}" class="block rounded-2xl border border-black/5 px-4 py-3 transition hover:border-inoha-green hover:bg-inoha-gray">
                                    <div class="font-medium text-inoha-black">${item.title}</div>
                                    <div class="mt-1 text-sm text-gray-500">${item.subtitle || ''}</div>
                                </a>
                            `).join('')}
                        </div>
                    </section>` : '';

                const themeBlock = hasThemes ? `
                    <section>
                        <h3 class="mb-3 text-xs font-semibold uppercase tracking-[0.22em] text-gray-400">Thèmes</h3>
                        <div class="space-y-2">
                            ${payload.themes.map((item) => `
                                <a href="${item.url}" class="block rounded-2xl border border-black/5 px-4 py-3 transition hover:border-inoha-green hover:bg-inoha-gray">
                                    <div class="font-medium text-inoha-black">${item.title}</div>
                                    <div class="mt-1 text-sm text-gray-500">${item.subtitle || ''}</div>
                                </a>
                            `).join('')}
                        </div>
                    </section>` : '';

                resultsContainer.innerHTML = articleBlock + themeBlock;
                resultsContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
            };

            searchInput?.addEventListener('input', () => {
                const query = searchInput.value.trim();
                window.clearTimeout(searchTimer);

                if (query.length < 2) {
                    resultsContainer.classList.add('hidden');
                    emptyState.textContent = 'Saisissez au moins 2 caractères pour afficher des suggestions.';
                    emptyState.classList.remove('hidden');
                    loadingState.classList.add('hidden');
                    return;
                }

                searchTimer = window.setTimeout(async () => {
                    loadingState.classList.remove('hidden');
                    resultsContainer.classList.add('hidden');
                    emptyState.classList.add('hidden');

                    try {
                        const response = await fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error('search_failed');
                        }

                        const payload = await response.json();
                        renderSuggestions(payload);
                    } catch (error) {
                        resultsContainer.classList.add('hidden');
                        emptyState.textContent = 'Impossible de charger les suggestions pour le moment.';
                        emptyState.classList.remove('hidden');
                    } finally {
                        loadingState.classList.add('hidden');
                    }
                }, 220);
            });

            document.querySelectorAll('[data-toast]').forEach((toast) => {
                const dismiss = () => toast.remove();
                toast.querySelector('[data-toast-close]')?.addEventListener('click', dismiss);
                window.setTimeout(dismiss, 4800);
            });

            const switches = document.querySelectorAll('.notification-switch');
            switches.forEach((toggle) => {
                const storageKey = `inoha-${toggle.dataset.key}`;
                const savedValue = window.localStorage.getItem(storageKey);
                toggle.checked = savedValue === 'true';
                toggle.nextElementSibling.classList.toggle('bg-inoha-green', toggle.checked);

                toggle.addEventListener('change', async () => {
                    toggle.nextElementSibling.classList.toggle('bg-inoha-green', toggle.checked);
                    window.localStorage.setItem(storageKey, String(toggle.checked));

                    if (toggle.checked && 'Notification' in window && Notification.permission === 'default') {
                        try {
                            await Notification.requestPermission();
                        } catch (error) {
                        }
                    }
                });
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>