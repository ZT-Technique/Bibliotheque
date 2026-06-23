@extends('layouts.public')

@section('title', 'Articles Scientifiques')
@section('meta_og_title', 'Articles scientifiques | Bibliothèque Électronique INOHA')

@section('meta_description', 'Consultez l\'intégralité des articles et publications scientifiques disponibles sur la Bibliothèque Électronique INOHA. Filtrez par thème ou par année.')
@section('meta_keywords', 'articles, publications, bibliothèque, inoha, recherche, archive scientifique, ressources')

@section('content')
    <!-- Hero Section with Premium Search -->
    <section class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-20 lg:py-28 overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute w-full h-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-articles" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-articles)" />
            </svg>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-inoha-green/30 rounded-full blur-[160px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 bg-white/10 text-inoha-green-light px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border border-white/10">
                Archive Numérique
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                Bibliothèque <span class="text-inoha-green">Scientifique</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed mb-12">
                Accédez à une vaste collection de publications et ressources académiques rigoureusement sélectionnées.
            </p>
            
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('articles.index') }}" method="GET" class="relative group">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par titre, auteur, mots-clés..." 
                        class="w-full px-6 py-5 pl-14 rounded-2xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-4 focus:ring-inoha-green/20 focus:bg-white focus:text-inoha-black transition-all shadow-2xl backdrop-blur-md text-lg"
                    >
                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-white/50 group-hover:text-inoha-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-inoha-green text-white px-8 py-3 rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg hover:shadow-inoha-green/40">
                        Explorer
                    </button>
                    
                    @if(request('theme_id'))
                        <input type="hidden" name="theme_id" value="{{ request('theme_id') }}">
                    @endif
                    @if(request('year'))
                        <input type="hidden" name="year" value="{{ request('year') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                </form>
            </div>
        </div>
    </section>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Filters & Sorting Hub -->
            <div class="bg-white rounded-[2.5rem] p-4 lg:p-6 shadow-sm border border-gray-100 mb-12 relative -mt-20 z-20">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <!-- Theme Navigation -->
                    <div class="flex-1 overflow-x-auto no-scrollbar scroll-smooth">
                        <div class="flex items-center gap-3 whitespace-nowrap px-2">
                            <a href="{{ route('articles.index', request()->except(['theme_id', 'page'])) }}" 
                               class="px-6 py-2.5 rounded-2xl text-sm font-bold transition-all {{ !request('theme_id') ? 'bg-inoha-black text-white shadow-xl scale-105' : 'bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-inoha-black' }}">
                                Tous les Domaines
                            </a>
                            @foreach($themes as $theme)
                                <a href="{{ route('articles.index', array_merge(request()->query(), ['theme_id' => $theme->id, 'page' => 1])) }}" 
                                   class="px-6 py-2.5 rounded-2xl text-sm font-bold transition-all {{ request('theme_id') == $theme->id ? 'bg-inoha-green text-white shadow-xl scale-105' : 'bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-inoha-black' }}">
                                    {{ $theme->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Secondary Controls -->
                    <div class="flex items-center gap-4 px-2">
                        <form action="{{ route('articles.index') }}" method="GET" id="filter-form" class="flex items-center gap-3">
                            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                            @if(request('theme_id')) <input type="hidden" name="theme_id" value="{{ request('theme_id') }}"> @endif
                            
                            <div class="relative min-w-[120px]">
                                <select name="year" onchange="this.form.submit()" class="appearance-none bg-gray-50 border border-gray-100 text-inoha-black text-xs font-bold rounded-xl focus:ring-2 focus:ring-inoha-green focus:bg-white block w-full pl-4 pr-10 py-3 outline-none transition-all cursor-pointer">
                                    <option value="">Année</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>

                            <div class="relative min-w-[150px]">
                                <select name="sort" onchange="this.form.submit()" class="appearance-none bg-gray-50 border border-gray-100 text-inoha-black text-xs font-bold rounded-xl focus:ring-2 focus:ring-inoha-green focus:bg-white block w-full pl-4 pr-10 py-3 outline-none transition-all cursor-pointer">
                                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Plus récent</option>
                                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Plus ancien</option>
                                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre A-Z</option>
                                    <option value="year" {{ request('sort') == 'year' ? 'selected' : '' }}>Par Année</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Context Header -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-inoha-black tracking-tight">
                        @if(request('search'))
                            <span class="text-gray-400 font-medium text-lg block mb-1">Recherche pour</span>
                            "{{ request('search') }}"
                        @elseif(request('theme_id'))
                             <span class="text-gray-400 font-medium text-lg block mb-1">Thématique</span>
                            {{ $themes->firstWhere('id', request('theme_id'))->name ?? 'Publications' }}
                        @else
                            Toutes les <span class="text-inoha-green">Publications</span>
                        @endif
                    </h2>
                </div>
                <div class="bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm self-start">
                    <span class="text-inoha-black font-bold text-sm">
                        {{ $articles->total() }}
                    </span>
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-widest ml-1">Résultats</span>
                </div>
            </div>

            @if($articles->count() > 0)
                <!-- Optimized Articles Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-6 gap-y-10 mb-16">
                    @foreach($articles as $article)
                    <div class="group">
                        <a href="{{ route('articles.show', $article) }}" class="block relative">
                            <!-- Book Effect Container -->
                            <div class="relative perspective-lg group-hover:perspective-none transition-all duration-500">
                                <div class="relative flex shadow-xl group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-500 rounded-r-lg overflow-hidden h-[240px] sm:h-[280px]">
                                    <!-- Spine -->
                                    <div class="w-2.5 bg-gradient-to-b from-inoha-green-dark to-inoha-green flex-shrink-0"></div>
                                    <!-- Cover -->
                                    <div class="flex-1 bg-gray-100 relative overflow-hidden bg-white">
                                        @if($article->cover_image)
                                            <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center">
                                                <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                                <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest leading-tight">No Cover Available</span>
                                            </div>
                                        @endif
                                        <!-- Overlay -->
                                        <div class="absolute inset-0 bg-inoha-black/0 group-hover:bg-inoha-black/5 transition-colors"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Content Details -->
                            <div class="mt-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-[9px] font-black text-inoha-green uppercase tracking-widest truncate max-w-[80px]">{{ $article->theme->name }}</span>
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    <span class="text-[10px] font-bold text-gray-400">{{ $article->year }}</span>
                                </div>
                                <h3 class="font-bold text-sm text-inoha-black line-clamp-2 leading-snug group-hover:text-inoha-green transition-colors mb-1">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-400 text-[11px] font-medium line-clamp-1 italic">{{ $article->authors }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Custom Pagination -->
                <div class="mt-20">
                    {{ $articles->links() }}
                </div>
            @else
                <!-- Elegant Empty State -->
                <div class="text-center py-24 bg-white rounded-[3rem] border border-gray-100 shadow-sm max-w-2xl mx-auto mb-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 rounded-full mb-8">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-inoha-black mb-3">Aucun article trouvé</h3>
                    <p class="text-gray-500 mb-10 px-8">
                        Désolé, nous n'avons trouvé aucune publication correspondant à vos critères de recherche. Essayez d'élargir vos termes.
                    </p>
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-inoha-black text-white rounded-2xl font-bold hover:bg-inoha-green transition-all shadow-xl hover:shadow-inoha-green/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Réinitialiser l'exploration
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
