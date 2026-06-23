@extends('layouts.admin')

@section('page-title', 'Lecture du Message')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-inoha-black">Détail du message</h1>
            <p class="text-sm text-gray-500 mt-1">Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-inoha-black transition-colors font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour aux messages
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="p-8 border-b border-gray-100 bg-gray-50/50">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-inoha-green/10 rounded-2xl flex items-center justify-center text-inoha-green">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-inoha-black">{{ $contact->name }}</h2>
                        <p class="text-gray-500">{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="flex items-center gap-2 px-6 py-3 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                        </svg>
                        Répondre par Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8 space-y-8">
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Sujet du message</span>
                <h3 class="text-lg font-bold text-inoha-black">{{ $contact->subject }}</h3>
            </div>

            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-4">Contenu du message</span>
                <div class="bg-gray-50 rounded-2xl p-6 text-gray-700 leading-relaxed whitespace-pre-wrap border border-gray-100">
                    {{ $contact->message }}
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de ce message ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center gap-2 text-rose-500 hover:text-rose-700 font-bold text-sm transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Supprimer le message
                </button>
            </form>
            
            <a href="{{ route('admin.contacts.index') }}" class="text-gray-500 hover:text-inoha-black font-bold text-sm transition-colors">
                Marquer comme vu et quitter
            </a>
        </div>
    </div>
</div>
@endsection
