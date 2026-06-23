@extends('layouts.admin')

@section('page-title', 'Modifier l\'Administrateur')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Modifier l'Administrateur</h1>
            <p class="text-sm text-gray-500 mt-1">Édition du compte : {{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à la liste
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informations du compte
                </h2>
            </div>
            <div class="p-8 space-y-8">
                <!-- Profile Photo Upload -->
                <div class="flex flex-col md:flex-row items-center gap-8 pb-4">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-100 border-4 border-white shadow-md transition-transform group-hover:scale-[1.02]">
                            @if($user->profile_photo)
                                <img id="avatar-preview" src="{{ route('uploads.serve', ['type' => 'profiles', 'filename' => $user->profile_photo]) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div id="avatar-placeholder" class="w-full h-full flex items-center justify-center bg-inoha-green text-white text-2xl font-bold">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <img id="avatar-preview" src="#" alt="Aperçu" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <label for="profile_photo" class="absolute -bottom-2 -right-2 w-8 h-8 bg-white shadow-lg border border-gray-100 rounded-lg flex items-center justify-center cursor-pointer text-gray-500 hover:text-inoha-green transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            </svg>
                        </label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h4 class="font-bold text-inoha-black mb-1">Photo de profil</h4>
                        <p class="text-gray-500 text-sm">Cliquez sur l'appareil photo pour modifier.</p>
                        @error('profile_photo') <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-6 pt-4 border-t border-gray-100">
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom complet <span class="text-rose-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" placeholder="Nom de l'utilisateur"
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('name') border-rose-500 ring-rose-500/10 @enderror">
                    @error('name') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Adresse Email <span class="text-rose-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" placeholder="email@exemple.com"
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('email') border-rose-500 ring-rose-500/10 @enderror">
                    @error('email') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl">
                    <div class="flex gap-3 text-amber-800">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs">Laissez les champs de mot de passe vides si vous ne souhaitez pas les modifier.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" minlength="8" placeholder="••••••••"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('password') border-rose-500 ring-rose-500/10 @enderror">
                        @error('password') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" placeholder="••••••••"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400">
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <label class="relative inline-flex items-center cursor-pointer group {{ $user->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} {{ $user->id === auth()->id() ? 'disabled' : '' }} class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-inoha-green/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-inoha-green font-bold"></div>
                        <span class="ms-4 text-sm font-bold text-gray-700 group-hover:text-inoha-black transition-colors">Administrateur</span>
                    </label>
                    @if($user->id === auth()->id())
                        <p class="mt-2 text-[10px] text-amber-600 italic font-medium">Vous ne pouvez pas retirer vos propres droits d'administrateur.</p>
                    @endif
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
                <span id="button-text">Enregistrer les modifications</span>
            </button>
            <a href="{{ route('admin.users.index') }}" class="flex-1 flex items-center justify-center px-8 py-5 bg-gray-100 text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition-all text-lg">
                Annuler
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            
            reader.readAsDataURL(input.files[0]);
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
        text.innerText = 'Mise à jour en cours...';
    });
</script>
@endpush
@endsection
