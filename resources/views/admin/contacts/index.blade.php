@extends('layouts.admin')

@section('page-title', 'Messagerie de Contact')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-inoha-black">Messages de Contact</h1>
    <p class="text-sm text-gray-500 mt-1">Gérez les demandes et questions des utilisateurs</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
        <h2 class="font-bold text-lg text-inoha-black">Boîte de réception</h2>
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $messages->total() }} messages</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white">
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Expéditeur</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Sujet</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Statut</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($messages as $message)
                    <tr class="hover:bg-gray-50/50 transition-colors group {{ !$message->is_read ? 'bg-blue-50/30' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-inoha-black">{{ $message->name }}</span>
                                <span class="text-xs text-gray-500">{{ $message->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-700 line-clamp-1 {{ !$message->is_read ? 'font-bold' : '' }}">{{ $message->subject }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if(!$message->is_read)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-600 uppercase tracking-wider">
                                    Nouveau
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-400 uppercase tracking-wider">
                                    Lu
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.contacts.show', $message) }}" class="p-2 text-gray-400 hover:text-inoha-green hover:bg-inoha-green/10 rounded-lg transition-all" title="Lire">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce message ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-400 italic">Aucun message reçu pour le moment</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 bg-gray-50/50 border-t border-gray-100">
        {{ $messages->links() }}
    </div>
</div>
@endsection
