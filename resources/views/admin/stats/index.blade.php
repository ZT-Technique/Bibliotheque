@extends('layouts.admin')

@section('page-title', 'Statistiques Détaillées')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-inoha-black">Analyse d'activité</h1>
    <p class="text-sm text-gray-500 mt-1">Suivez les performances de votre bibliothèque en temps réel</p>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Visits -->
    <div class="bg-white rounded-3xl p-6 border border-gray-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold mb-1">{{ number_format($totalVisits) }}</h3>
        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Visites Totales</p>
    </div>

    <!-- Total Articles -->
    <div class="bg-white rounded-3xl p-6 border border-gray-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-inoha-green/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold mb-1">{{ \App\Models\Article::count() }}</h3>
        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Articles Publiés</p>
    </div>

    <!-- Total Downloads -->
    <div class="bg-white rounded-3xl p-6 border border-gray-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-extrabold mb-1">{{ number_format(\App\Models\Article::sum('downloads_count')) }}</h3>
        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Téléchargements</p>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
    <!-- Top Articles -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <h2 class="font-bold text-inoha-black flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                </svg>
                Articles les plus téléchargés
            </h2>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Top 5</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white">
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Article</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Downloads</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($topArticles as $article)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-10 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
                                        @if($article->cover_image)
                                            <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-inoha-black truncate max-w-[200px]">{{ $article->title }}</p>
                                        <p class="text-[10px] text-gray-500 uppercase font-medium">{{ $article->theme->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg text-xs font-bold">
                                    {{ number_format($article->downloads_count) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-400 italic text-sm">Aucun téléchargement enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Pages -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <h2 class="font-bold text-inoha-black flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Pages les plus visitées
            </h2>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Top 5</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white">
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Page / Chemin</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Vues</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($topPages as $page)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.102-1.101" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 truncate max-w-[250px]">{{ $page->path }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold">
                                    {{ number_format($page->total) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-400 italic text-sm">Aucune visite enregistrée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
