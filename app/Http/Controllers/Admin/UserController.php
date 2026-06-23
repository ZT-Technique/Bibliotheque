<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationDecisionMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'users');

        // Total downloads for all public users (computed before pagination)
        $totalUserDownloads = \App\Models\UserDownload::count();

        // Public users (non-admins) with download count
        $publicUsers = User::where('is_admin', false)
            ->where('approval_status', 'approved')
            ->withCount('downloads')
            ->orderByDesc('downloads_count')
            ->paginate(25, ['*'], 'users_page');

        $pendingUsers = User::where('is_admin', false)
            ->where('approval_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['*'], 'pending_page');

        // Admin accounts
        $admins = User::where(function ($query) {
                $query->where('is_admin', true)->orWhere('role', 'admin');
            })
            ->orderBy('name')
            ->paginate(20, ['*'], 'admin_page');

        return view('admin.users.index', compact('publicUsers', 'pendingUsers', 'admins', 'tab', 'totalUserDownloads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'role' => 'nullable|in:apprenant,agent,invite,admin',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(base_path('uploads/profiles'))) {
                mkdir(base_path('uploads/profiles'), 0755, true);
            }
            $file->move(base_path('uploads/profiles'), $filename);
            $validated['profile_photo'] = $filename;
        }

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_admin'] = $request->boolean('is_admin', false);
        $validated['role'] = $validated['is_admin'] ? 'admin' : ($request->input('role', 'apprenant'));
        $validated['approval_status'] = 'approved';

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Administrateur créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function requestDetails(User $user)
    {
        if (($user->approval_status ?? null) !== 'pending') {
            return redirect()->route('admin.users.index', ['tab' => 'pending'])
                ->with('error', 'Cette demande n\'est plus en attente.');
        }

        return view('admin.users.request-details', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'role' => 'nullable|in:apprenant,agent,invite,admin',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo
            if ($user->profile_photo) {
                $oldPath = base_path('uploads/profiles/' . $user->profile_photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(base_path('uploads/profiles'))) {
                mkdir(base_path('uploads/profiles'), 0755, true);
            }
            $file->move(base_path('uploads/profiles'), $filename);
            $validated['profile_photo'] = $filename;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_admin'] = $request->boolean('is_admin', false);
        $validated['role'] = $validated['is_admin'] ? 'admin' : ($request->input('role', $user->role ?: 'apprenant'));

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Administrateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Administrateur supprimé avec succès.');
    }

    public function approve(User $user)
    {
        if (($user->approval_status ?? null) !== 'pending') {
            return redirect()->route('admin.users.index', ['tab' => 'pending'])
                ->with('error', 'Ce compte n\'est plus en attente.');
        }

        $user->update([
            'approval_status' => 'approved',
            'approval_note' => null,
        ]);

        try {
            Mail::to($user->email)->send(new RegistrationDecisionMail($user, true));
        } catch (\Exception $e) {
            Log::warning('Failed to send approval email', [
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('admin.users.index', ['tab' => 'pending'])
            ->with('success', 'Le compte a été approuvé et l\'utilisateur a été notifié.');
    }

    public function reject(Request $request, User $user)
    {
        if (($user->approval_status ?? null) !== 'pending') {
            return redirect()->route('admin.users.index', ['tab' => 'pending'])
                ->with('error', 'Ce compte n\'est plus en attente.');
        }

        $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $user->update([
            'approval_status' => 'rejected',
            'approval_note' => $request->input('reason'),
        ]);

        try {
            Mail::to($user->email)->send(new RegistrationDecisionMail($user, false, $request->input('reason')));
        } catch (\Exception $e) {
            Log::warning('Failed to send rejection email', [
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('admin.users.index', ['tab' => 'pending'])
            ->with('success', 'Le compte a été rejeté et l\'utilisateur a été notifié.');
    }
}
