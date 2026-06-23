@extends('layouts.public')

@section('title', 'Contact')
@section('meta_og_title', 'Contact | Bibliothèque Électronique INOHA')

@section('meta_description', 'Une question ou une recommandation ? Contactez l\'équipe d\'INOHA via notre formulaire en ligne. Nous vous répondrons dans les plus brefs délais.')
@section('meta_keywords', 'contact, support, inoha, aide, formulaire de contact, questions')

@section('content')
    <!-- Hero Section with Pattern -->
    <section class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-20 lg:py-32 overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute w-full h-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-contact" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-contact)" />
            </svg>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-inoha-green/30 rounded-full blur-[160px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 bg-white/10 text-inoha-green-light px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border border-white/10">
                Contact & Support
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-8 leading-tight tracking-tight">
                Besoin d'<span class="text-inoha-green-light">Assistance ?</span>
            </h1>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg lg:text-xl leading-relaxed">
                Notre équipe est à votre écoute pour toute question relative à nos publications ou pour vous accompagner dans vos démarches académiques.
            </p>
        </div>
    </section>

    <div class="bg-gray-50 py-20 min-h-screen relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-32">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Contact info hub -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-inoha-green/5 rounded-bl-[100px] -mr-16 -mt-16 group-hover:bg-inoha-green/10 transition-all"></div>
                        
                        <h2 class="text-2xl font-black text-inoha-black mb-10 tracking-tight">Informations <span class="text-inoha-green">Clés</span></h2>
                        
                        <div class="space-y-10">
                            <!-- Email -->
                            <div class="flex items-start gap-5">
                                <div class="w-14 h-14 bg-inoha-green/10 rounded-2xl flex items-center justify-center text-inoha-green flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="pt-1">
                                    <h3 class="font-black text-inoha-black text-sm uppercase tracking-widest mb-1">E-mail</h3>
                                    <a href="mailto:secretariat@unikin.inoha.ac.cd" class="text-gray-500 hover:text-inoha-green font-medium transition-colors break-all">secretariat@unikin.inoha.ac.cd</a>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start gap-5">
                                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="pt-1">
                                    <h3 class="font-black text-inoha-black text-sm uppercase tracking-widest mb-1">Téléphone</h3>
                                    <a href="tel:+243896846702" class="block text-gray-500 hover:text-inoha-green font-medium transition-colors">+243 896 846 702</a>
                                    <a href="tel:+243999796182" class="block text-gray-500 hover:text-inoha-green font-medium transition-colors mt-1">+243 999 796 182</a>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start gap-5">
                                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="pt-1">
                                    <h3 class="font-black text-inoha-black text-sm uppercase tracking-widest mb-1">Bureau</h3>
                                    <p class="text-gray-500 font-medium">UNIKIN — Faculté de Médecine<br>Lemba / Kinshasa, RD Congo</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-14 p-8 bg-inoha-black rounded-3xl text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-white/5 rounded-full blur-xl -mr-10 -mt-10"></div>
                            <h4 class="font-bold text-lg mb-4">Horaires d'Accueil</h4>
                            <div class="space-y-3 text-sm font-medium">
                                <div class="flex justify-between items-center text-gray-400">
                                    <span>Lundi - Vendredi</span>
                                    <span class="text-white">08:00 - 17:00</span>
                                </div>
                                <div class="flex justify-between items-center text-gray-400">
                                    <span>Samedi</span>
                                    <span class="text-white">09:00 - 13:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact form container -->
                <div class="lg:col-span-8">
                    <div class="bg-white p-10 lg:p-16 rounded-[3rem] border border-gray-100 shadow-2xl relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-32 h-32 bg-inoha-green/5 rounded-br-[100px] -ml-16 -mt-16 group-hover:bg-inoha-green/10 transition-all"></div>
                        
                        <div class="relative z-10">
                            <h2 class="text-3xl lg:text-4xl font-black text-inoha-black mb-4 tracking-tight">Envoyez-nous un <span class="text-inoha-green">Message</span></h2>
                            <p class="text-gray-500 text-lg mb-12">Nous vous répondrons dans un délai de 24 à 48 heures ouvrées.</p>

                            @if(session('success'))
                                <div class="mb-10 p-6 bg-inoha-green/10 border border-inoha-green/20 text-inoha-green-dark rounded-[2rem] flex items-center gap-4 animate-bounce-subtle shadow-lg">
                                    <div class="w-12 h-12 bg-inoha-green text-white rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="font-bold text-lg">{{ session('success') }}</span>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-3">
                                        <label class="block text-xs font-black text-inoha-black uppercase tracking-widest ml-1">Nom complet</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ex: Jean Dupont" class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-inoha-green/10 focus:border-inoha-green focus:bg-white outline-none transition-all @error('name') border-rose-500 @enderror font-medium">
                                        @error('name') <p class="mt-1 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-xs font-black text-inoha-black uppercase tracking-widest ml-1">Adresse Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="jean.dupont@exemple.com" class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-inoha-green/10 focus:border-inoha-green focus:bg-white outline-none transition-all @error('email') border-rose-500 @enderror font-medium">
                                        @error('email') <p class="mt-1 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    <label class="block text-xs font-black text-inoha-black uppercase tracking-widest ml-1">Sujet du message</label>
                                    <div class="relative">
                                        <select name="subject" required class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-inoha-green/10 focus:border-inoha-green focus:bg-white outline-none transition-all appearance-none font-medium cursor-pointer">
                                            <option value="Question sur une publication" {{ old('subject') == 'Question sur une publication' ? 'selected' : '' }}>Question sur une publication</option>
                                            <option value="Problème de téléchargement" {{ old('subject') == 'Problème de téléchargement' ? 'selected' : '' }}>Problème de téléchargement</option>
                                            <option value="Demande d'accès aux ressources" {{ old('subject') == "Demande d'accès aux ressources" ? 'selected' : '' }}>Demande d'accès aux ressources</option>
                                            <option value="Suggestion de thématique" {{ old('subject') == 'Suggestion de thématique' ? 'selected' : '' }}>Suggestion de thématique</option>
                                            <option value="Demande de partenariat" {{ old('subject') == 'Demande de partenariat' ? 'selected' : '' }}>Demande de partenariat</option>
                                            <option value="Autre" {{ old('subject') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                    @error('subject') <p class="mt-1 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-xs font-black text-inoha-black uppercase tracking-widest ml-1">Message</label>
                                    <textarea name="message" rows="6" required placeholder="Comment pouvons-nous vous aider ?" class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-inoha-green/10 focus:border-inoha-green focus:bg-white outline-none transition-all resize-none @error('message') border-rose-500 @enderror font-medium">{{ old('message') }}</textarea>
                                    @error('message') <p class="mt-1 text-xs text-rose-500 font-bold ml-1">{{ $message }}</p> @enderror
                                </div>

                                <button type="submit" class="w-full lg:w-auto px-12 py-5 bg-inoha-black text-white rounded-2xl font-black hover:bg-inoha-green transition-all shadow-2xl hover:shadow-inoha-green/20 transform hover:-translate-y-1 mt-4">
                                    Envoyer le Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Redesigned Mini FAQ for consistency -->
            <div class="mt-32 border-t border-gray-100 pt-32">
                <div class="text-center mb-16">
                    <span class="text-xs font-black text-inoha-green uppercase tracking-widest block mb-4">Réponses Rapides</span>
                    <h2 class="text-4xl font-black text-inoha-black mb-6 tracking-tight tracking-tight">Questions <span class="text-inoha-green">Fréquentes</span></h2>
                    <p class="text-gray-500 max-w-xl mx-auto text-lg leading-relaxed">Trouvez rapidement des réponses aux interrogations les plus courantes de notre communauté.</p>
                </div>

                <div class="max-w-3xl mx-auto space-y-4">
                    @php
                        $faqs = [
                            ['q' => 'Comment télécharger un document ?', 'a' => 'Il suffit de cliquer sur le bouton "Télécharger PDF" présent sur la page de chaque article. Le téléchargement démarrera automatiquement et gratuitement.'],
                            ['q' => 'Les publications sont-elles vraiment gratuites ?', 'a' => 'Toutes les ressources d\'INOHA sont en accès libre et entièrement gratuites pour soutenir la recherche et l\'éducation.'],
                            ['q' => 'Puis-je soumettre un article ?', 'a' => 'Pour le moment, nous archivons uniquement des publications sélectionnées par notre comité éditorial. Vous pouvez toutefois nous suggérer des thématiques via le formulaire de contact.']
                        ];
                    @endphp

                    @foreach($faqs as $faq)
                    <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                        <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                            <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">{{ $faq['q'] }}</span>
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                            <p class="text-lg">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Link to main FAQ -->
                <div class="text-center mt-12">
                    <a href="{{ route('faq') }}" class="text-inoha-green font-black uppercase tracking-widest text-xs hover:underline inline-flex items-center gap-2">
                        Consulter la FAQ complète
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggles = document.querySelectorAll('.faq-toggle');
            
            toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const item = toggle.closest('.faq-item');
                    const answer = item.querySelector('.faq-answer');
                    const icon = toggle.querySelector('svg');
                    
                    // Close others
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.querySelector('.faq-answer').classList.add('hidden');
                            otherItem.querySelector('svg').classList.remove('rotate-180');
                            otherItem.classList.remove('ring-4', 'ring-inoha-green/5');
                        }
                    });

                    // Toggle current
                    const isHidden = answer.classList.contains('hidden');
                    if (isHidden) {
                        answer.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                        item.classList.add('ring-4', 'ring-inoha-green/5');
                        item.classList.add('border-inoha-green/20');
                    } else {
                        answer.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                        item.classList.remove('ring-4', 'ring-inoha-green/5');
                        item.classList.remove('border-inoha-green/20');
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
