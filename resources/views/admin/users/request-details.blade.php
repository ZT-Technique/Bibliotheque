@extends('layouts.admin')

@section('page-title', 'Détail de la demande')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.users.index', ['tab' => 'pending']) }}" class="text-sm text-gray-500 hover:text-inoha-green transition-colors">← Retour aux demandes en attente</a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-slate-50 to-white">
            <h1 class="text-2xl font-black text-inoha-black mb-2">Demande d'inscription</h1>
            <p class="text-sm text-gray-500">Examinez les informations puis approuvez ou rejetez la demande.</p>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-5">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nom complet</p>
                    <p class="text-base font-semibold text-inoha-black mt-1">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email</p>
                    <p class="text-base font-semibold text-inoha-black mt-1">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Profil demandé</p>
                    <p class="mt-2"><span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase bg-orange-50 text-orange-700">{{ $user->role }}</span></p>
                </div>
            </div>

            <div class="space-y-5">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Statut actuel</p>
                    <p class="mt-2"><span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase bg-amber-50 text-amber-700">{{ $user->approval_status }}</span></p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Date de la demande</p>
                    <p class="text-base font-semibold text-inoha-black mt-1">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Note administrateur</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $user->approval_note ?: 'Aucune note pour le moment.' }}</p>
                </div>
            </div>
        </div>

        <div class="p-8 border-t border-gray-100 bg-slate-50/60">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition-colors">Approuver la demande</button>
                </form>

                <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="reason" placeholder="Motif du rejet (optionnel)"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-rose-600 text-white font-bold hover:bg-rose-700 transition-colors">Rejeter la demande</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
