@extends('layouts.public')

@section('title', 'Catégories de Recherche')
@section('meta_og_title', 'Catégories de recherche | Bibliothèque Électronique INOHA')

@section('meta_description', 'Explorez les différentes thématiques de recherche de la Bibliothèque Électronique INOHA. Accédez à des ressources ciblées par domaines d\'études.')
@section('meta_keywords', 'thématiques, domaines de recherche, inoha, sciences, technologie, économie, ressources académiques')

@section('content')
    <!-- Hero Section with Pattern -->
    <section class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-20 lg:py-28 overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute w-full h-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-inoha-green/30 rounded-full blur-[160px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 bg-white/10 text-inoha-green-light px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border border-white/10">
                Exploration Scientifique
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight">
                Domaines de <span class="text-inoha-green">Spécialisation</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                Parcourez notre catalogue structuré par catégories pour accéder aux recherches les plus pertinentes dans votre domaine.
            </p>
            
            <!-- Dynamic Search Support -->
            <div class="max-w-xl mx-auto mt-12">
                <div class="relative group">
                    <input 
                        type="text" 
                        id="theme-search"
                        placeholder="Rechercher une catégorie (ex: Finance, Santé...)" 
                        class="w-full px-6 py-4 pl-14 rounded-2xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-4 focus:ring-inoha-green/20 focus:bg-white focus:text-inoha-black transition-all shadow-2xl backdrop-blur-md"
                    >
                    <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-500 group-hover:text-inoha-green transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-gray-50 py-20 relative min-h-[400px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="themes-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($themes as $theme)
                <div class="theme-card group" data-name="{{ strtolower($theme->name) }}" data-desc="{{ strtolower($theme->description) }}">
                    <a href="{{ route('themes.show', $theme) }}" class="block h-full bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">
                        <!-- Decorative element on hover -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-inoha-green/5 rounded-bl-[100px] -mr-10 -mt-10 group-hover:bg-inoha-green/10 transition-colors"></div>
                        
                        <div class="flex items-center justify-between mb-8">
                            <div class="relative">
                                <div class="w-16 h-16 bg-inoha-green/20 rounded-2xl flex items-center justify-center text-inoha-green group-hover:scale-110 group-hover:bg-inoha-green group-hover:text-white transition-all duration-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <!-- Badge inside icon area -->
                                <div class="absolute -top-2 -right-2 bg-inoha-black text-white text-[10px] font-bold px-2 py-1 rounded-lg border border-white/10">
                                    {{ $theme->articles_count }}
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Articles</span>
                                <span class="text-2xl font-black text-inoha-black group-hover:text-inoha-green transition-colors leading-none tracking-tight">
                                    {{ str_pad($theme->articles_count, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold text-inoha-black mb-4 group-hover:text-inoha-green transition-colors duration-300 tracking-tight">
                                {{ $theme->name }}
                            </h3>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3 text-pretty group-hover:text-gray-600 transition-colors">
                                {{ $theme->description ?: 'Explorez les dernières publications et recherches liées à cette thématique.' }}
                            </p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                            <span class="text-xs font-bold text-inoha-green uppercase tracking-widest">Explorer</span>
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-inoha-black group-hover:bg-inoha-green group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-3xl shadow-sm border border-gray-100 mb-8">
                        <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-inoha-black mb-3">Aucune thématique disponible</h3>
                    <p class="text-gray-500">Nous enrichissons régulièrement notre base de données. Revenez bientôt !</p>
                </div>
                @endforelse
            </div>

            <!-- Empty State for Search -->
            <div id="search-empty" class="hidden text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-3xl shadow-sm border border-gray-100 mb-8">
                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-inoha-black mb-3">Aucun résultat trouvé</h3>
                <p class="text-gray-500">Essayez avec d'autres mots-clés ou parcourez la liste complète.</p>
                <button onclick="document.getElementById('theme-search').value = ''; document.getElementById('theme-search').dispatchEvent(new Event('input'));" class="mt-6 text-inoha-green font-bold hover:underline">
                    Effacer la recherche
                </button>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Vous ne trouvez pas votre domaine ?</h2>
            <p class="text-gray-500 mb-10 text-lg">
                Notre collection s'agrandit chaque jour. Vous pouvez consulter la liste complète des articles pour une recherche plus globale.
            </p>
            <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-inoha-black text-white rounded-2xl font-bold hover:bg-inoha-green transition-all shadow-xl hover:shadow-inoha-green/20 transform hover:-translate-y-1">
                Voir tous les articles
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('theme-search');
            const themeCards = document.querySelectorAll('.theme-card');
            const emptyState = document.getElementById('search-empty');
            const grid = document.getElementById('themes-grid');

            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase().trim();
                let hasResults = false;

                themeCards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    const desc = card.getAttribute('data-desc');
                    
                    if (name.includes(term) || desc.includes(term)) {
                        card.style.display = 'block';
                        hasResults = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (hasResults) {
                    grid.classList.remove('hidden');
                    emptyState.classList.add('hidden');
                } else {
                    grid.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                }
            });
        });
    </script>
    @endpush
@endsection
