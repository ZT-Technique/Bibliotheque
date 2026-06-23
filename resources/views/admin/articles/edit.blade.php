@extends('layouts.admin')

@section('page-title', 'Modifier l\'Article')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Modifier l'Article</h1>
            <p class="text-sm text-gray-500 mt-1">Édition de : {{ Str::limit($article->title, 60) }}</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour au catalogue
        </a>
    </div>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Metadata Section -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informations générales
                </h2>
            </div>
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-8">
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Titre de l'article <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required maxlength="500"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('title') border-rose-500 ring-rose-500/10 @enderror">
                        @error('title') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-4">
                        <label for="year" class="block text-sm font-bold text-gray-700 mb-2">Année de publication</label>
                        <input type="number" id="year" name="year" value="{{ old('year', $article->year) }}" min="1900" max="{{ date('Y') + 1 }}"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('year') border-rose-500 ring-rose-500/10 @enderror">
                        @error('year') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-8">
                        <label for="authors" class="block text-sm font-bold text-gray-700 mb-2">Auteur(s) <span class="text-rose-500">*</span></label>
                        <input type="text" id="authors" name="authors" value="{{ old('authors', $article->authors) }}" required maxlength="500"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('authors') border-rose-500 ring-rose-500/10 @enderror">
                        @error('authors') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-4">
                        <label for="theme_id" class="block text-sm font-bold text-gray-700 mb-2">Catégorie <span class="text-rose-500">*</span></label>
                        <select id="theme_id" name="theme_id" required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat @error('theme_id') border-rose-500 ring-rose-500/10 @enderror">
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}" {{ old('theme_id', $article->theme_id) == $theme->id ? 'selected' : '' }}>
                                    {{ $theme->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('theme_id') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="abstract" class="block text-sm font-bold text-gray-700 mb-2">Résumé de la publication</label>
                    <textarea id="abstract" name="abstract" rows="6" maxlength="2000"
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 resize-none @error('abstract') border-rose-500 ring-rose-500/10 @enderror">{{ old('abstract', $article->abstract) }}</textarea>
                    @error('abstract') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="keywords" class="block text-sm font-bold text-gray-700 mb-2">Mots-clés</label>
                    <input type="text" id="keywords" name="keywords" value="{{ old('keywords', $article->keywords) }}" maxlength="500"
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('keywords') border-rose-500 ring-rose-500/10 @enderror">
                    @error('keywords') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', $article->is_visible) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-inoha-green/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-inoha-green font-bold"></div>
                        <span class="ms-4 text-sm font-bold text-gray-700 group-hover:text-inoha-black transition-colors">Rendre cet article visible sur le site public</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Current Files & Uploads -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Fichiers et visuels
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Cover Image -->
                    <div class="space-y-6">
                        <label class="block text-sm font-bold text-gray-700">Image de couverture</label>
                        
                        <!-- Current Preview -->
                        <div class="relative w-40 h-56 mx-auto rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                            <img id="current-cover" src="{{ route('uploads.serve', ['type' => 'covers', 'filename' => basename($article->cover_image)]) }}" alt="Current Cover" class="w-full h-full object-cover">
                        </div>

                        <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-inoha-green/50 hover:bg-inoha-green/5">
                            <input type="file" id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/jpg" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImage(this)">
                            <div class="text-center">
                                <svg class="w-6 h-6 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium">Changer la couverture</span>
                            </div>
                        </div>
                        @error('cover_image') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        <p class="text-[10px] text-gray-400 text-center italic">Laissez vide pour conserver l'image actuelle.</p>
                    </div>

                    <!-- PDF File -->
                    <div class="space-y-6">
                        <label class="block text-sm font-bold text-gray-700">Fichier PDF</label>
                        
                        <!-- Current PDF Link -->
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="text-xs">
                                    <p class="font-bold text-inoha-black">Fichier actuel</p>
                                    <p class="text-gray-500 truncate max-w-[150px]">{{ basename($article->pdf_path) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('uploads.serve', ['type' => 'pdfs', 'filename' => basename($article->pdf_path)]) }}" target="_blank" class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-xs font-bold text-inoha-black shadow-sm hover:bg-gray-50 transition-colors">
                                Consulter
                            </a>
                        </div>

                        <div class="relative h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-blue-300 hover:bg-blue-50">
                            <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="updateFileName(this)">
                            <div class="text-center" id="pdf-display">
                                <svg class="w-6 h-6 text-blue-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium" id="pdf-name">Remplacer le PDF</span>
                            </div>
                        </div>
                        @error('pdf_file') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        <p class="text-[10px] text-gray-400 text-center italic">Laissez vide pour conserver le document actuel.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4 pb-12">
            <button type="submit" id="submit-button" class="flex-1 flex items-center justify-center gap-3 px-8 py-5 bg-inoha-green text-white rounded-2xl font-bold hover:bg-inoha-green-dark transition-all shadow-xl shadow-inoha-green/30 text-lg disabled:opacity-70 disabled:cursor-not-allowed">
                <svg id="button-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
                <svg id="loader-icon" class="hidden animate-spin w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="button-text">Enregistrer les modifications</span>
            </button>
            <a href="{{ route('admin.articles.index') }}" class="flex-1 flex items-center justify-center px-8 py-5 bg-gray-100 text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition-all text-lg">
                Annuler
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#current-cover').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateFileName(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            document.querySelector('#pdf-name').innerText = fileName;
            document.querySelector('#pdf-name').classList.add('text-inoha-green', 'font-bold');
        }
    }

    document.getElementById('submit-button').closest('form').addEventListener('submit', function(e) {
        const button = document.getElementById('submit-button');
        const icon = document.getElementById('button-icon');
        const loader = document.getElementById('loader-icon');
        const text = document.getElementById('button-text');

        button.disabled = true;
        icon.classList.add('hidden');
        loader.classList.remove('hidden');
        text.innerText = 'Enregistrement en cours...';
    });

</script>
@endpush
@endsection
