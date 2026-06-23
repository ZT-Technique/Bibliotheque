@extends('layouts.admin')

@section('page-title', 'Nouvelle Bannière')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Ajouter une Bannière</h1>
            <p class="text-sm text-gray-500 mt-1">Créez une nouvelle bannière publicitaire pour le site</p>
        </div>
        <a href="{{ route('admin.bannieres.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.bannieres.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Titre <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="255"
                           placeholder="Ex: Journée mondiale du livre 2025"
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('title') border-rose-500 @enderror">
                    @error('title')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Link -->
                <div>
                    <label for="link" class="block text-sm font-bold text-gray-700 mb-2">Lien URL <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <input type="url" id="link" name="link" value="{{ old('link') }}"
                           placeholder="https://example.com"
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('link') border-rose-500 @enderror">
                    @error('link')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-bold text-gray-700 mb-2">Position <span class="text-rose-500">*</span></label>
                    <select id="position" name="position" required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all @error('position') border-rose-500 @enderror">
                        <option value="home_a" {{ old('position') == 'home_a' ? 'selected' : '' }}>Accueil — Zone A (après Hero)</option>
                        <option value="home_b" {{ old('position') == 'home_b' ? 'selected' : '' }}>Accueil — Zone B (after articles)</option>
                        <option value="article" {{ old('position') == 'article' ? 'selected' : '' }}>Page Article (sidebar)</option>
                    </select>
                    @error('position')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">Ordre <span class="text-rose-500">*</span></label>
                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all @error('order') border-rose-500 @enderror">
                    @error('order')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Image Upload -->
                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Image <span class="text-rose-500">*</span></label>
                    <div class="relative group">
                        <input type="file" id="image" name="image" accept="image/*" required class="hidden">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:border-inoha-green hover:bg-inoha-green/5 transition-all @error('image') border-rose-500 bg-rose-50 @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 text-gray-400 group-hover:text-inoha-green mb-3 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Cliquez pour téléverser</span> ou glissez-déposez</p>
                                <p class="text-xs text-gray-400">PNG, JPG, WEBP, AVIF (Max. 4 Mo) — Format recommandé : 1200×200px</p>
                            </div>
                            <img id="preview" class="hidden absolute inset-0 w-full h-full object-contain rounded-2xl bg-white p-2">
                        </label>
                    </div>
                    @error('image')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Is Active -->
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_active" class="sr-only peer" checked value="1">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-inoha-green/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-inoha-green"></div>
                        </div>
                        <span class="text-sm font-bold text-gray-700">Activer immédiatement cette bannière</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-50">
                <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-8 py-4 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer la bannière
                </button>
                <a href="{{ route('admin.bannieres.index') }}" class="flex-1 flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview');
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
