@extends('layouts.public')

@section('title', 'Accueil')
@section('meta_og_title', 'Accueil | Bibliothèque Électronique INOHA')

@section('meta_description', 'Bienvenue sur la Bibliothèque Électronique INOHA. Accédez à une collection riche d\'articles scientifiques, de thématiques de recherche et de ressources académiques de pointe.')
@section('meta_keywords', 'bibliothèque, recherche, articles scientifiques, inoha, académique, thématiques, savoir, science')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-16 lg:py-24 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-inoha-green rounded-full blur-3xl text-inoha-green"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-inoha-green rounded-full blur-3xl text-inoha-green"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center text-center lg:text-left">
                <!-- Left Column: Content -->
                <div class="z-10">
                    <span class="inline-flex items-center gap-2 bg-inoha-green/20 text-inoha-green-light px-4 py-2 rounded-full text-sm font-medium mb-8">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        Bibliothèque Scientifique Électronique
                    </span>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Centre de Ressources <br><span class="text-inoha-green">Numériques</span>
                    </h1>
                    
                    <p class="text-lg sm:text-xl text-gray-400 max-w-2xl mx-auto lg:mx-0 mb-10 text-pretty">
                        Explorez notre collection de publications scientifiques, articles et thèses de recherche classés par thèmes spécialisés.
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto lg:mx-0 mb-12">
                        <form action="{{ route('articles.index') }}" method="GET" class="relative group">
                            <input 
                                type="text" 
                                name="search"
                                placeholder="Rechercher des articles, thèmes..." 
                                class="w-full px-6 py-5 pl-14 rounded-2xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-inoha-green/20 focus:bg-white focus:text-inoha-black transition-all shadow-2xl text-lg backdrop-blur-sm"
                            >
                            <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <button type="submit" class="hidden sm:block absolute right-3 top-1/2 -translate-y-1/2 bg-inoha-green text-white px-8 py-3 rounded-xl font-bold hover:bg-inoha-green-dark transition-all transform hover:scale-105 active:scale-95 shadow-lg shadow-inoha-green/20">
                                Rechercher
                            </button>
                        </form>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center lg:justify-start gap-8 sm:gap-12">
                        <div>
                            <div class="text-3xl font-bold text-white mb-1">{{ \App\Models\Article::count() }}+</div>
                            <div class="text-gray-500 text-sm uppercase tracking-wider font-semibold">Publications</div>
                        </div>
                        <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                        <div>
                            <div class="text-3xl font-bold text-white mb-1">{{ \App\Models\Theme::count() }}</div>
                            <div class="text-gray-500 text-sm uppercase tracking-wider font-semibold">Thématiques</div>
                        </div>
                        <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                        <div>
                            <div class="text-3xl font-bold text-inoha-green mb-1">24/7</div>
                            <div class="text-gray-500 text-sm uppercase tracking-wider font-semibold">Accès Libre</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Slider (Visible on Desktop & Mobile) -->
                <div class="relative mt-12 lg:mt-0 perspective-1000">
                    <div class="relative w-[240px] h-[340px] sm:w-[280px] sm:h-[400px] lg:w-[320px] lg:h-[450px] mx-auto hero-slider">
                        @php
                            $displaySlides = $sliders->count() > 0 ? $sliders : $recentArticles->take(5);
                        @endphp

                        @foreach($displaySlides as $index => $item)
                            <div class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out transform {{ $index === 0 ? 'opacity-100 translate-x-0 scale-100' : 'opacity-0 translate-x-8 scale-90 pointer-events-none' }}" data-index="{{ $index }}">
                                <div class="relative w-full h-full flex shadow-2xl rounded-r-xl overflow-hidden group">
                                    <div class="w-4 bg-inoha-green-dark rounded-l-sm shadow-inner"></div>
                                    <div class="relative flex-1 bg-white overflow-hidden rounded-r-xl">
                                        @if($item instanceof \App\Models\Slider)
                                            <img src="{{ route('uploads.serve', ['type' => 'sliders', 'filename' => basename($item->image_path)]) }}" 
                                                 alt="{{ $item->title }}" 
                                                 class="w-full h-full object-cover">
                                            @if($item->link || $item->title)
                                                <!-- Overlay -->
                                                <div class="absolute inset-0 bg-gradient-to-t from-inoha-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                                    <div>
                                                        @if($item->title)
                                                            <h3 class="text-white font-bold text-lg mb-1">{{ $item->title }}</h3>
                                                        @endif
                                                        @if($item->link)
                                                            <a href="{{ $item->link }}" target="_blank" class="text-inoha-green-light text-sm font-bold hover:underline">Voir plus &rarr;</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            @if($item->cover_image)
                                                <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($item->cover_image)]) }}" 
                                                     alt="{{ $item->title }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gray-100 flex flex-col items-center justify-center p-8 text-center">
                                                    <svg class="w-20 h-20 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                    </svg>
                                                    <span class="text-xs text-gray-400 font-medium uppercase tracking-widest line-clamp-3">{{ $item->title }}</span>
                                                </div>
                                            @endif
                                            <!-- Overlay -->
                                            <div class="absolute inset-0 bg-gradient-to-t from-inoha-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                                <a href="{{ route('articles.show', $item) }}" class="text-white font-bold hover:text-inoha-green transition-colors line-clamp-2">
                                                    {{ $item->title }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Decorative stack effect -->
                                <div class="absolute -right-4 -bottom-4 w-full h-full border-2 border-white/5 rounded-xl -z-10 bg-white/5"></div>
                                <div class="absolute -right-8 -bottom-8 w-full h-full border-2 border-white/5 rounded-xl -z-20 bg-white/5"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.hero-slide');
            if (slides.length <= 1) return;

            let currentSlide = 0;
            const totalSlides = slides.length;

            const nextSlide = () => {
                slides[currentSlide].classList.remove('opacity-100', 'translate-x-0', 'scale-100');
                slides[currentSlide].classList.add('opacity-0', 'translate-x-8', 'scale-90', 'pointer-events-none');

                currentSlide = (currentSlide + 1) % totalSlides;

                slides[currentSlide].classList.remove('opacity-0', 'translate-x-8', 'scale-90', 'pointer-events-none');
                slides[currentSlide].classList.add('opacity-100', 'translate-x-0', 'scale-100');
            };

            setInterval(nextSlide, 4000);
        });
    </script>

    <!-- ===== BANNIÈRE PUBLICITAIRE A ===== -->
    @if($banniereA)
    <section class="py-6 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative group">
                <a href="{{ $banniereA->link ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $banniereA->title ?? 'Publicité' }}">
                    <img src="{{ route('uploads.serve', ['type' => 'bannieres', 'filename' => basename($banniereA->image_path)]) }}"
                         alt="{{ $banniereA->title ?? 'Bannière publicitaire' }}"
                         class="w-full rounded-xl shadow-sm object-cover max-h-[160px] transition-opacity duration-300 group-hover:opacity-90">
                </a>
                <span class="absolute top-2 right-2 text-[9px] text-white font-bold uppercase tracking-widest bg-inoha-green px-2 py-0.5 rounded-full pointer-events-none shadow">
                    Publicité
                </span>
            </div>
        </div>
    </section>
    @endif
    <!-- ===== FIN BANNIÈRE PUBLICITAIRE A ===== -->

    <!-- Publications à la une (Recent Articles) -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold">Dernières Publications</h2>
                    <p class="text-gray-500 mt-2">Découvrez les derniers articles ajoutés à notre collection</p>
                </div>
                <a href="{{ route('articles.index') }}" class="hidden sm:flex items-center gap-2 text-inoha-green font-medium hover:underline">
                    Voir toute la collection
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            
            <!-- Articles Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                @foreach($recentArticles as $article)
                <div class="book-card group flex flex-col h-full">
                    <a href="{{ route('articles.show', $article) }}" class="block relative group-hover:-translate-y-1 transition-transform duration-300">
                        <div class="relative flex aspect-[3/4]">
                            <!-- Book Spine -->
                            <div class="book-spine w-3 bg-inoha-green-dark rounded-l-sm transition-all duration-300 group-hover:w-4"></div>
                            
                            <!-- Book Cover -->
                            <div class="book-cover flex-1 rounded-r-md overflow-hidden shadow-md group-hover:shadow-xl transition-all duration-300 relative">
                                @if($article->cover_image)
                                    <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Overlay Badge (Theme) -->
                                @if($article->theme)
                                    <div class="absolute top-2 right-2 z-10">
                                        <span class="px-2 py-0.5 bg-inoha-green text-white text-[10px] font-bold rounded shadow-lg uppercase tracking-wider">
                                            {{ $article->theme->name }}
                                        </span>
                                    </div>
                                @endif
                                
                                <!-- Read Overlay -->
                                <div class="absolute inset-0 bg-inoha-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="w-10 h-10 rounded-full bg-white text-inoha-green flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Metadata -->
                    <div class="mt-4 flex flex-col flex-1 pb-2">
                        <div class="flex items-center gap-3 mb-1.5 px-0.5">
                            <span class="flex items-center text-[10px] font-bold text-inoha-green-dark bg-inoha-green/10 px-1.5 py-0.5 rounded uppercase tracking-tighter">
                                {{ $article->year }}
                            </span>
                            <div class="flex items-center text-gray-400 text-[11px]">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                                {{ $article->downloads_count ?? 0 }}
                            </div>
                        </div>

                        <h3 class="font-bold text-sm text-gray-900 group-hover:text-inoha-green transition-colors line-clamp-2 leading-snug mb-1">
                            <a href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h3>

                        <div class="flex items-start gap-2 mt-auto pt-3 border-t border-gray-50">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-inoha-green/10 flex items-center justify-center">
                                <svg class="w-3 h-3 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-[11px] line-clamp-2 leading-tight">
                                {{ $article->authors }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===== BANNIÈRE PUBLICITAIRE B ===== -->
    @if($banniereB)
    <section class="py-8 bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative group max-w-4xl mx-auto">
                <a href="{{ $banniereB->link ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $banniereB->title ?? 'Publicité' }}">
                    <img src="{{ route('uploads.serve', ['type' => 'bannieres', 'filename' => basename($banniereB->image_path)]) }}"
                         alt="{{ $banniereB->title ?? 'Bannière publicitaire' }}"
                         class="w-full rounded-xl shadow-sm object-cover max-h-[120px] transition-opacity duration-300 group-hover:opacity-90">
                </a>
                <span class="absolute top-2 right-2 text-[9px] text-white font-bold uppercase tracking-widest bg-inoha-green px-2 py-0.5 rounded-full pointer-events-none shadow">
                    Publicité
                </span>
            </div>
        </div>
    </section>
    @endif
    <!-- ===== FIN BANNIÈRE PUBLICITAIRE B ===== -->

    <!-- Categories (Themes) -->
    <section class="py-12 bg-inoha-gray border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold">Explorer par thématique</h2>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('articles.index') }}" class="px-5 py-2.5 {{ !request('theme_id') ? 'bg-inoha-green text-white' : 'bg-white text-inoha-black border border-gray-200 hover:bg-inoha-green hover:text-white' }} rounded-full font-medium transition-colors">
                    Tous les articles
                </a>
                @foreach($themes as $theme)
                <a href="{{ route('articles.index', ['theme_id' => $theme->id]) }}" class="px-5 py-2.5 bg-white text-inoha-black rounded-full font-medium hover:bg-inoha-green hover:text-white transition-colors border border-gray-200">
                    {{ $theme->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-inoha-black text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold mb-4">Accédez à la connaissance</h2>
            <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                Notre bibliothèque offre un accès libre et gratuit à des milliers de ressources scientifiques pour les chercheurs, étudiants et professionnels.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('articles.index') }}" class="px-6 py-3 bg-inoha-green text-white rounded-lg font-medium hover:bg-inoha-green-dark transition-colors">
                    Consulter la collection
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 border border-gray-600 text-white rounded-lg font-medium hover:bg-white/10 transition-colors">
                    Contactez-nous
                </a>
            </div>
        </div>
    </section>
@endsection
