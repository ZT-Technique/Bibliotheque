<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        // 1. Total visits
        $totalVisits = \App\Models\Visit::count();

        // 2. Top 5 most downloaded articles
        $topArticles = \App\Models\Article::with('theme')
            ->orderBy('downloads_count', 'desc')
            ->limit(5)
            ->get();

        // 3. Top 5 most visited pages
        $topPages = \App\Models\Visit::select('path', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('path')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('admin.stats.index', compact('totalVisits', 'topArticles', 'topPages'));
    }
}
