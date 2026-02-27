<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Episode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EpisodeController extends Controller
{
    public function index(Comic $comic)
    {
        $episodes = $comic->episodes()->orderByDesc('episode_number')->paginate(10);
        return view('admin.episodes.index', compact('comic', 'episodes'));
    }

    public function create(Comic $comic)
    {
        return view('admin.episodes.create', compact('comic'));
    }

    public function store(Request $request, Comic $comic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:204800', // 200MB
        ]);

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('episodes', 'public');
            $validated['pdf_file'] = $path;
        }

        DB::transaction(function () use ($comic, $validated) {
            // Lock episodes for update to prevent race conditions on episode number
            $latestNumber = $comic->episodes()->lockForUpdate()->max('episode_number');
            $validated['episode_number'] = $latestNumber ? $latestNumber + 1 : 1;
            $comic->episodes()->create($validated);
        });

        return redirect()->route('admin.comics.episodes.index', $comic)->with('success', 'Episode created successfully.');
    }

    public function edit(Episode $episode)
    {
        return view('admin.episodes.edit', compact('episode'));
    }

    public function update(Request $request, Episode $episode)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:204800', // 200MB
        ]);

        if ($request->hasFile('pdf_file')) {
            if ($episode->pdf_file) {
                Storage::disk('public')->delete($episode->pdf_file);
            }
            $path = $request->file('pdf_file')->store('episodes', 'public');
            $validated['pdf_file'] = $path;
        }

        $episode->update($validated);

        return redirect()->route('admin.comics.episodes.index', $episode->comic_id)->with('success', 'Episode updated successfully.');
    }

    public function destroy(Episode $episode)
    {
        $comicId = $episode->comic_id;
        if ($episode->pdf_file) {
            Storage::disk('public')->delete($episode->pdf_file);
        }
        $episode->delete();

        return redirect()->route('admin.comics.episodes.index', $comicId)->with('success', 'Episode deleted successfully.');
    }
}
