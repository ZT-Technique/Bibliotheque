@extends('layouts.admin')

@section('page-title', 'Nouveau Publication')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Ajouter un Article</h1>
            <p class="text-sm text-gray-500 mt-1">Complétez les informations pour publier une nouvelle œuvre</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour au catalogue
        </a>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

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
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="500" placeholder="Titre complet de la publication..."
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('title') border-rose-500 ring-rose-500/10 @enderror">
                        @error('title') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-4">
                        <label for="publication_date" class="block text-sm font-bold text-gray-700 mb-2">Date de publication</label>
                        <input type="date" id="publication_date" name="publication_date" value="{{ old('publication_date') }}"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all @error('publication_date') border-rose-500 ring-rose-500/10 @enderror">
                        @error('publication_date') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-8">
                        <label for="authors" class="block text-sm font-bold text-gray-700 mb-2">Auteur(s) <span class="text-rose-500">*</span></label>
                        <input type="text" id="authors" name="authors" value="{{ old('authors') }}" required maxlength="500" placeholder="Ex: Dr. John Doe, Prof. Jane Smith"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('authors') border-rose-500 ring-rose-500/10 @enderror">
                        @error('authors') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-4">
                        <label for="theme_id" class="block text-sm font-bold text-gray-700 mb-2">Catégorie <span class="text-rose-500">*</span></label>
                        <select id="theme_id" name="theme_id" required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all cursor-pointer appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat @error('theme_id') border-rose-500 ring-rose-500/10 @enderror">
                            <option value="">Choisir une catégorie</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}" {{ old('theme_id') == $theme->id ? 'selected' : '' }}>
                                    {{ $theme->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('theme_id') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="abstract" class="block text-sm font-bold text-gray-700 mb-2">Résumé de la publication</label>
                    <textarea id="abstract" name="abstract" rows="6" maxlength="2000" placeholder="Décrivez l'article en quelques lignes..."
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 resize-none @error('abstract') border-rose-500 ring-rose-500/10 @enderror">{{ old('abstract') }}</textarea>
                    @error('abstract') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    <p class="mt-2 text-xs text-gray-400 italic">Un résumé clair facilite le référencement de l'article.</p>
                </div>

                <div>
                    <label for="keywords" class="block text-sm font-bold text-gray-700 mb-2">Mots-clés</label>
                    <input type="text" id="keywords" name="keywords" value="{{ old('keywords') }}" maxlength="500" placeholder="IA, Machine Learning, Recherche..."
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('keywords') border-rose-500 ring-rose-500/10 @enderror">
                    @error('keywords') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    <p class="mt-2 text-xs text-gray-400">Séparez les mots-clés par des virgules.</p>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="is_visible" value="1" {{ old('is_visible', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-inoha-green/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-inoha-green font-bold"></div>
                        <span class="ms-4 text-sm font-bold text-gray-700 group-hover:text-inoha-black transition-colors">Rendre cet article visible sur le site public</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Author Profile Section --}}
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil de l'auteur
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Author photo --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700">Photo de l'auteur</label>
                        <div class="relative group h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-inoha-green/50 hover:bg-inoha-green/5 overflow-hidden">
                            <input type="file" id="author_image" name="author_image" accept="image/jpeg,image/png,image/jpg"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewAuthorImage(this)">
                            <div id="author-preview" class="hidden absolute inset-0 w-full h-full">
                                <img src="#" alt="Preview auteur" class="w-full h-full object-cover">
                            </div>
                            <div id="author-placeholder" class="text-center">
                                <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-xs text-gray-400 font-medium">Photo auteur</span>
                            </div>
                        </div>
                        @error('author_image') <p class="text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-400 italic text-center">Recommandé : 300×300px</p>
                    </div>

                    {{-- Level + Country --}}
                    <div class="md:col-span-2 space-y-5">
                        <div>
                            <label for="author_level" class="block text-sm font-bold text-gray-700 mb-2">Niveau d'études</label>
                            <select id="author_level" name="author_level"
                                class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2020%2020%22%3E%3Cpath%20stroke%3D%22%236B7280%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%221.5%22%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat">
                                <option value="">-- Sélectionner --</option>
                                <option value="Licence" {{ old('author_level') == 'Licence' ? 'selected' : '' }}>Licence (Bac+3)</option>
                                <option value="Master" {{ old('author_level') == 'Master' ? 'selected' : '' }}>Master (Bac+5)</option>
                                <option value="Doctorat" {{ old('author_level') == 'Doctorat' ? 'selected' : '' }}>Doctorat (PhD)</option>
                                <option value="Post-doctorat" {{ old('author_level') == 'Post-doctorat' ? 'selected' : '' }}>Post-doctorat</option>
                                <option value="Professeur" {{ old('author_level') == 'Professeur' ? 'selected' : '' }}>Professeur / Chercheur</option>
                                <option value="Autre" {{ old('author_level') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('author_level') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="author_country" class="block text-sm font-bold text-gray-700 mb-2">Pays</label>
                            <input type="text" id="author_country" name="author_country" value="{{ old('author_country') }}" maxlength="100"
                                placeholder="Ex: France, Cameroun, Canada..."
                                class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('author_country') border-rose-500 ring-rose-500/10 @enderror">
                            @error('author_country') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Files Section -->
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Cover Image -->
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700">Image de couverture <span class="text-rose-500">*</span></label>
                        <div class="relative group h-48 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-inoha-green/50 hover:bg-inoha-green/5 overflow-hidden">
                            <input type="file" id="cover_image" name="cover_image" required accept="image/jpeg,image/png,image/jpg" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImage(this)">
                            <div id="cover-preview" class="hidden absolute inset-0 w-full h-full">
                                <img src="#" alt="Preview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs font-bold uppercase tracking-widest bg-black/50 px-3 py-1 rounded-full">Modifier l'image</span>
                                </div>
                            </div>
                            <div id="cover-placeholder" class="text-center group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium">Glissez ou cliquez pour uploader</span>
                            </div>
                        </div>
                        @error('cover_image') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-400 italic text-center">Format recommandé : 800x1100px (Portrait)</p>
                    </div>

                    <!-- PDF File -->
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700">Fichier PDF <span class="text-rose-500">*</span></label>
                        <div class="relative h-48 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-blue-300 hover:bg-blue-50">
                            <input type="file" id="pdf_file" name="pdf_file" required accept="application/pdf" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="updateFileName(this)">
                            <div class="text-center" id="pdf-display">
                                <svg class="w-10 h-10 text-rose-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs text-gray-500 font-medium" id="pdf-name">Cliquez pour choisir le fichier PDF</span>
                            </div>
                        </div>
                        @error('pdf_file') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-400 italic text-center">Taille maximum autorisée : 10 Mo</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <button type="submit" id="submit-button" class="flex-1 flex items-center justify-center gap-3 px-8 py-5 bg-inoha-green text-white rounded-2xl font-bold hover:bg-inoha-green-dark transition-all shadow-xl shadow-inoha-green/30 text-lg disabled:opacity-70 disabled:cursor-not-allowed">
                <svg id="button-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
                <svg id="loader-icon" class="hidden animate-spin w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="button-text">Publier l'article maintenant</span>
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
                const preview = document.querySelector('#cover-preview');
                const placeholder = document.querySelector('#cover-placeholder');
                preview.querySelector('img').src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewAuthorImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('#author-preview');
                const placeholder = document.querySelector('#author-placeholder');
                preview.querySelector('img').src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
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
        text.innerText = 'Publication en cours...';
    });

</script>
@endpush
@endsection
