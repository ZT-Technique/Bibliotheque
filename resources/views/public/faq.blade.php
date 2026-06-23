@extends('layouts.public')

@section('title', 'Questions fréquentes')
@section('meta_og_title', 'Questions fréquentes | Bibliothèque Électronique INOHA')

@section('meta_description', 'Retrouvez toutes les réponses à vos questions sur la bibliothèque électronique INOHA, l\'approche One Health et l\'accès à nos ressources scientifiques.')
@section('meta_keywords', 'FAQ, questions fréquentes, aide, support, inoha, one health, ressources scientifiques')

@section('content')
    <!-- Hero Section with Pattern -->
    <section class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-20 lg:py-32 overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute w-full h-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-faq" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-faq)" />
            </svg>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-inoha-green/30 rounded-full blur-[160px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 bg-white/10 text-inoha-green-light px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border border-white/10">
                Centre d'Assistance
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-8 leading-tight tracking-tight">
                Questions <span class="text-inoha-green-light">Fréquentes</span>
            </h1>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg lg:text-xl leading-relaxed">
                Apprenez-en davantage sur notre mission, l'approche One Health et la gestion de vos recherches sur INOHA.
            </p>
        </div>
    </section>

    <div class="bg-gray-50 py-20 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-16">
                <!-- Category: Général -->
                <section>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-inoha-green/10 text-inoha-green flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-inoha-black tracking-tight">L'Institut INOHA</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                                <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">C'est quoi l'INOHA ?</span>
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                                <p class="text-lg">
                                    L'INOHA (Institut One Health pour l'Afrique) est un centre d'excellence rattaché à l'Université de Kinshasa. Notre mission est de promouvoir l'approche "Une seule santé" intégrée pour relever les défis complexes de santé humaine, animale et environnementale en Afrique.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                                <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">Qu'est-ce que l'approche "One Health" ?</span>
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                                <p class="text-lg">
                                    L'approche "One Health" (Une Seule Santé) reconnaît que la santé des personnes est étroitement liée à la santé des animaux et à la santé de notre environnement partagé. C'est une démarche collaborative, multisectorielle et transdisciplinaire.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Category: Bibliothèque -->
                <section>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-inoha-black tracking-tight">Utilisation des Ressources</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                                <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">L'accès aux articles est-il payant ?</span>
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                                <p class="text-lg">
                                    Absolument pas. Toutes les ressources présentes sur la bibliothèque électronique INOHA sont en libre accès et totalement gratuites pour les étudiants, chercheurs et le grand public.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                                <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">Comment puis-je télécharger un article ?</span>
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                                <p class="text-lg">
                                    Sur la page de détails de chaque article, vous trouverez un bouton "Télécharger PDF" très visible. En cliquant dessus, le fichier se téléchargera automatiquement sur votre appareil au format haute qualité.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <button class="faq-toggle w-full px-8 py-7 text-left flex items-center justify-between group">
                                <span class="text-lg font-bold text-inoha-black group-hover:text-inoha-green transition-colors">Quels types de documents proposez-vous ?</span>
                                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-inoha-green/10 group-hover:text-inoha-green transition-all transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed border-t border-gray-50 pt-6">
                                <p class="text-lg">
                                    Notre collection comprend des articles scientifiques revus par les pairs, des thèses de doctorat, des mémoires de recherche et des rapports techniques officiels. Toutes ces ressources sont classées par thématiques (Santé Humaine, Espèces Animales, Écologie, etc.).
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Enhanced CTA Section -->
            <div class="mt-24 bg-white rounded-[3rem] p-12 lg:p-16 border border-gray-100 shadow-2xl text-center relative overflow-hidden">
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-inoha-green opacity-5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 font-sans">
                    <h3 class="text-3xl font-black text-inoha-black mb-4">Vous ne trouvez pas votre réponse ?</h3>
                    <p class="text-gray-500 mb-10 text-lg max-w-lg mx-auto">
                        Notre équipe de support académique est disponible pour vous accompagner dans vos recherches ou répondre à vos questions techniques.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact') }}" class="px-10 py-4 bg-inoha-black text-white rounded-2xl font-black uppercase hover:bg-inoha-green transition-all shadow-xl hover:shadow-inoha-green/20 transform hover:-translate-y-1">
                            Poser une Question
                        </a>
                        <a href="mailto:secretariat@unikin.inoha.ac.cd" class="px-10 py-4 bg-gray-50 text-inoha-black border border-gray-100 rounded-2xl font-black hover:bg-gray-100 transition-all transform hover:-translate-y-1 text-center break-all">
                            secretariat@unikin.inoha.ac.cd
                        </a>
                    </div>
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
