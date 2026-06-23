<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banniere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BanniereController extends Controller
{
    public function index()
    {
        $bannieres = Banniere::orderBy('position')->orderBy('order')->get();
        return view('admin.bannieres.index', compact('bannieres'));
    }

    public function create()
    {
        return view('admin.bannieres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'    => 'required|image|mimes:jpg,jpeg,png,avif,webp|max:4096',
            'title'    => 'nullable|string|max:255',
            'link'     => 'nullable|url|max:255',
            'position' => 'required|in:home_a,home_b,article',
            'order'    => 'required|integer',
            'is_active'=> 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            if (!File::isDirectory(base_path('uploads/bannieres'))) {
                File::makeDirectory(base_path('uploads/bannieres'), 0755, true);
            }

            $file->move(base_path('uploads/bannieres'), $filename);
            $validated['image_path'] = 'uploads/bannieres/' . $filename;
        }

        Banniere::create($validated);

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière ajoutée avec succès.');
    }

    public function edit(Banniere $banniere)
    {
        return view('admin.bannieres.edit', compact('banniere'));
    }

    public function update(Request $request, Banniere $banniere)
    {
        $validated = $request->validate([
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,avif,webp|max:4096',
            'title'    => 'nullable|string|max:255',
            'link'     => 'nullable|url|max:255',
            'position' => 'required|in:home_a,home_b,article',
            'order'    => 'required|integer',
            'is_active'=> 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            if (File::exists(base_path($banniere->image_path))) {
                File::delete(base_path($banniere->image_path));
            }
            $file     = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('uploads/bannieres'), $filename);
            $validated['image_path'] = 'uploads/bannieres/' . $filename;
        }

        $banniere->update($validated);

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière modifiée avec succès.');
    }

    public function toggleVisibility(Banniere $banniere)
    {
        $banniere->is_active = !$banniere->is_active;
        $banniere->save();

        $status = $banniere->is_active ? 'activée' : 'désactivée';
        return redirect()->route('admin.bannieres.index')
            ->with('success', "La bannière est désormais {$status}.");
    }

    public function destroy(Banniere $banniere)
    {
        if (File::exists(base_path($banniere->image_path))) {
            File::delete(base_path($banniere->image_path));
        }
        $banniere->delete();

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière supprimée.');
    }
}
