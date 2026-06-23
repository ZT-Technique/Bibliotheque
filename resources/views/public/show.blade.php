@extends('layouts.public')

@section('title', $article->title)
@section('meta_og_title', $article->title . ' | Bibliothèque Électronique INOHA')

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($article->abstract), 160))
@section('meta_keywords', $article->keywords)

@if($article->cover_image)
    @section('meta_og_image', route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]))
@endif

@section('content')
    <div class="bg-inoha-gray border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-inoha-green transition-colors">Accueil</a></li>
                    <li>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-inoha-green transition-colors">Bibliothèque</a></li>
                    <li>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li class="text-inoha-black font-medium truncate max-w-[200px] md:max-w-md">{{ $article->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 sm:gap-16">
            <!-- Left Column: Article Details -->
            <div class="lg:col-span-8">
                <div class="flex flex-col md:flex-row gap-8 mb-12">
                    <!-- Book Cover -->
                    <div class="w-full md:w-64 flex-shrink-0">
                        <div class="relative flex">
                            <div class="book-spine w-4 bg-inoha-green-dark rounded-l-sm"></div>
                            <div class="book-cover flex-1 rounded-r-lg overflow-hidden shadow-2xl bg-gray-100">
                                @if($article->cover_image)
                                    <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
                                @else
                                    <div class="aspect-[3/4] flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-8 flex flex-col gap-3">
                            <a href="{{ route('articles.download', $article) }}" class="flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Télécharger PDF
                            </a>
                            @auth
                                @if(!(auth()->user()->is_admin || (auth()->user()->role ?? null) === 'admin'))
                                    @php
                                        $isFavorite = auth()->user()->favoriteArticles()->where('article_id', $article->id)->exists();
                                    @endphp
                                    <form action="{{ route('user.favorites.toggle', $article) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center justify-center gap-2 w-full px-6 py-3.5 {{ $isFavorite ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} rounded-xl font-bold hover:opacity-90 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.133 6.563a1 1 0 00.95.69h6.902c.969 0 1.371 1.24.588 1.81l-5.585 4.057a1 1 0 00-.364 1.118l2.133 6.563c.3.921-.755 1.688-1.54 1.118l-5.585-4.057a1 1 0 00-1.176 0l-5.585 4.057c-.784.57-1.838-.197-1.539-1.118l2.133-6.563a1 1 0 00-.364-1.118L.476 11.99c-.784-.57-.38-1.81.588-1.81h6.902a1 1 0 00.95-.69l2.133-6.563z"/>
                                            </svg>
                                            {{ $isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            @guest
                            <p class="text-xs text-center text-gray-500">
                                <svg class="w-3.5 h-3.5 inline mr-1 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                <a href="{{ route('user.login') }}" class="text-inoha-green font-semibold hover:underline">Connexion requise</a> pour télécharger
                            </p>
                            @endguest
                            <button onclick="document.getElementById('pdf-preview').scrollIntoView({behavior: 'smooth'})" class="flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-white text-inoha-black border-2 border-gray-100 rounded-xl font-bold hover:bg-gray-50 transition-all">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Prévisualiser
                            </button>

                            <div class="mt-2 flex items-center justify-center gap-2 py-2 px-4 bg-gray-50 rounded-lg border border-gray-100">
                                <svg class="w-4 h-4 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span class="text-xs font-bold text-gray-600">
                                    <span class="text-inoha-black">{{ number_format($article->downloads_count, 0, ',', ' ') }}</span> téléchargements
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Article Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-4">
                            <a href="{{ route('articles.index', ['theme_id' => $article->theme_id]) }}" class="px-3 py-1 bg-inoha-green/10 text-inoha-green text-xs font-bold rounded-full hover:bg-inoha-green/20 transition-colors">
                                {{ $article->theme->name }}
                            </a>
                            <span class="text-gray-400 text-xs font-medium">{{ $article->year }}</span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-inoha-black leading-tight mb-6">
                            {{ $article->title }}
                        </h1>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100 mb-6">
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Auteurs</h3>
                                <p class="text-inoha-black font-semibold">{{ $article->authors }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Date de publication</h3>
                                <p class="text-inoha-black font-semibold">
                                    @if($article->publication_date)
                                        {{ $article->publication_date->translatedFormat('d F Y') }}
                                    @elseif($article->year)
                                        {{ $article->year }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Type d'ouvrage</h3>
                                <p class="text-inoha-black font-semibold">Article Scientifique</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Keywords</h3>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @php $keywords = explode(',', $article->keywords); @endphp
                                    @foreach($keywords as $keyword)
                                        @if(trim($keyword))
                                            <span class="text-[10px] bg-white border border-gray-200 text-gray-600 px-2 py-0.5 rounded">{{ trim($keyword) }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Author Profile Card --}}
                        @if($article->author_image || $article->author_level || $article->author_country)
                        <div class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-gray-200 shadow-sm mb-8">
                            {{-- Photo --}}
                            @if($article->author_image)
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-inoha-green/30 flex-shrink-0">
                                <img src="{{ route('uploads.serve', ['type' => 'authors', 'filename' => basename($article->author_image)]) }}"
                                     alt="{{ $article->authors }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="w-16 h-16 rounded-full bg-inoha-green/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            @endif
                            {{-- Info --}}
                            <div>
                                <p class="font-bold text-inoha-black text-sm">{{ $article->authors }}</p>
                                <div class="flex items-center flex-wrap gap-3 mt-1">
                                    @if($article->author_level)
                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        </svg>
                                        {{ $article->author_level }}
                                    </span>
                                    @endif
                                    @if($article->author_country)
                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $article->author_country }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Abstract -->
                @if($article->abstract)
                <div class="mb-16">
                    <h2 class="text-2xl font-bold text-inoha-black mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-inoha-green rounded-full"></span>
                        Résumé
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed text-justify">
                        {{ $article->abstract }}
                    </div>
                </div>
                @endif

                <!-- PDF Preview -->
                <div id="pdf-preview" class="mb-16">
                    <h2 class="text-2xl font-bold text-inoha-black mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-inoha-green rounded-full"></span>
                        Prévisualisation PDF
                    </h2>
                    <div class="bg-gray-100 rounded-3xl overflow-hidden shadow-inner border border-gray-200 aspect-square md:aspect-video relative group">
                        @if($article->pdf_path)
                            <iframe src="{{ route('uploads.serve', ['type' => 'pdfs', 'filename' => basename($article->pdf_path)]) }}#toolbar=0" class="w-full h-full" frameborder="0"></iframe>
                            <div class="absolute inset-0 bg-inoha-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                <span class="bg-white text-inoha-black px-6 py-2 rounded-full font-bold shadow-xl">Aperçu interactif</span>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 p-10 text-center">
                                <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-lg">Prévisualisation PDF non disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                    <h3 class="text-xl font-bold text-inoha-black mb-6">Articles reliés</h3>
                    <div class="space-y-6">
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related) }}" class="flex items-start gap-4 group">
                            <div class="w-16 h-20 flex-shrink-0 relative flex">
                                <div class="w-1.5 bg-inoha-green group-hover:bg-inoha-green-dark rounded-l-sm transition-colors"></div>
                                <div class="flex-1 rounded-r-md overflow-hidden shadow-sm bg-gray-50 border border-l-0 border-gray-100">
                                    @if($related->cover_image)
                                        <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($related->cover_image)]) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-inoha-black line-clamp-2 group-hover:text-inoha-green transition-colors">
                                    {{ $related->title }}
                                </h4>
                                <p class="text-xs text-gray-500 mt-1 truncate">{{ $related->authors }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('articles.index') }}" class="mt-8 block w-full py-3 text-center text-sm font-bold text-gray-400 hover:text-inoha-green border-t border-gray-50 transition-colors">
                        Voir tout le catalogue
                    </a>
                </div>
                @endif

                <!-- Bannière Publicitaire -->
                @if($banniereArticle ?? false)
                <div class="relative group">
                    <a href="{{ $banniereArticle->link ?? '#' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ route('uploads.serve', ['type' => 'bannieres', 'filename' => basename($banniereArticle->image_path)]) }}"
                             alt="{{ $banniereArticle->title ?? 'Publicité' }}"
                             class="w-full rounded-2xl object-cover shadow-sm transition-opacity duration-300 group-hover:opacity-90">
                    </a>
                    <span class="absolute top-2 right-2 text-[9px] text-white font-bold uppercase tracking-widest bg-inoha-green px-2 py-0.5 rounded-full pointer-events-none shadow">
                        Publicité
                    </span>
                </div>
                @endif

                <!-- Library Stats Card -->
                <div class="bg-inoha-black rounded-3xl p-8 text-white relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-inoha-green/20 rounded-full blur-2xl"></div>
                    <h3 class="text-xl font-bold mb-4 relative z-10">Prêt pour vos recherches ?</h3>
                    <p class="text-gray-400 text-sm mb-6 relative z-10">
                        Inscrivez-vous pour sauvegarder vos lectures et recevoir les nouvelles publications.
                    </p>
                    @guest
                    <a href="{{ route('user.register') }}" class="w-full block py-3 text-center bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all relative z-10">
                        S'inscrire gratuitement
                    </a>
                    @else
                    <a href="{{ route('user.dashboard', ['tab' => 'downloads']) }}" class="w-full block py-3 text-center bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all relative z-10">
                        Mes Téléchargements
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection


