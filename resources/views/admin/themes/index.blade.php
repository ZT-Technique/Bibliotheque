@extends('layouts.admin')

@section('page-title', 'Gestion des Catégories')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-inoha-black">Catégories</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez les catégories de votre bibliothèque</p>
    </div>
    <a href="{{ route('admin.themes.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle catégorie
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
        <h2 class="font-bold text-lg text-inoha-black">Liste des catégories</h2>
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $themes->count() }} catégories au total</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">ID</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Nom</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Description</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Articles</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($themes as $theme)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium italic">#{{ $theme->id }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-inoha-black group-hover:text-inoha-green transition-colors">{{ $theme->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-500 line-clamp-1 max-w-xs">{{ $theme->description ?? 'Aucune description' }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-inoha-green/10 text-inoha-green">
                                {{ $theme->articles_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.themes.edit', $theme) }}" class="p-2 text-gray-400 hover:text-inoha-green hover:bg-inoha-green/10 rounded-lg transition-all" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.themes.destroy', $theme) }}" method="POST" class="inline-block" onsubmit="event.preventDefault(); confirmDelete(this);">
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
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-inoha-black mb-1">Aucune catégorie</h3>
                                <p class="text-xs text-gray-500 mb-4">Commencez par créer des catégories pour vos articles.</p>
                                <a href="{{ route('admin.themes.create') }}" class="text-sm font-bold text-inoha-green hover:underline">Créer la première catégorie</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
