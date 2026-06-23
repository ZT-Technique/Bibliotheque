<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with('theme');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%");
            });
        }

        // Filter by theme
        if ($request->filled('theme_id')) {
            $query->where('theme_id', $request->theme_id);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(25);
        $themes = Theme::orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $themes = Theme::orderBy('name')->get();
        return view('admin.articles.create', compact('themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:500',
            'authors'          => 'required|string|max:500',
            'author_level'     => 'nullable|string|max:255',
            'author_country'   => 'nullable|string|max:100',
            'publication_date' => 'nullable|date',
            'year'             => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'theme_id'         => 'required|exists:themes,id',
            'abstract'         => 'nullable|string|max:2000',
            'keywords'         => 'nullable|string|max:500',
            'pdf_file'         => 'required|file|mimes:pdf|max:10240',
            'cover_image'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'author_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_visible'       => 'boolean',
        ]);

        $validated['is_visible'] = $request->boolean('is_visible', true);

        // Upload author photo
        if ($request->hasFile('author_image')) {
            $authorImg = $request->file('author_image');
            $authorImgName = time() . '_author_' . uniqid() . '.' . $authorImg->getClientOriginalExtension();
            if (!file_exists(base_path('uploads/authors'))) {
                mkdir(base_path('uploads/authors'), 0755, true);
            }
            $authorImg->move(base_path('uploads/authors'), $authorImgName);
            $validated['author_image'] = 'uploads/authors/' . $authorImgName;
        }

        // Upload PDF
        $pdfFile = $request->file('pdf_file');
        $pdfName = time() . '_' . uniqid() . '.pdf';
        $pdfFile->move(base_path('uploads/pdfs'), $pdfName);
        $validated['pdf_path'] = 'uploads/pdfs/' . $pdfName;

        // Upload and resize cover image
        $coverFile = $request->file('cover_image');
        $coverName = time() . '_' . uniqid() . '.' . $coverFile->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($coverFile);
        $image->scale(width: 800);
        $image->save(base_path('uploads/covers/' . $coverName));
        $validated['cover_image'] = 'uploads/covers/' . $coverName;

        // Derive year from publication_date if not set
        if (empty($validated['year']) && !empty($validated['publication_date'])) {
            $validated['year'] = date('Y', strtotime($validated['publication_date']));
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $themes = Theme::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'themes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:500',
            'authors'          => 'required|string|max:500',
            'author_level'     => 'nullable|string|max:255',
            'author_country'   => 'nullable|string|max:100',
            'publication_date' => 'nullable|date',
            'year'             => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'theme_id'         => 'required|exists:themes,id',
            'abstract'         => 'nullable|string|max:2000',
            'keywords'         => 'nullable|string|max:500',
            'pdf_file'         => 'nullable|file|mimes:pdf|max:10240',
            'cover_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'author_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_visible'       => 'boolean',
        ]);

        $validated['is_visible'] = $request->boolean('is_visible', false);

        // Update author photo
        if ($request->hasFile('author_image')) {
            if ($article->author_image && File::exists(base_path($article->author_image))) {
                File::delete(base_path($article->author_image));
            }
            $authorImg = $request->file('author_image');
            $authorImgName = time() . '_author_' . uniqid() . '.' . $authorImg->getClientOriginalExtension();
            if (!file_exists(base_path('uploads/authors'))) {
                mkdir(base_path('uploads/authors'), 0755, true);
            }
            $authorImg->move(base_path('uploads/authors'), $authorImgName);
            $validated['author_image'] = 'uploads/authors/' . $authorImgName;
        }

        // Update PDF if new file uploaded
        if ($request->hasFile('pdf_file')) {
            if (File::exists(base_path($article->pdf_path))) {
                File::delete(base_path($article->pdf_path));
            }
            $pdfFile = $request->file('pdf_file');
            $pdfName = time() . '_' . uniqid() . '.pdf';
            $pdfFile->move(base_path('uploads/pdfs'), $pdfName);
            $validated['pdf_path'] = 'uploads/pdfs/' . $pdfName;
        }

        // Update cover image if new file uploaded
        if ($request->hasFile('cover_image')) {
            if (File::exists(base_path($article->cover_image))) {
                File::delete(base_path($article->cover_image));
            }
            $coverFile = $request->file('cover_image');
            $coverName = time() . '_' . uniqid() . '.' . $coverFile->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($coverFile);
            $image->scale(width: 800);
            $image->save(base_path('uploads/covers/' . $coverName));
            $validated['cover_image'] = 'uploads/covers/' . $coverName;
        }

        // Derive year from publication_date if not set
        if (empty($validated['year']) && !empty($validated['publication_date'])) {
            $validated['year'] = date('Y', strtotime($validated['publication_date']));
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article modifié avec succès.');
    }

    public function duplicate(Article $article)
    {
        $newArticle = $article->replicate();
        $newArticle->title = $article->title . ' (Copie)';
        $newArticle->downloads_count = 0;
        $newArticle->is_visible = false; // By default, copies are hidden
        $newArticle->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article dupliqué avec succès. La copie est actuellement masquée.');
    }

    public function toggleVisibility(Article $article)
    {
        $article->is_visible = !$article->is_visible;
        $article->save();

        $status = $article->is_visible ? 'affiché' : 'masqué';
        return redirect()->route('admin.articles.index')
            ->with('success', "L'article est désormais {$status}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Delete PDF file
        if (File::exists(base_path($article->pdf_path))) {
            File::delete(base_path($article->pdf_path));
        }

        // Delete cover image
        if (File::exists(base_path($article->cover_image))) {
            File::delete(base_path($article->cover_image));
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
