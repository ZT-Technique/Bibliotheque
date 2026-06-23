<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Ensure directory exists
            if (!File::isDirectory(base_path('uploads/sliders'))) {
                File::makeDirectory(base_path('uploads/sliders'), 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->scale(width: 1200);
            $image->save(base_path('uploads/sliders/' . $filename));
            
            $validated['image_path'] = 'uploads/sliders/' . $filename;
        }

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slide ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            // Delete old image
            if (File::exists(base_path($slider->image_path))) {
                File::delete(base_path($slider->image_path));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);
            $image->scale(width: 1200);
            $image->save(base_path('uploads/sliders/' . $filename));
            
            $validated['image_path'] = 'uploads/sliders/' . $filename;
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slide modifié avec succès.');
    }

    /**
     * Toggle visibility.
     */
    public function toggleVisibility(Slider $slider)
    {
        $slider->is_active = !$slider->is_active;
        $slider->save();

        $status = $slider->is_active ? 'activé' : 'désactivé';
        return redirect()->route('admin.sliders.index')
            ->with('success', "Le slide est désormais {$status}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if (File::exists(base_path($slider->image_path))) {
            File::delete(base_path($slider->image_path));
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slide supprimé avec succès.');
    }
}
