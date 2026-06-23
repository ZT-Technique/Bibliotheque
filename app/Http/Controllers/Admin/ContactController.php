<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = \App\Models\Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(\App\Models\Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(\App\Models\Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message supprimé avec succès.');
    }
}
