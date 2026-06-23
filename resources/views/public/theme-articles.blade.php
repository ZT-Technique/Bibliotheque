@extends('layouts.public')

@section('title', $theme->name)

@section('content')
<section class="px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
    <div class="mx-auto max-w-6xl">
        <div class="mb-6 flex flex-wrap items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="transition hover:text-inoha-green">Accueil</a>
            <span>/</span>
            <a href="{{ route('themes.index') }}" class="transition hover:text-inoha-green">Catégories</a>
            <span>/</span>
            <span class="font-medium text-inoha-black">{{ $theme->name }}</span>
        </div>

        <div class="rounded-[2rem] bg-white px-6 py-8 shadow-floating ring-1 ring-black/5 sm:px-8 lg:px-10">
            @php
                $accessErrorMessage = session('access_error');
                $showAccessAlert = !empty($accessErrorMessage) || !empty($accessDenied);
                $accessAlertMessage = "Cette catégorie n'est pas accessible avec votre profil actuel. Demander un profil autorisé.";
            @endphp

            @if($showAccessAlert)
                <div class="mb-6 rounded-[1.75rem] border border-amber-200 bg-gradient-to-br from-amber-50 to-white px-6 py-6 text-center shadow-sm">
                    <div class="mx-auto mb-4 flex h-16 w-16 animate-bounce items-center justify-center rounded-full bg-amber-100 text-amber-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.67 18h16.66a1 1 0 00.87-1.5l-7.5-13a1 1 0 00-1.74 0z" />
                        </svg>
                    </div>
                    <h2 class="mb-2 text-2xl font-bold text-inoha-black">Accès non autorisé</h2>
                    <p class="mx-auto max-w-2xl text-sm leading-7 text-gray-600 sm:text-base">{{ $accessAlertMessage }}</p>
                    <div class="mt-5 flex justify-center">
                        <a href="{{ route('contact') }}" class="inline-flex items-center rounded-xl border border-amber-300 bg-white px-5 py-3 text-sm font-semibold text-amber-700 transition hover:border-amber-400 hover:bg-amber-50">Demander un profil autorisé</a>
                    </div>
                </div>
            @endif

            <div class="text-center">
                <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-[1.75rem] bg-inoha-gray text-inoha-green shadow-sm ring-1 ring-inoha-green/10">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.53 0 1.04.21 1.41.59l7 7a2 2 0 010 2.82l-7 7a2 2 0 01-2.82 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <h1 class="font-serif text-3xl font-semibold text-inoha-black sm:text-4xl">{{ $theme->name }}</h1>
                @if($theme->description)
                    <p class="mx-auto mt-4 max-w-3xl text-base leading-7 text-gray-600 sm:text-lg">{{ $theme->description }}</p>
                @endif
                <div class="mt-5 inline-flex items-center rounded-full bg-inoha-gray px-4 py-2 text-sm font-semibold text-gray-600">
                    <span class="mr-2 inline-flex h-2.5 w-2.5 rounded-full bg-inoha-green"></span>
                    {{ $articles->total() }} article(s) dans ce thème
                </div>
            </div>

            @if($articles->count() > 0)
                <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($articles as $article)
                        <article class="overflow-hidden rounded-[1.75rem] bg-white shadow-sm ring-1 ring-black/5 transition hover:-translate-y-1 hover:shadow-floating">
                            <div class="aspect-[4/3] overflow-hidden bg-inoha-gray">
                                <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" class="h-full w-full object-cover">
                            </div>
                            <div class="space-y-4 p-5">
                                <h2 class="text-lg font-semibold leading-7 text-inoha-black">{{ Str::limit($article->title, 60) }}</h2>
                                <div class="space-y-2 text-sm text-gray-500">
                                    <p class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.5a7.5 7.5 0 0115 0" />
                                        </svg>
                                        <span>{{ Str::limit($article->authors, 40) }}</span>
                                    </p>
                                    <p class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $article->year ?? 'N/A' }}</span>
                                    </p>
                                </div>
                                <a href="{{ route('articles.show', $article) }}" class="inline-flex w-full items-center justify-center rounded-xl bg-inoha-green px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-700">Voir l'article</a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="mt-10 rounded-[1.75rem] border border-dashed border-black/10 bg-inoha-gray/70 px-6 py-12 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-white text-inoha-green shadow-sm">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9zM8 9h8M8 13h5" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-inoha-black">Aucun article dans ce thème pour le moment</h2>
                    <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-gray-600 sm:text-base">Les publications associées à ce thème n'ont pas encore été ajoutées ou publiées.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
