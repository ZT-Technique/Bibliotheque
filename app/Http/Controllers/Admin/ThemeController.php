<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Theme::withCount('articles')->orderBy('name')->get();
        return view('admin.themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:themes,name',
            'description' => 'nullable|string|max:2000',
        ]);

        Theme::create($validated);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:themes,name,' . $theme->id,
            'description' => 'nullable|string|max:2000',
        ]);

        $theme->update($validated);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        // Check if theme has articles
        if ($theme->articles()->count() > 0) {
            return redirect()->route('admin.themes.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient ' . $theme->articles()->count() . ' article(s).');
        }

        $theme->delete();

        return redirect()->route('admin.themes.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
