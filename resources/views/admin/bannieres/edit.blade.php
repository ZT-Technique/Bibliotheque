@extends('layouts.admin')

@section('page-title', 'Modifier la Bannière')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Modifier la Bannière</h1>
            <p class="text-sm text-gray-500 mt-1">Mettez à jour les informations de votre bannière publicitaire</p>
        </div>
        <a href="{{ route('admin.bannieres.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.bannieres.update', $banniere) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Titre <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $banniere->title) }}" maxlength="255"
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all @error('title') border-rose-500 @enderror">
                    @error('title')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Link -->
                <div>
                    <label for="link" class="block text-sm font-bold text-gray-700 mb-2">Lien URL <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <input type="url" id="link" name="link" value="{{ old('link', $banniere->link) }}"
                           placeholder="https://example.com"
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all @error('link') border-rose-500 @enderror">
                    @error('link')<p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>@enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-bold text-gray-700 mb-2">Position <span class="text-rose-500">*</span></label>
                    <select id="position" name="position" required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all">
                        <option value="home_a" {{ old('position', $banniere->position) == 'home_a' ? 'selected' : '' }}>Accueil — Zone A (après Hero)</option>
                        <option value="home_b" {{ old('position', $banniere->position) == 'home_b' ? 'selected' : '' }}>Accueil — Zone B (après articles)</option>
                        <option value="article" {{ old('position', $banniere->position) == 'article' ? 'selected' : '' }}>Page Article (sidebar)</option>
                    </select>
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">Ordre <span class="text-rose-500">*</span></label>
                    <input type="number" id="order" name="order" value="{{ old('order', $banniere->order) }}" required
                           class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all">
                </div>

                <!-- Image Upload -->
                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Image <span class="text-gray-400 font-normal">(Laisser vide pour conserver l'image actuelle)</span></label>
                    <div class="relative group">
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:border-inoha-green hover:bg-inoha-green/5 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 text-gray-400 group-hover:text-inoha-green mb-3 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-bold">Cliquer pour changer d'image</span></p>
                            </div>
                            <img id="preview" src="{{ route('uploads.serve', ['type' => 'bannieres', 'filename' => basename($banniere->image_path)]) }}"
                                 class="absolute inset-0 w-full h-full object-contain rounded-2xl bg-white p-2 border border-gray-100">
                        </label>
                    </div>
                </div>

                <!-- Is Active -->
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_active" class="sr-only peer" {{ $banniere->is_active ? 'checked' : '' }} value="1">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-inoha-green/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-inoha-green"></div>
                        </div>
                        <span class="text-sm font-bold text-gray-700">Bannière activée</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-50">
                <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-8 py-4 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Mettre à jour
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
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById('preview').src = e.target.result; };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
