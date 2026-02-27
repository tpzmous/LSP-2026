<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::withCount('episodes')->latest()->paginate(10);
        return view('admin.comics.index', compact('comics'));
    }

    public function create()
    {
        return view('admin.comics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'genre' => 'required|string|max:100',
            'status' => 'required|in:published,draft,ongoing,completed,hiatus',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('comics', 'public');
            $validated['cover_image'] = $path;
        }

        Comic::create($validated);

        return redirect()->route('admin.comics.index')->with('success', 'Comic created successfully.');
    }

    public function edit(Comic $comic)
    {
        return view('admin.comics.edit', compact('comic'));
    }

    public function update(Request $request, Comic $comic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'genre' => 'required|string|max:100',
            'status' => 'required|in:published,draft,ongoing,completed,hiatus',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($comic->cover_image) {
                Storage::disk('public')->delete($comic->cover_image);
            }
            $path = $request->file('cover_image')->store('comics', 'public');
            $validated['cover_image'] = $path;
        }

        $comic->update($validated);

        return redirect()->route('admin.comics.index')->with('success', 'Comic updated successfully.');
    }

    public function destroy(Comic $comic)
    {
        if ($comic->cover_image) {
            Storage::disk('public')->delete($comic->cover_image);
        }
        $comic->delete();

        return redirect()->route('admin.comics.index')->with('success', 'Comic deleted successfully.');
    }
}
