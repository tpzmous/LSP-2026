<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        $query = Comic::where('status', 'published')->withCount('episodes');

        // Filter: search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter: filter by genre
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Sort
        match ($request->sort) {
            'oldest'     => $query->oldest(),
            'az'         => $query->orderBy('title', 'asc'),
            'episodes'   => $query->orderByDesc('episodes_count'),
            default      => $query->latest(),
        };

        $comics = $query->paginate(12);

        // Distinct genres for sidebar
        $genres = Comic::where('status', 'published')
            ->whereNotNull('genre')
            ->distinct()
            ->orderBy('genre')
            ->pluck('genre');

        return view('public.comic.index', compact('comics', 'genres'));
    }

    public function show($id)
    {
        $comic = Comic::with(['episodes' => function($query) {
            $query->orderBy('episode_number', 'asc');
        }])->where('status', 'published')->findOrFail($id);

        return view('public.comic.show', compact('comic'));
    }
}
