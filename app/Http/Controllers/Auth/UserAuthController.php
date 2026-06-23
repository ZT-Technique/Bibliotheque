<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminRegistrationAlertMail;
use App\Mail\RegistrationPendingMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    // ─── Login ─────────────────────────────────────────────────
    public function showLoginForm()
    {
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (($user->approval_status ?? 'approved') === 'pending') {
                return back()->withErrors([
                    'email' => 'Votre compte est en attente d\'approbation par l\'administrateur.',
                ])->withInput($request->only('email'));
            }

            if (($user->approval_status ?? 'approved') === 'rejected') {
                $reason = $user->approval_note ? ' Motif: ' . $user->approval_note : '';
                return back()->withErrors([
                    'email' => 'Votre compte a été rejeté.' . $reason,
                ])->withInput($request->only('email'));
            }
        }

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->withInput($request->only('email'));
    }

    // ─── Register ──────────────────────────────────────────────
    public function showRegisterForm()
    {
        return view('auth.user-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:apprenant,agent,invite',
        ]);

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'is_admin'        => false,
            'role'            => $request->role,
            'approval_status' => 'pending',
        ]);

        // Notify applicant that account is pending review.
        try {
                Mail::to($user->email)->send(new RegistrationPendingMail($user));
        } catch (\Exception $e) {
            Log::warning('Failed to send pending registration email', [
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        // Notify admins about the new account request.
        try {
            $adminEmails = User::where(function ($query) {
                    $query->where('is_admin', true)->orWhere('role', 'admin');
                })
                ->pluck('email')
                ->filter()
                ->unique()
                ->values()
                ->toArray();

            // Also include the dedicated notification address from config (if set).
            $notificationEmail = env('ADMIN_NOTIFICATION_EMAIL');
            if ($notificationEmail && filter_var($notificationEmail, FILTER_VALIDATE_EMAIL)) {
                $adminEmails = array_unique(array_merge($adminEmails, [$notificationEmail]));
            }

            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new AdminRegistrationAlertMail($user));
            }
        } catch (\Exception $e) {
            Log::warning('Failed to send admin registration alert', [
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('user.login')
            ->with('success', 'Votre demande de compte a été soumise. Un administrateur doit valider votre accès.');
    }

    // ─── Logout ────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }
}
