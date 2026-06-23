<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banniere;
use App\Models\Theme;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    private const DEFAULT_CATEGORIES = [
        'Mémoires des apprenants',
        'Articles publiés par les apprenants',
        'Consultations des apprenants',
        'Rapports',
    ];

    private const CATEGORY_ACCESS = [
        'memoires des apprenants' => ['apprenant', 'agent', 'admin'],
        'articles publies par les apprenants' => ['apprenant', 'agent', 'invite', 'admin'],
        'consultations des apprenants' => ['apprenant', 'agent', 'admin'],
        'rapports' => ['apprenant', 'agent', 'invite', 'admin'],
    ];

    /**
     * Display the home page.
     */
    public function home()
    {
        $themes = Theme::withCount(['articles' => function($query) {
            $query->where('is_visible', true);
        }])->orderBy('name')->get();
        
        $recentArticles = Article::where('is_visible', true)
            ->with('theme')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
            
        // Fetch active sliders ordered by 'order' field
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        // The instruction mentions "Fallback to recent articles if no sliders are active."
        // However, the provided Code Edit snippet does not implement this fallback logic,
        // it simply fetches sliders and passes them.
        // For now, I will follow the Code Edit snippet's implementation.
        
        $banniereA = Banniere::activeForPosition('home_a');
        $banniereB = Banniere::activeForPosition('home_b');

        return view('public.home', compact('themes', 'recentArticles', 'sliders', 'banniereA', 'banniereB'));
    }

    /**
     * Display all themes.
     */
    public function themes()
    {
        $this->ensureDefaultCategories();

        $themes = Theme::withCount(['articles' => function($query) {
            $query->where('is_visible', true);
        }])
            ->orderByRaw("CASE
                WHEN name = 'Mémoires des apprenants' THEN 1
                WHEN name = 'Articles publiés par les apprenants' THEN 2
                WHEN name = 'Consultations des apprenants' THEN 3
                WHEN name = 'Rapports' THEN 4
                ELSE 99
            END")
            ->orderBy('name')
            ->get();
        return view('public.themes', compact('themes'));
    }

    /**
     * Display articles of a specific theme.
     */
    public function themeArticles(Theme $theme)
    {
        if (!$this->canAccessTheme($theme)) {
            return view('public.theme-articles', [
                'theme' => $theme,
                'articles' => $theme->articles()->whereRaw('1 = 0')->paginate(25),
                'accessDenied' => true,
            ]);
        }

        $articles = $theme->articles()->where('is_visible', true)->with('theme')->orderBy('created_at', 'desc')->paginate(25);
        return view('public.theme-articles', compact('theme', 'articles'));
    }

    /**
     * Display all articles with search and filters.
     */
    public function articles(Request $request)
    {
        $query = Article::where('is_visible', true)->with('theme');

        $disallowedThemeIds = $this->restrictedThemeIdsForCurrentUser();
        if (!empty($disallowedThemeIds)) {
            $query->whereNotIn('theme_id', $disallowedThemeIds);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%")
                  ->orWhere('keywords', 'like', "%{$search}%")
                  ->orWhere('abstract', 'like', "%{$search}%");
            });
        }

        // Filter by theme
        if ($request->filled('theme_id')) {
            $query->where('theme_id', $request->theme_id);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Sort
        $sortBy = $request->get('sort', 'date_desc');
        switch ($sortBy) {
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'year':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $perPage = $request->get('per_page', 25);
        $articles = $query->paginate($perPage)->appends($request->except('page'));
        
        $themesQuery = Theme::orderBy('name');
        if (!empty($disallowedThemeIds)) {
            $themesQuery->whereNotIn('id', $disallowedThemeIds);
        }
        $themes = $themesQuery->get();
        $years = Article::whereNotNull('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('public.articles', compact('articles', 'themes', 'years'));
    }

    /**
     * Display a specific article.
     */
    public function show(Article $article)
    {
        if (!$article->is_visible && !auth()->check()) {
            abort(404);
        }

        $article->load('theme');
        if (!$this->canAccessTheme($article->theme)) {
            return redirect()->route('themes.show', $article->theme)
                ->with('access_error', 'Accès interdit à cette catégorie. Vous pouvez contacter l\'administrateur pour demander un profil autorisé.');
        }

        $relatedArticles = Article::where('is_visible', true)
            ->where('theme_id', $article->theme_id)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        $banniereArticle = Banniere::activeForPosition('article');
        return view('public.show', compact('article', 'relatedArticles', 'banniereArticle'));
    }

    /**
     * Download article PDF.
     * Requires authenticated user (non-admin).
     */
    public function download(Article $article)
    {
        // Must be logged in to download
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('download_error', 'Vous devez avoir un compte et être connecté pour télécharger cet article.');
        }

        $article->loadMissing('theme');
        if (!$this->canAccessTheme($article->theme)) {
            return redirect()->route('themes.show', $article->theme)
                ->with('access_error', 'Accès interdit à cette catégorie. Contactez l\'administrateur pour demander un profil autorisé.');
        }

        $filePath = base_path($article->pdf_path);

        if (file_exists($filePath)) {
            // Increment global download counter
            $article->increment('downloads_count');

            // Record in user history (avoid duplicates per download event: always insert)
            \App\Models\UserDownload::create([
                'user_id'    => auth()->id(),
                'article_id' => $article->id,
            ]);

            return response()->download($filePath, $article->title . '.pdf');
        }

        abort(404, 'Fichier non trouvé');
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('public.about');
    }

    /**
     * Display FAQ page.
     */
    public function faq()
    {
        return view('public.faq');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('public.contact');
    }

    public function searchSuggestions(Request $request)
    {
        $query = trim((string) $request->get('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([
                'articles' => [],
                'themes' => [],
            ]);
        }

        $disallowedThemeIds = $this->restrictedThemeIdsForCurrentUser();

        $articles = Article::query()
            ->where('is_visible', true)
            ->with('theme:id,name')
            ->when(!empty($disallowedThemeIds), function ($builder) use ($disallowedThemeIds) {
                $builder->whereNotIn('theme_id', $disallowedThemeIds);
            })
            ->where(function ($builder) use ($query) {
                $builder->where('title', 'like', "%{$query}%")
                    ->orWhere('authors', 'like', "%{$query}%")
                    ->orWhere('keywords', 'like', "%{$query}%")
                    ->orWhere('abstract', 'like', "%{$query}%");
            })
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->map(function (Article $article) {
                $subtitleParts = array_filter([
                    $article->authors,
                    optional($article->theme)->name,
                ]);

                return [
                    'title' => $article->title,
                    'subtitle' => implode(' · ', $subtitleParts),
                    'url' => route('articles.show', $article),
                ];
            })
            ->values();

        $themes = Theme::query()
            ->when(!empty($disallowedThemeIds), function ($builder) use ($disallowedThemeIds) {
                $builder->whereNotIn('id', $disallowedThemeIds);
            })
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->limit(4)
            ->get()
            ->map(function (Theme $theme) {
                return [
                    'title' => $theme->name,
                    'subtitle' => $theme->description,
                    'url' => route('themes.show', $theme),
                ];
            })
            ->values();

        return response()->json([
            'articles' => $articles,
            'themes' => $themes,
        ]);
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\Contact::create($validated);

        return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    private function ensureDefaultCategories(): void
    {
        foreach (self::DEFAULT_CATEGORIES as $categoryName) {
            Theme::firstOrCreate(
                ['name' => $categoryName],
                ['description' => 'Catégorie par défaut de la bibliothèque INOHA.']
            );
        }
    }

    private function normalizeCategoryName(string $name): string
    {
        return Str::of($name)->lower()->ascii()->replace('-', ' ')->squish()->value();
    }

    private function resolveCurrentRole(): ?string
    {
        if (!auth()->check()) {
            return null;
        }

        return auth()->user()->effective_role;
    }

    private function canAccessTheme(?Theme $theme): bool
    {
        if (!$theme) {
            return true;
        }

        $key = $this->normalizeCategoryName($theme->name);
        if (!isset(self::CATEGORY_ACCESS[$key])) {
            return true;
        }

        $currentRole = $this->resolveCurrentRole();
        if ($currentRole === null) {
            return false;
        }

        return in_array($currentRole, self::CATEGORY_ACCESS[$key], true);
    }

    private function restrictedThemeIdsForCurrentUser(): array
    {
        $themes = Theme::query()->whereIn('name', self::DEFAULT_CATEGORIES)->get(['id', 'name']);
        $restricted = [];

        foreach ($themes as $theme) {
            if (!$this->canAccessTheme($theme)) {
                $restricted[] = $theme->id;
            }
        }

        return $restricted;
    }

}
