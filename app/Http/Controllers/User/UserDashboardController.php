<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\UserDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'not.admin']);
    }

    public function index(Request $request)
    {
        $user      = Auth::user();
        $tab       = $request->get('tab', 'profile');
        $downloads = $user->downloads()
            ->with('article.theme')
            ->latest()
            ->paginate(15);

        $favorites = $user->favoriteArticles()
            ->with('theme')
            ->latest('user_favorites.created_at')
            ->paginate(12, ['*'], 'favorites_page');

        $stats = [
            'downloads' => UserDownload::where('user_id', $user->id)->count(),
            'favorites' => $user->favoriteArticles()->count(),
            'recent_publications' => Article::where('is_visible', true)->whereDate('created_at', '>=', now()->subDays(30))->count(),
        ];

        return view('user.dashboard', compact('user', 'tab', 'downloads', 'favorites', 'stats'));
    }

    public function toggleFavorite(Article $article)
    {
        $user = Auth::user();

        if ($user->favoriteArticles()->where('article_id', $article->id)->exists()) {
            $user->favoriteArticles()->detach($article->id);
            return back()->with('success', 'Article retiré de vos favoris.');
        }

        $user->favoriteArticles()->attach($article->id);
        return back()->with('success', 'Article ajouté à vos favoris.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'                  => 'required|string|max:255',
            'current_password'      => 'nullable|string',
            'password'              => 'nullable|string|min:8|confirmed',
        ]);

        // Update name
        $user->name = $request->name;

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])->with('tab', 'profile');
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès.')->with('tab', 'profile');
    }
}
