@extends('layouts.admin')

@section('page-title', 'Modifier la Catégorie')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Modifier la Catégorie</h1>
            <p class="text-sm text-gray-500 mt-1">Mettez à jour les informations de {{ $theme->name }}</p>
        </div>
        <a href="{{ route('admin.themes.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.themes.update', $theme) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom de la catégorie <span class="text-rose-500">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $theme->name) }}" 
                       required 
                       maxlength="255"
                       class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('name') border-rose-500 ring-rose-500/10 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          maxlength="2000"
                          class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 resize-none @error('description') border-rose-500 ring-rose-500/10 @enderror">{{ old('description', $theme->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm text-blue-700">
                    <p class="font-bold">Information</p>
                    <p class="mt-0.5">Cette catégorie est actuellement associée à <strong>{{ $theme->articles()->count() }}</strong> article(s).</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-50">
                <button type="submit" id="submit-button" class="flex-1 flex items-center justify-center gap-2 px-8 py-4 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20 disabled:opacity-70 disabled:cursor-not-allowed">
                    <svg id="button-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <svg id="loader-icon" class="hidden animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="button-text">Enregistrer les modifications</span>
                </button>
                <a href="{{ route('admin.themes.index') }}" class="flex-1 flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-all">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    document.getElementById('submit-button').closest('form').addEventListener('submit', function(e) {
        const button = document.getElementById('submit-button');
        const icon = document.getElementById('button-icon');
        const loader = document.getElementById('loader-icon');
        const text = document.getElementById('button-text');

        button.disabled = true;
        icon.classList.add('hidden');
        loader.classList.remove('hidden');
        text.innerText = 'Enregistrement...';
    });
</script>
@endpush
@endsection
