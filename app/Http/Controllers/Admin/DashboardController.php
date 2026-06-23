<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserDownload;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Statistics
        $totalArticles = Article::count();
        $totalThemes = Theme::count();
        $totalDownloads = Article::sum('downloads_count');
        $articlesThisWeek = Article::where('created_at', '>=', now()->subWeek())->count();
        $articlesThisMonth = Article::where('created_at', '>=', now()->subMonth())->count();

        // Recent articles (5 latest)
        $recentArticles = Article::with('theme')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Themes with article count
        $themesWithCount = Theme::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->get();

        // User statistics
        $totalUsers      = User::where('is_admin', false)->count(); // public members
        $totalAdmins     = User::where('is_admin', true)->count();
        $totalUserDownloads = UserDownload::count();
        return view('admin.dashboard', compact(
            'totalArticles',
            'totalThemes',
            'totalDownloads',
            'articlesThisWeek',
            'articlesThisMonth',
            'recentArticles',
            'themesWithCount',
            'totalUsers',
            'totalAdmins',
            'totalUserDownloads'
        ));
    }
}
