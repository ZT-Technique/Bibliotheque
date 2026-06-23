@extends('layouts.admin')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="mb-8 rounded-3xl bg-gradient-to-r from-inoha-black via-[#0f2415] to-[#184d2f] p-6 sm:p-8 text-white shadow-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-white/70 font-semibold">Centre de pilotage INOHA</p>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold">Vision globale de la bibliothèque</h1>
            <p class="mt-2 text-sm text-white/80 max-w-2xl">Suivez les publications et l'activité des membres avec des indicateurs exploitables en temps réel.</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center justify-center rounded-xl bg-inoha-green px-5 py-3 text-sm font-bold text-white hover:bg-green-700 transition-colors">
            Publier un article
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-gray-400">Publications</p>
        <p class="mt-3 text-3xl font-bold text-inoha-black">{{ number_format($totalArticles) }}</p>
        <p class="mt-2 text-xs text-gray-500">+{{ number_format($articlesThisWeek) }} cette semaine</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-gray-400">Téléchargements</p>
        <p class="mt-3 text-3xl font-bold text-inoha-black">{{ number_format($totalDownloads) }}</p>
        <p class="mt-2 text-xs text-gray-500">{{ number_format($totalUserDownloads) }} actions utilisateurs</p>
    </div>
    <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-blue-700">Utilisateurs</p>
        <p class="mt-3 text-3xl font-bold text-blue-900">{{ number_format($totalUsers) }}</p>
        <p class="mt-2 text-xs text-blue-700">{{ number_format($totalAdmins) }} admins actifs</p>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <section class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h2 class="font-bold text-inoha-black">Dernières publications</h2>
                <p class="text-xs text-gray-500 mt-1">Surveillez la qualité éditoriale et la cadence de publication.</p>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="text-sm font-semibold text-inoha-green hover:underline">Voir tout</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentArticles as $article)
                <article class="px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-16 rounded-lg overflow-hidden border border-gray-200 bg-gray-100 flex-shrink-0">
                            @if($article->cover_image)
                                <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" alt="cover" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-inoha-black truncate">{{ $article->title }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ Str::limit($article->authors, 80) }}</p>
                            <div class="mt-2 flex items-center gap-2 text-xs">
                                <span class="rounded-full bg-inoha-green/10 text-inoha-green px-2 py-1 font-semibold">{{ $article->theme->name }}</span>
                                <span class="text-gray-400">{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-100">Éditer</a>
                    </div>
                </article>
            @empty
                <div class="px-6 py-10 text-center text-sm text-gray-500">Aucune publication récente.</div>
            @endforelse
        </div>
    </section>

    <section class="space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="font-bold text-inoha-black">Répartition par catégorie</h2>
            <p class="mt-1 text-xs text-gray-500">Top catégories les plus alimentées.</p>
            <div class="mt-5 space-y-4">
                @php $palette = ['bg-inoha-green', 'bg-blue-500', 'bg-amber-500', 'bg-rose-500', 'bg-purple-500']; @endphp
                @forelse($themesWithCount->take(5) as $idx => $theme)
                    @php $ratio = $totalArticles > 0 ? ($theme->articles_count / $totalArticles) * 100 : 0; @endphp
                    <div>
                        <div class="mb-1 flex items-center justify-between text-xs">
                            <span class="font-medium text-gray-700">{{ $theme->name }}</span>
                            <span class="font-semibold text-gray-500">{{ $theme->articles_count }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-gray-100">
                            <div class="h-2 rounded-full {{ $palette[$idx % count($palette)] }}" style="width: {{ $ratio }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Aucune donnée disponible.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="font-bold text-inoha-black">Résumé exécutif</h2>
            <ul class="mt-4 space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-inoha-green"></span><span>Cadence mensuelle : <strong>{{ number_format($articlesThisMonth) }}</strong> publications.</span></li>
                <li class="flex items-start gap-2"><span class="mt-1 h-2 w-2 rounded-full bg-blue-500"></span><span>Base communautaire : <strong>{{ number_format($totalUsers) }}</strong> membres.</span></li>
            </ul>
        </div>
    </section>
</div>
@endsection
