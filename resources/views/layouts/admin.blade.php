<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'inoha': {
                            'green': '#22C55E',
                            'green-dark': '#16A34A',
                            'green-light': '#4ADE80',
                            'black': '#0A0A0A',
                            'gray': '#F8FAFC',
                        }
                    },
                    fontFamily: { 'sans': ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        :root {
            --sidebar-w: 260px;
        }
        * { box-sizing: border-box; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(34,197,94,0.6); }
        main::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); }
        main::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }

        .sidebar {
            width: var(--sidebar-w);
            background: #0A0A0A;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 50;
            transition: transform 0.3s ease;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar.mobile-hidden { transform: translateX(-100%); }

        .main-wrap {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 1023px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            padding: 6px 16px 4px;
            margin-top: 14px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            transition: all 0.15s;
            margin: 2px 10px;
            position: relative;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }
        .nav-link.active {
            background: linear-gradient(135deg, #22C55E, #16A34A);
            color: #fff;
            box-shadow: 0 2px 10px rgba(34,197,94,0.3);
        }
        .nav-link svg {
            width: 18px; height: 18px; flex-shrink: 0;
            opacity: 0.7;
        }
        .nav-link.active svg, .nav-link:hover svg { opacity: 1; }

        .badge {
            margin-left: auto;
            min-width: 20px; height: 20px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            padding: 0 6px;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-inoha-black antialiased">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="flex flex-col h-full overflow-hidden">

            <!-- Logo -->
            <div class="flex items-center gap-3 px-5 py-6 border-b border-white/[0.07] flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ route('uploads.serve', ['type' => 'branding', 'filename' => 'Logo-INOHA-Transparent.png']) }}" alt="INOHA" class="h-10 w-auto brightness-0 invert">
                </a>
                <span class="text-[10px] font-bold uppercase tracking-widest text-white/30 ml-auto">v1.0</span>
            </div>

            <!-- Nav -->
            <nav class="flex-1 overflow-y-auto py-4">

                <!-- Général -->
                <div class="nav-label">Général</div>
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 5a1 1 0 011-1h5a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm9 0a1 1 0 011-1h5a1 1 0 011 1v5a1 1 0 01-1 1h-5a1 1 0 01-1-1V5zM4 14a1 1 0 011-1h5a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zm9 0a1 1 0 011-1h5a1 1 0 011 1v5a1 1 0 01-1 1h-5a1 1 0 01-1-1v-5z"/>
                    </svg>
                    Tableau de bord
                </a>
                <a href="{{ route('admin.stats.index') }}"
                   class="nav-link {{ request()->routeIs('admin.stats.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistiques
                </a>

                <!-- Contenu -->
                <div class="nav-label">Contenu</div>
                <a href="{{ route('admin.articles.index') }}"
                   class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Articles
                </a>
                <a href="{{ route('admin.themes.index') }}"
                   class="nav-link {{ request()->routeIs('admin.themes.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Catégories
                </a>

                <!-- Médias -->
                <div class="nav-label">Médias</div>
                <a href="{{ route('admin.sliders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Slider Hero
                </a>
                <a href="{{ route('admin.bannieres.index') }}"
                   class="nav-link {{ request()->routeIs('admin.bannieres.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm0 8a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zm12 0a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    Bannières
                </a>

                <!-- Utilisateurs -->
                <div class="nav-label">Utilisateurs</div>
                @php
                    $pendingApprovals = \App\Models\User::where('approval_status', 'pending')->count();
                    $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                @endphp
                <a href="{{ route('admin.users.index', ['tab' => 'users']) }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') && request()->get('tab', 'users') === 'users' ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Membres
                </a>
                <a href="{{ route('admin.users.index', ['tab' => 'pending']) }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') && request()->get('tab') === 'pending' ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Inscriptions
                    @if($pendingApprovals > 0)
                        <span class="badge bg-amber-500 text-white">{{ $pendingApprovals }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.users.index', ['tab' => 'admins']) }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') && request()->get('tab') === 'admins' ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Administrateurs
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                   class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Messages
                    @if($unreadCount > 0)
                        <span class="badge bg-rose-500 text-white">{{ $unreadCount }}</span>
                    @endif
                </a>

            </nav>

            <!-- Footer user -->
            <div class="flex-shrink-0 border-t border-white/[0.07] p-3">
                <a href="{{ route('admin.profile.edit') }}"
                   class="flex items-center gap-3 rounded-xl px-3 py-3 hover:bg-white/[0.07] transition-colors group">
                    <div class="w-10 h-10 rounded-full overflow-hidden border border-white/20 flex-shrink-0">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ route('uploads.serve', ['type' => 'profiles', 'filename' => Auth::user()->profile_photo]) }}"
                                 alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-inoha-green flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/40 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </a>
                <div class="flex items-center justify-end mt-1 px-3 pb-1">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 text-xs font-semibold text-white/35 hover:text-rose-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </aside>

    <!-- Overlay mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden backdrop-blur-sm"></div>

    <!-- Main wrap -->
    <div class="main-wrap">
        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur border-b border-gray-100 px-5 sm:px-8 py-4">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <!-- Burger mobile -->
                    <button id="sidebar-toggle"
                        class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-lg sm:text-xl font-bold text-inoha-black">
                        @yield('page-title', 'Tableau de bord')
                    </h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="hidden sm:flex items-center gap-2 text-sm font-medium text-gray-500">
                        <span class="w-2 h-2 bg-inoha-green rounded-full animate-pulse"></span>
                        Mode Administration
                    </span>
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-inoha-green border border-inoha-green/30 hover:bg-inoha-green/10 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Voir le site
                    </a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Toasts -->
    <div class="fixed right-4 top-16 z-[70] flex flex-col gap-2 w-[min(22rem,calc(100vw-2rem))]">
        @foreach (['success' => 'green', 'error' => 'rose'] as $flashKey => $flashColor)
            @if(session($flashKey))
                <div data-toast class="rounded-xl border border-{{ $flashColor }}-200 bg-white px-4 py-3 text-sm text-gray-800 shadow-xl">
                    <div class="flex items-start gap-3">
                        <span class="mt-0.5 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-{{ $flashColor }}-100 text-{{ $flashColor }}-700">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $flashColor === 'green' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01' }}"/>
                            </svg>
                        </span>
                        <div class="flex-1">{{ session($flashKey) }}</div>
                        <button data-toast-close class="text-gray-400 hover:text-gray-700">&times;</button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="fixed inset-0 z-[60] hidden" aria-modal="true" role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div id="delete-modal-overlay" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 sm:p-8 border border-gray-100">
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Confirmer la suppression</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Cette action est irréversible.</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    Êtes-vous sûr de vouloir supprimer cet élément ? Les données liées pourraient être affectées.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="confirm-delete-btn"
                        class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                        Supprimer
                    </button>
                    <button id="close-delete-modal"
                        class="flex-1 inline-flex justify-center items-center px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-colors">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar mobile
        const toggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('hidden');
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
            });
        }

        // Delete modal
        const deleteModal = document.getElementById('delete-modal');
        const closeDeleteModal = document.getElementById('close-delete-modal');
        const deleteOverlay = document.getElementById('delete-modal-overlay');
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
        let formToSubmit = null;

        window.confirmDelete = function(form) {
            formToSubmit = form;
            deleteModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };

        const hideModal = () => {
            deleteModal.classList.add('hidden');
            document.body.style.overflow = '';
            formToSubmit = null;
        };

        closeDeleteModal?.addEventListener('click', hideModal);
        deleteOverlay?.addEventListener('click', hideModal);
        confirmDeleteBtn?.addEventListener('click', () => {
            if (formToSubmit) {
                confirmDeleteBtn.disabled = true;
                confirmDeleteBtn.innerHTML = `<svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Suppression…`;
                formToSubmit.submit();
            }
        });

        // Toasts
        document.querySelectorAll('[data-toast]').forEach(toast => {
            toast.querySelector('[data-toast-close]')?.addEventListener('click', () => toast.remove());
            setTimeout(() => toast.remove(), 5000);
        });
    </script>
    @stack('scripts')
</body>
</html>
