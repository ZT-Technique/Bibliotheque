@extends('layouts.public')

@section('title', 'À propos d\'INOHA')
@section('meta_og_title', 'À propos d\'INOHA | Bibliothèque Électronique INOHA')

@section('meta_description', 'Découvrez l\'Institut One Health pour l\'Afrique (INOHA), institution de recherche et formation au sein de l\'Université de Kinshasa, engagée dans la lutte contre les maladies infectieuses.')
@section('meta_keywords', 'à propos, INOHA, Institut One Health, Afrique, Université de Kinshasa, recherche, formation, One Health')

@section('content')
    <!-- Hero Section with Pattern -->
    <section id="inoha" class="relative bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 text-white py-20 lg:py-32 overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="absolute w-full h-full" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-about" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-about)" />
            </svg>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-inoha-green/30 rounded-full blur-[160px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 bg-white/10 text-inoha-green-light px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border border-white/10">
                Qui Sommes-nous
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-8 leading-tight tracking-tight">
                À Propos d'<span class="text-inoha-green-light">INOHA</span>
            </h1>
            <p class="text-gray-400 max-w-3xl mx-auto text-lg lg:text-xl leading-relaxed">
                Institut One Health pour l'Afrique — Institution de recherche et de formation au sein de l'Université de Kinshasa.
            </p>
        </div>
    </section>

    <!-- Présentation Section -->
    <section id="bibliotheque" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16 xl:gap-24">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-inoha-green/10 text-inoha-green rounded-full text-xs font-black uppercase tracking-widest mb-8">
                        <span class="w-2 h-2 bg-inoha-green rounded-full animate-ping"></span>
                        Présentation de l'INOHA
                    </div>
                    <h2 class="text-4xl font-black text-inoha-black mb-8 leading-tight tracking-tight">Institut One Health<br><span class="text-inoha-green">pour l'Afrique</span></h2>
                    
                    <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                        <p>
                            L'Institut One Health pour l'Afrique (INOHA) est une institution de recherche et de formation au sein de l'Université de Kinshasa. La création de l'INOHA est l'aboutissement d'un long processus logique amorcé en 2005 visant à contribuer à la recherche de solutions innovantes pour faire face à des problématiques de santé publiques à travers des approches multidisciplinaires dites aussi « une seule santé ».
                        </p>
                        <p>
                            C'est en 2010 que ce processus a commencé à se structurer sur le plan institutionnel avec la création de l'Unité de Recherche et de Formation sur l'Ecologie et le Contrôle des Maladies Infectieuses (URF-ECMI) au sein du service de Microbiologie de la Faculté de Médecine de l'Université de Kinshasa.
                        </p>
                        <p>
                            En 2021, l'URF-ECMI est devenu un service à part entière sous le nom SECMI avant de devenir <strong>INOHA en 2023</strong>, créé par l'Arrêté ministériel N° 657 MINESU/CABMIN/MNB/BLB/MKK/2023 du 01 Décembre 2023.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mt-12">
                        <div class="border-l-4 border-inoha-green pl-6">
                            <div class="text-3xl font-black text-inoha-black mb-1">2023</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-tight">Année de Création</div>
                        </div>
                        <div class="border-l-4 border-inoha-green pl-6">
                            <div class="text-3xl font-black text-inoha-black mb-1">{{ \App\Models\Article::count() }}+</div>
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-tight">Publications</div>
                        </div>
                    </div>
                </div>

                <div class="flex-1 relative w-full">
                    <!-- Premium Card Decoration -->
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-inoha-green/10 rounded-full blur-3xl opacity-50 translate-x-10 -translate-y-10"></div>
                    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl opacity-50 -translate-x-10 translate-y-10"></div>
                    
                    <div class="relative bg-inoha-gray p-10 lg:p-14 rounded-[3rem] border border-gray-100 shadow-2xl overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/40 blur-3xl -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>
                        
                        <div class="relative z-10 space-y-8">
                            <div class="w-20 h-20 bg-inoha-green rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-inoha-green/40 transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <blockquote class="text-2xl lg:text-3xl font-bold text-inoha-black leading-tight tracking-tight">
                                "Comprendre l'expression des germes c'est comprendre les socio-écosystèmes de leur émergence et de leur manifestation."
                            </blockquote>
                            <div class="flex items-center gap-4 border-t border-gray-200 pt-8">
                                <div class="w-12 h-12 bg-inoha-black rounded-full flex items-center justify-center text-white font-black text-xl">M</div>
                                <div>
                                    <div class="font-bold text-inoha-black">Prof. Jean-Jacques Muyembe</div>
                                    <div class="text-xs font-bold text-gray-400 uppercase tracking-widest">Directeur INOHA</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Axes Stratégiques -->
    <section class="py-24 bg-gray-50 border-y border-gray-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-20">
            <h2 class="text-4xl font-black text-inoha-black mb-6 tracking-tight">Axes Stratégiques</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-lg leading-relaxed">
                L'Institut One Health pour l'Afrique organise ses activités autour de quatre axes stratégiques clés.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $axes = [
                        [
                            'num'   => '01',
                            'title' => 'Axe Recherche',
                            'desc'  => 'Contribuer à la compréhension du fonctionnement des complexes socio-écologiques et leurs interactions, ainsi que leurs rôles dans l\'émergence, la diffusion et la persistance des phénomènes morbides.',
                            'color' => 'blue',
                            'icon'  => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'
                        ],
                        [
                            'num'   => '02',
                            'title' => 'Axe Formation',
                            'desc'  => 'Développer les Masters d\'Ecologie et Gouvernance des Maladies Infectieuses (M1 & M2), créer une composante Licence, assurer des formations continues de courte durée et développer une école doctorale.',
                            'color' => 'green',
                            'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
                        ],
                        [
                            'num'   => '03',
                            'title' => 'Axe Innovation',
                            'desc'  => 'Intégrer les approches éco-épidémiologiques dans les systèmes de surveillance, et aider les décideurs avec des informations utiles à l\'ajustement de la gouvernance de la lutte contre les maladies.',
                            'color' => 'purple',
                            'icon'  => 'M13 10V3L4 14h7v7l9-11h-7z'
                        ],
                        [
                            'num'   => '04',
                            'title' => 'Axe Observatoire',
                            'desc'  => 'Mettre en place des bases de données des phénomènes morbides récurrents en RDC et dans les pays limitrophes, avec un système de diffusion continue de bulletins d\'analyses et de notes d\'alerte.',
                            'color' => 'orange',
                            'icon'  => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                        ],
                    ];
                @endphp

                @foreach($axes as $axe)
                <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group relative overflow-hidden">
                    <div class="absolute bottom-0 right-0 w-24 h-24 bg-{{ $axe['color'] == 'green' ? 'inoha-green' : $axe['color'] }}-500/5 rounded-tl-[100px] transition-all group-hover:scale-150"></div>
                    <div class="text-6xl font-black text-gray-100 mb-4 group-hover:text-inoha-green/20 transition-colors">{{ $axe['num'] }}</div>
                    <div class="w-16 h-16 bg-{{ $axe['color'] == 'green' ? 'inoha-green' : $axe['color'] }}-50 rounded-2xl flex items-center justify-center text-{{ $axe['color'] == 'green' ? 'inoha-green' : $axe['color'] }}-600 mb-8 transform group-hover:scale-110 group-hover:rotate-6 transition-all ring-4 ring-transparent group-hover:ring-{{ $axe['color'] == 'green' ? 'inoha-green' : $axe['color'] }}-50">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $axe['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-inoha-black mb-4 group-hover:text-inoha-green transition-colors">{{ $axe['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $axe['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Chronologie -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="inline-flex items-center gap-2 bg-inoha-green/10 text-inoha-green px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                    Notre Parcours
                </span>
                <h2 class="text-4xl font-black text-inoha-black mb-6 tracking-tight">Chronologie de la Création</h2>
                <p class="text-gray-500 text-lg leading-relaxed">
                    Plusieurs événements clés ont jalonné le parcours menant à la création de l'Institut One Health pour l'Afrique.
                </p>
            </div>

            @php
                $timeline = [
                    [
                        'year' => '2009',
                        'title' => 'Création de l\'URF-ECMI',
                        'desc' => 'Création de l\'Unité de Recherche et Formation en Ecologie et Contrôle des Maladies Infectieuses (URF-ECMI), fruit d\'un partenariat entre le Ministère de la Santé Publique, l\'Université de Kinshasa (UNIKIN), l\'Université de Franche-Comté (Besançon) et la Fondation Veolia Environnement.',
                    ],
                    [
                        'year' => '2014',
                        'title' => 'Lancement du Master ECOM-ALGER',
                        'desc' => 'Lancement du Master 1 en Ecologie des Maladies Infectieuses, Aléas Naturels et Gestion des Risques (ECOM-ALGER) par l\'URF-ECMI, en collaboration avec l\'Université de Franche-Comté, l\'Université de Montpellier 3, la Fondation Veolia et le Ministère de la Santé.',
                    ],
                    [
                        'year' => '2015',
                        'title' => 'Convention de Coopération',
                        'desc' => 'Signature d\'une convention de coopération entre l\'Université de Kinshasa et l\'Ambassade de France en RDC pour le développement du Master ECOM-ALGER.',
                    ],
                    [
                        'year' => '2020',
                        'title' => 'Lancement du Master ECOGM',
                        'desc' => 'Lancement du Master 2 en Ecologie et Gouvernance des Maladies Infectieuses (ECOGM) adossé à l\'URF-ECMI.',
                    ],
                    [
                        'year' => '2021',
                        'title' => 'Transformation en SECMI',
                        'desc' => 'Transformation de l\'URF-ECMI en Service d\'Ecologie et Contrôle des Maladies Infectieuses (SECMI).',
                    ],
                    [
                        'year' => '2022',
                        'title' => 'Partenariats Stratégiques',
                        'desc' => 'Signature du partenariat entre le SECMI et l\'Organisation Internationale pour la Migration (OIM). Puis signature du partenariat avec la Fondation Congolaise pour la Recherche Médicale (FCRM).',
                    ],
                    [
                        'year' => '2023',
                        'title' => 'Naissance de l\'INOHA',
                        'desc' => 'Le 01 Décembre 2023, signature de l\'arrêté ministériel N° 657 MINESU/CABMIN/MNB/BLB/MKK/2023 créant l\'INOHA. Le 8 décembre 2023 : lancement du Colloque International One Health pour célébrer les 10 ans du Master ECOM-ALGER.',
                    ],
                ];
            @endphp

            <div class="relative">
                <!-- Vertical line -->
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-inoha-green via-inoha-green/50 to-transparent hidden md:block"></div>

                <div class="space-y-12">
                    @foreach($timeline as $index => $event)
                    <div class="flex flex-col md:flex-row gap-6 md:gap-8 group">
                        <!-- Year Badge -->
                        <div class="flex-shrink-0 flex items-start md:items-center gap-4">
                            <div class="relative z-10 w-16 h-16 bg-white border-2 border-inoha-green rounded-2xl flex items-center justify-center shadow-lg group-hover:bg-inoha-green transition-colors duration-300">
                                <span class="text-xs font-black text-inoha-green group-hover:text-white transition-colors duration-300">{{ $event['year'] }}</span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="flex-1 bg-gray-50 rounded-3xl p-8 border border-gray-100 group-hover:border-inoha-green/30 group-hover:shadow-lg transition-all duration-300">
                            <h3 class="text-xl font-black text-inoha-black mb-3 group-hover:text-inoha-green transition-colors">{{ $event['title'] }}</h3>
                            <p class="text-gray-500 leading-relaxed">{{ $event['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Historique & Missions -->
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-inoha-black mb-6 tracking-tight">Historique et Missions</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">
                    L'INOHA s'inscrit dans la continuité du Service d'Ecologie et Contrôle des Maladies Infectieuses (SECMI), dont l'objectif était de comprendre les mécanismes d'émergence des maladies infectieuses.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Formations offertes -->
                <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-sm">
                    <div class="w-16 h-16 bg-inoha-green/10 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-inoha-black mb-6">Formations Proposées</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-inoha-green rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="font-bold text-inoha-black">Licence en One Health</div>
                                <div class="text-sm text-gray-500">Ecologie et gouvernance des maladies infectieuses</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-inoha-green rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="font-bold text-inoha-black">Master 1 — ECOM-ALGER</div>
                                <div class="text-sm text-gray-500">Ecologie des Maladies Infectieuses, Aléas Naturels et Gestion des Risques</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-inoha-green rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="font-bold text-inoha-black">Master 2 — ECOGM</div>
                                <div class="text-sm text-gray-500">Ecologie et Gouvernance des Maladies Infectieuses</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-inoha-green rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="font-bold text-inoha-black">Master — MASG</div>
                                <div class="text-sm text-gray-500">Modélisation Appliquée en Santé Globale</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 bg-inoha-green rounded-full mt-2 flex-shrink-0"></div>
                            <div>
                                <div class="font-bold text-inoha-black">Doctorat</div>
                                <div class="text-sm text-gray-500">Ecole doctorale — Compréhension et Gouvernance des Socio-écosystèmes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Localisation -->
                <div class="bg-inoha-black rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-inoha-green/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-inoha-green/20 rounded-2xl flex items-center justify-center mb-8">
                            <svg class="w-8 h-8 text-inoha-green-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black mb-6">Nous Contacter</h3>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <svg class="w-5 h-5 text-inoha-green-light flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <div class="font-bold">Bureau UNIKIN</div>
                                    <div class="text-gray-400 text-sm">Faculté de Médecine<br>Lemba / Kinshasa, RD Congo</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="w-5 h-5 text-inoha-green-light flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <div class="font-bold">+243 975 594 792</div>
                                    <div class="text-gray-400 text-sm">+243 896 846 702 / +243 999 796 182</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="w-5 h-5 text-inoha-green-light flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div class="font-bold text-sm">secretariat@unikin.inoha.ac.cd</div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="w-5 h-5 text-inoha-green-light flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-gray-400 text-sm">Lundi - Samedi : 9h00 - 18h30</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Large CTA Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-inoha-black rounded-[3rem] overflow-hidden p-12 lg:p-20 shadow-2xl">
                <!-- Abstract Design in CTA -->
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-inoha-green rounded-full blur-[140px] translate-x-1/2 -translate-y-1/2"></div>
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                    <div class="text-center lg:text-left max-w-2xl">
                        <h2 class="text-3xl lg:text-5xl font-black text-white mb-6 leading-tight">Accédez à nos <br><span class="text-inoha-green-light">Ressources Scientifiques</span></h2>
                        <p class="text-gray-400 text-lg lg:text-xl leading-relaxed">
                            Rejoignez notre communauté de chercheurs et accédez immédiatement à des ressources critiques pour vos projets.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 whitespace-nowrap">
                        <a href="{{ route('articles.index') }}" class="px-10 py-5 bg-inoha-green text-white rounded-2xl font-black hover:bg-inoha-green-dark transition-all shadow-xl shadow-inoha-green/20 transform hover:-translate-y-1">
                            Explorer la Bibliothèque
                        </a>
                        <a href="{{ route('contact') }}" class="px-10 py-5 bg-white/10 text-white rounded-2xl font-black hover:bg-white/20 transition-all backdrop-blur-md border border-white/10 transform hover:-translate-y-1">
                            Nous Contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
