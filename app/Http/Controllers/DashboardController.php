<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('dashboards.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photos', 'public');
            $validated['image'] = $imagePath;
        }

        Photo::create($validated);

        return redirect()->route('dashboard.index')
                        ->with('success', 'Photo created successfully.');

    }

    public function edit(Photo $photo)
    {
        return response()->json([
            'id' => $photo->id,
            'title' => $photo->title,
            'image_url' => asset('storage/app/public/' . $photo->image),
        ]);
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image);

            $imagePath = $request->file('image')->store('photos', 'public');
            $validated['image'] = $imagePath;
        }

        $photo->update($validated);

        return redirect()->route('photos.index')
                        ->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->image);
        $photo->delete();
        return redirect()->route('dashboard.index')
                        ->with('success', 'Photo deleted successfully.');
    }

}
