@extends('layouts.admin')

@section('page-title', 'Gestion du Slider')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-inoha-black">Liste des diapositives</h2>
            <p class="text-sm text-gray-500">Gérez les images qui s'affichent dans la section d'accueil du site.</p>
        </div>
        <a href="{{ route('admin.sliders.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un slide
        </a>
    </div>

    <!-- Sliders List -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Ordre</th>
                        <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Image</th>
                        <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Titre</th>
                        <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500">Statut</th>
                        <th class="px-6 py-4 text-xs uppercase tracking-wider font-bold text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($sliders as $slider)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-400">#{{ $slider->order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-20 h-12 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                    <img src="{{ route('uploads.serve', ['type' => 'sliders', 'filename' => basename($slider->image_path)]) }}" 
                                         alt="{{ $slider->title }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-inoha-black">{{ $slider->title ?? 'Sans titre' }}</div>
                                @if($slider->link)
                                    <div class="text-xs text-gray-400 truncate max-w-[200px]">{{ $slider->link }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.sliders.toggle', $slider) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-all {{ $slider->is_active ? 'bg-green-50 text-green-600 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $slider->is_active ? 'bg-green-600' : 'bg-gray-500' }}"></span>
                                        {{ $slider->is_active ? 'Activé' : 'Désactivé' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="p-2 text-gray-400 hover:text-inoha-green hover:bg-inoha-green/5 rounded-lg transition-all" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline" onsubmit="event.preventDefault(); window.confirmDelete(this);">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-lg">Aucun slide trouvé</p>
                                    <p class="text-sm">Commencez par ajouter votre première diapositive.</p>
                                    <a href="{{ route('admin.sliders.create') }}" class="mt-2 text-inoha-green font-bold hover:underline">
                                        Ajouter un slide maintenant
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
