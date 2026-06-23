@extends('layouts.admin')

@section('page-title', 'Gestion des Articles')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-inoha-black">Bibliothèque</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez le catalogue des publications scientifiques</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvel article
    </a>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-2xl border border-gray-200 p-6 mb-8 shadow-sm">
    <form action="{{ route('admin.articles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <div class="md:col-span-5">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Recherche</label>
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Titre, auteurs, mots-clés..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all text-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        <div class="md:col-span-4">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Catégorie</label>
            <select name="theme_id" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-inoha-green outline-none transition-all text-sm appearance-none cursor-pointer">
                <option value="">Toutes les catégories</option>
                @foreach($themes as $theme)
                    <option value="{{ $theme->id }}" {{ request('theme_id') == $theme->id ? 'selected' : '' }}>
                        {{ $theme->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-3 flex items-end">
            <button type="submit" class="w-full py-2.5 bg-inoha-black text-white rounded-xl font-bold hover:bg-gray-800 transition-all text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filtrer les résultats
            </button>
        </div>
    </form>
</div>

<!-- Articles Table -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
        <h2 class="font-bold text-lg text-inoha-black">Liste des articles</h2>
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $articles->total() }} publications</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Livre</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Détails de l'article</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Catégorie</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Downloads</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="w-12 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 group-hover:border-inoha-green/30 transition-all shadow-sm">
                                @if($article->cover_image)
                                    <img src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-2">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-inoha-black group-hover:text-inoha-green transition-colors line-clamp-1">{{ $article->title }}</span>
                                <span class="text-xs text-gray-500 mt-0.5 line-clamp-1 italic">{{ $article->authors }} ({{ $article->year }})</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 uppercase tracking-wider border border-blue-100">
                                {{ $article->theme->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($article->is_visible)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-600 border border-green-100">
                                    EN LIGNE
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-400 border border-gray-200">
                                    MASQUÉ
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 py-1 px-2.5 bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold text-gray-600">
                                <svg class="w-3.5 h-3.5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                {{ number_format($article->downloads_count) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs text-gray-500 font-medium">{{ $article->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.articles.duplicate', $article) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Dupliquer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.articles.toggle-visibility', $article) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="p-2 {{ $article->is_visible ? 'text-green-500 hover:bg-green-50' : 'text-gray-400 hover:bg-gray-100' }} rounded-lg transition-all" title="{{ $article->is_visible ? 'Masquer' : 'Afficher' }}">
                                        @if($article->is_visible)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="event.preventDefault(); confirmDelete(this);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-inoha-black mb-1">Aucun article trouvé</h3>
                                <p class="text-xs text-gray-500 mb-4">Ajustez vos filtres ou créez une nouvelle publication.</p>
                                <a href="{{ route('admin.articles.create') }}" class="text-sm font-bold text-inoha-green hover:underline">Ajouter mon premier article</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 bg-gray-50/50 border-t border-gray-100">
        {{ $articles->links() }}
    </div>
</div>
@endsection
