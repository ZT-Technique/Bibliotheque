@extends('layouts.public')

@section('title', 'Page Non Trouvée')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-inoha-black via-inoha-black to-gray-900 overflow-hidden relative">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-inoha-green rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-inoha-green rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-md w-full text-center relative z-10">
        <div class="space-y-8">
            <!-- 404 Typography -->
            <div class="relative inline-block">
                <h1 class="text-[12rem] font-black text-white/5 leading-none select-none">404</h1>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-32 h-32 bg-inoha-green/20 rounded-3xl flex items-center justify-center p-6 backdrop-blur-sm border border-inoha-green/30 transform -rotate-12 shadow-2xl">
                        <svg class="w-full h-full text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.246 18.477 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">
                    Oups ! Page introuvable.
                </h2>
                <p class="text-lg text-gray-400 max-w-sm mx-auto">
                    Désolé, la page que vous recherchez semble avoir disparu dans les archives de notre bibliothèque.
                </p>
            </div>

            <div class="pt-8">
                <a href="{{ route('home') }}" 
                    class="inline-flex items-center gap-3 px-8 py-4 bg-inoha-green hover:bg-inoha-green-dark text-white font-bold rounded-2xl transition-all shadow-xl shadow-inoha-green/20 group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à l'accueil
                </a>
            </div>
        </div>
        
        <p class="mt-20 text-xs text-gray-500 uppercase tracking-widest font-bold">
            V.1.0.1
        </p>
    </div>
</div>
@endsection
