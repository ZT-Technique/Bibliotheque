@extends('layouts.admin')

@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-inoha-black">Utilisateurs</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez les comptes utilisateurs et les accès administrateurs</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-inoha-green text-white rounded-xl font-bold hover:bg-inoha-green-dark transition-all shadow-lg shadow-inoha-green/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvel administrateur
    </a>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

{{-- Stats Summary --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-inoha-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-inoha-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-inoha-black">{{ $publicUsers->total() }}</p>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Membres inscrits</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-inoha-black">{{ $admins->total() }}</p>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Administrateurs</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-inoha-black">{{ $totalUserDownloads }}</p>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Téléchargements totaux</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-inoha-black">{{ $pendingUsers->total() }}</p>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Comptes en attente</p>
        </div>
    </div>
</div>

{{-- Tabs --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

    <div class="flex border-b border-gray-200">
        <a href="{{ route('admin.users.index', ['tab' => 'users']) }}"
           class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $tab === 'users' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-gray-500 hover:text-inoha-black' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Utilisateurs inscrits
            <span class="ml-1 bg-inoha-green/10 text-inoha-green text-xs px-2 py-0.5 rounded-full font-bold">{{ $publicUsers->total() }}</span>
        </a>
        <a href="{{ route('admin.users.index', ['tab' => 'admins']) }}"
           class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $tab === 'admins' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-gray-500 hover:text-inoha-black' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Administrateurs
            <span class="ml-1 bg-blue-50 text-blue-600 text-xs px-2 py-0.5 rounded-full font-bold">{{ $admins->total() }}</span>
        </a>
        <a href="{{ route('admin.users.index', ['tab' => 'pending']) }}"
           class="flex items-center gap-2 px-6 py-4 text-sm font-semibold transition-colors border-b-2 {{ $tab === 'pending' ? 'border-inoha-green text-inoha-green' : 'border-transparent text-gray-500 hover:text-inoha-black' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            En attente
            <span class="ml-1 bg-orange-50 text-orange-600 text-xs px-2 py-0.5 rounded-full font-bold">{{ $pendingUsers->total() }}</span>
        </a>
    </div>

    {{-- ─── Tab: En attente ─── --}}
    @if($tab === 'pending')
    <div>
        <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Demandes d'inscription à valider</p>
            <p class="text-xs text-gray-400">{{ $pendingUsers->total() }} en attente</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Demandeur</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Profil demandé</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pendingUsers as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-inoha-black">{{ $user->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 uppercase">{{ $user->role }}</span>
                        </td>
                        <td class="px-6 py-4 text-center text-xs text-gray-500">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.request-details', $user) }}" class="px-3 py-2 text-xs font-bold rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">Voir détail</a>
                                <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 text-xs font-bold rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Approuver</button>
                                </form>
                                <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    <input type="text" name="reason" placeholder="Motif (optionnel)" class="px-2 py-2 text-xs border border-gray-200 rounded-lg">
                                    <button type="submit" class="px-3 py-2 text-xs font-bold rounded-lg bg-rose-100 text-rose-700 hover:bg-rose-200 transition-colors">Rejeter</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-400">Aucune demande en attente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pendingUsers->hasPages())
        <div class="p-5 border-t border-gray-100 bg-gray-50/50">
            {{ $pendingUsers->appends(['tab' => 'pending'])->links() }}
        </div>
        @endif
    </div>
    @endif

    {{-- ─── Tab: Utilisateurs inscrits ─── --}}
    @if($tab === 'users')
    <div>
        <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Classés par nombre de téléchargements décroissant</p>
            <p class="text-xs text-gray-400">{{ $publicUsers->total() }} membres</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">#</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Membre</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Téléchargements</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Inscrit le</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($publicUsers as $index => $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-300">{{ $publicUsers->firstItem() + $index }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-inoha-green flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-bold text-inoha-black">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->downloads_count > 0)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 border border-amber-100 rounded-full text-amber-700 text-xs font-bold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ $user->downloads_count }} fichier{{ $user->downloads_count > 1 ? 's' : '' }}
                                </span>
                            @else
                                <span class="text-xs text-gray-300 font-medium">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs text-gray-500">{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce compte utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-400 font-medium">Aucun utilisateur inscrit pour l'instant</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($publicUsers->hasPages())
        <div class="p-5 border-t border-gray-100 bg-gray-50/50">
            {{ $publicUsers->appends(['tab' => 'users'])->links() }}
        </div>
        @endif
    </div>
    @endif

    {{-- ─── Tab: Administrateurs ─── --}}
    @if($tab === 'admins')
    <div>
        <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Comptes avec accès à l'administration</p>
            <p class="text-xs text-gray-400">{{ $admins->total() }} admins</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Administrateur</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Créé le</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($admins as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center border border-gray-100 bg-gray-50 flex-shrink-0">
                                    @if($user->profile_photo)
                                        <img src="{{ route('uploads.serve', ['type' => 'profiles', 'filename' => $user->profile_photo]) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-blue-600 font-bold text-xs">{{ substr($user->name, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-inoha-black">{{ $user->name }}</span>
                                    @if($user->id === auth()->id())
                                        <span class="ml-2 text-[10px] bg-inoha-green/10 text-inoha-green font-bold px-1.5 py-0.5 rounded">Vous</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs text-gray-500">{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet administrateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($admins->hasPages())
        <div class="p-5 border-t border-gray-100 bg-gray-50/50">
            {{ $admins->appends(['tab' => 'admins'])->links() }}
        </div>
        @endif
    </div>
    @endif

</div>
@endsection
