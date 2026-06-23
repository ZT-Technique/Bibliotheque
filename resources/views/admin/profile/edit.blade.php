@extends('layouts.admin')

@section('page-title', 'Mon Profil')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-inoha-black">Mon Profil</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez vos informations personnelles et votre sécurité</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informations personnelles
                </h2>
            </div>
            <div class="p-8 space-y-8">
                <!-- Profile Photo Upload -->
                <div class="flex flex-col md:flex-row items-center gap-8 pb-4">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden bg-gray-100 border-4 border-white shadow-lg transition-transform group-hover:scale-[1.02]">
                            @if($user->profile_photo)
                                <img id="avatar-preview" src="{{ route('uploads.serve', ['type' => 'profiles', 'filename' => $user->profile_photo]) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div id="avatar-placeholder" class="w-full h-full flex items-center justify-center bg-inoha-green text-white text-4xl font-bold">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <img id="avatar-preview" src="#" alt="Aperçu" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <label for="profile_photo" class="absolute -bottom-2 -right-2 w-10 h-10 bg-white shadow-xl border border-gray-100 rounded-xl flex items-center justify-center cursor-pointer text-gray-500 hover:text-inoha-green transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h4 class="font-bold text-inoha-black mb-1 text-lg">Photo de profil</h4>
                        <p class="text-gray-500 text-sm mb-0">JPEG, PNG ou GIF. Max 2Mo.</p>
                        @error('profile_photo') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom complet <span class="text-rose-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" placeholder="Votre nom"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('name') border-rose-500 ring-rose-500/10 @enderror">
                        @error('name') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Adresse Email <span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" placeholder="votre.email@exemple.com"
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-inoha-green focus:ring-4 focus:ring-inoha-green/10 outline-none transition-all placeholder:text-gray-400 @error('email') border-rose-500 ring-rose-500/10 @enderror">
                        @error('email') <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="font-bold text-inoha-black flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Sécurité (Optionnel)
                </h2>
            </div>
            <div class="p-8 space-y-6">
                <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl mb-4">
                    <div class="flex gap-3 text-amber-800">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm">Laissez les champs de mot de passe vides si vous ne souhaitez pas modifier votre mot de passe actuel.</p>
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
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
            <button type="submit" id="submit-button" class="flex-1 flex items-center justify-center gap-3 px-8 py-5 bg-inoha-green text-white rounded-2xl font-bold hover:bg-inoha-green-dark transition-all shadow-xl shadow-inoha-green/30 text-lg">
                <svg id="button-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
                <span id="button-text">Enregistrer les modifications</span>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex-1 flex items-center justify-center px-8 py-5 bg-gray-100 text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition-all text-lg">
                Retour au tableau de bord
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
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

    // Animation au clic sur le bouton d'enregistrement
    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('submit-button');
        const text = document.getElementById('button-text');
        const icon = document.getElementById('button-icon');
        
        btn.classList.add('opacity-80', 'cursor-not-allowed');
        text.innerText = 'Enregistrement...';
        icon.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    });
</script>
@endsection
