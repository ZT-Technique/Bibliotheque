<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                $oldPath = base_path('uploads/profiles/' . $user->profile_photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Ensure directory exists
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

        $user->update($validated);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Votre profil a été mis à jour avec succès.');
    }
}
