@extends('layouts.public')

@section('title', 'Mon Espace')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-50 via-white to-slate-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-8 rounded-3xl bg-inoha-black text-white p-6 sm:p-8 shadow-2xl overflow-hidden relative">
            <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full bg-inoha-green/20 blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-inoha-green/10 blur-2xl"></div>
            <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-inoha-green flex items-center justify-center text-white text-2xl font-black shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-gray-300">Mon espace personnel</p>
                        <h1 class="text-2xl sm:text-3xl font-black">{{ $user->name }}</h1>
                        <p class="text-sm text-gray-300">{{ $user->email }} · Profil {{ ucfirst($user->role ?? 'apprenant') }}</p>
                    </div>
                </div>
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-inoha-black font-bold hover:bg-inoha-green hover:text-white transition-all">
                    Explorer la bibliothèque
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Téléchargements</p>
                <p class="text-3xl font-black text-inoha-black mt-2">{{ $stats['downloads'] }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Favoris</p>
                <p class="text-3xl font-black text-inoha-black mt-2">{{ $stats['favorites'] }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Nouveautés 30j</p>
                <p class="text-3xl font-black text-inoha-black mt-2">{{ $stats['recent_publications'] }}</p>
            </div>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabs --}}
        @php $activeTab = request('tab', session('tab', 'profile')); @endphp
        <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm overflow-hidden">

            {{-- Tab nav --}}
            <div class="flex border-b border-slate-200">
                <a href="{{ route('user.dashboard', ['tab' => 'profile']) }}"
                   class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $activeTab === 'profile' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-slate-500 hover:text-inoha-black' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <a href="{{ route('user.dashboard', ['tab' => 'downloads']) }}"
                   class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $activeTab === 'downloads' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-slate-500 hover:text-inoha-black' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Mes Téléchargements
                    @if($downloads->total() > 0)
                        <span class="ml-1 bg-inoha-green text-white text-xs px-2 py-0.5 rounded-full font-bold">{{ $downloads->total() }}</span>
                    @endif
                </a>
                <a href="{{ route('user.dashboard', ['tab' => 'favorites']) }}"
                   class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $activeTab === 'favorites' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-slate-500 hover:text-inoha-black' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.133 6.563a1 1 0 00.95.69h6.902c.969 0 1.371 1.24.588 1.81l-5.585 4.057a1 1 0 00-.364 1.118l2.133 6.563c.3.921-.755 1.688-1.54 1.118l-5.585-4.057a1 1 0 00-1.176 0l-5.585 4.057c-.784.57-1.838-.197-1.539-1.118l2.133-6.563a1 1 0 00-.364-1.118L.476 11.99c-.784-.57-.38-1.81.588-1.81h6.902a1 1 0 00.95-.69l2.133-6.563z"/>
                    </svg>
                    Mes Favoris
                    @if($favorites->total() > 0)
                        <span class="ml-1 bg-inoha-green text-white text-xs px-2 py-0.5 rounded-full font-bold">{{ $favorites->total() }}</span>
                    @endif
                </a>
            </div>

            {{-- Profile Tab --}}
            @if($activeTab === 'profile')
            <div class="p-6 sm:p-8">
                <h2 class="text-lg font-bold text-inoha-black mb-6">Informations personnelles</h2>
                <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6 max-w-lg">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
                        <input id="name" name="name" type="text" required value="{{ old('name', $user->name) }}"
                            class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 focus:outline-none focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 transition-all sm:text-sm font-medium">
                        @error('name')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Adresse email</label>
                        <input type="email" value="{{ $user->email }}" disabled
                            class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-400 sm:text-sm font-medium cursor-not-allowed">
                        <p class="mt-1 text-xs text-slate-400">L'adresse email ne peut pas être modifiée.</p>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <h3 class="text-sm font-bold text-slate-700 mb-4">Changer le mot de passe</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe actuel</label>
                                <input id="current_password" name="current_password" type="password"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 focus:outline-none focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 transition-all sm:text-sm font-medium"
                                    placeholder="Laisser vide pour ne pas changer">
                                @error('current_password')
                                    <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Nouveau mot de passe</label>
                                <input id="password" name="password" type="password"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 focus:outline-none focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 transition-all sm:text-sm font-medium"
                                    placeholder="8 caractères minimum">
                                @error('password')
                                    <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Confirmer le nouveau mot de passe</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/30 text-slate-900 focus:outline-none focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 transition-all sm:text-sm font-medium"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit"
                            class="px-6 py-3 bg-inoha-green text-white text-sm font-bold rounded-xl hover:bg-inoha-green-dark transition-colors active:scale-[0.98]">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Downloads Tab --}}
            @if($activeTab === 'downloads')
            <div class="p-6 sm:p-8">
                <h2 class="text-lg font-bold text-inoha-black mb-6">Mes Téléchargements</h2>

                @if($downloads->count() === 0)
                    <div class="text-center py-16">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <p class="text-slate-500 font-medium mb-2">Aucun téléchargement pour l'instant</p>
                        <p class="text-slate-400 text-sm mb-6">Parcourez la bibliothèque et téléchargez vos premiers articles.</p>
                        <a href="{{ route('articles.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-inoha-green text-white text-sm font-bold rounded-xl hover:bg-inoha-green-dark transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Parcourir la bibliothèque
                        </a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($downloads as $download)
                            @if($download->article)
                            <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-inoha-green/30 transition-colors group">
                                {{-- PDF icon --}}
                                <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-red-50 border border-red-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('articles.show', $download->article) }}" class="text-sm font-semibold text-inoha-black hover:text-inoha-green transition-colors line-clamp-2">
                                        {{ $download->article->title }}
                                    </a>
                                    <div class="flex items-center gap-3 mt-1">
                                        @if($download->article->theme)
                                            <span class="text-xs text-inoha-green font-medium">{{ $download->article->theme->name }}</span>
                                            <span class="text-slate-300">·</span>
                                        @endif
                                        <span class="text-xs text-slate-400">{{ $download->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                {{-- Re-download button --}}
                                <a href="{{ route('articles.download', $download->article) }}"
                                   class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-inoha-green border border-inoha-green/30 rounded-lg hover:bg-inoha-green hover:text-white transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    PDF
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($downloads->hasPages())
                        <div class="mt-6">
                            {{ $downloads->appends(['tab' => 'downloads'])->links() }}
                        </div>
                    @endif
                @endif
            </div>
            @endif

            {{-- Favorites Tab --}}
            @if($activeTab === 'favorites')
            <div class="p-6 sm:p-8">
                <h2 class="text-lg font-bold text-inoha-black mb-6">Mes Favoris</h2>

                @if($favorites->count() === 0)
                    <div class="text-center py-16">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-amber-50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.133 6.563a1 1 0 00.95.69h6.902c.969 0 1.371 1.24.588 1.81l-5.585 4.057a1 1 0 00-.364 1.118l2.133 6.563c.3.921-.755 1.688-1.54 1.118l-5.585-4.057a1 1 0 00-1.176 0l-5.585 4.057c-.784.57-1.838-.197-1.539-1.118l2.133-6.563a1 1 0 00-.364-1.118L.476 11.99c-.784-.57-.38-1.81.588-1.81h6.902a1 1 0 00.95-.69l2.133-6.563z"/>
                            </svg>
                        </div>
                        <p class="text-slate-500 font-medium mb-2">Aucun favori enregistré</p>
                        <p class="text-slate-400 text-sm mb-6">Ajoutez des articles à vos favoris pendant votre consultation.</p>
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-inoha-black text-white text-sm font-bold rounded-xl hover:bg-inoha-green transition-colors">Découvrir les articles</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($favorites as $article)
                            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-inoha-green mb-2">{{ $article->theme->name ?? 'Thème' }}</p>
                                <a href="{{ route('articles.show', $article) }}" class="font-bold text-inoha-black hover:text-inoha-green transition-colors line-clamp-2 block">{{ $article->title }}</a>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $article->authors }}</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <a href="{{ route('articles.show', $article) }}" class="text-xs font-bold text-inoha-green hover:underline">Consulter</a>
                                    <form action="{{ route('user.favorites.toggle', $article) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-700">Retirer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($favorites->hasPages())
                        <div class="mt-6">
                            {{ $favorites->appends(['tab' => 'favorites'])->links() }}
                        </div>
                    @endif
                @endif
            </div>
            @endif
        </div>

        {{-- Sign out --}}
        <div class="mt-6 text-center">
            <form action="{{ route('user.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-sm text-slate-400 hover:text-red-500 transition-colors font-medium">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
