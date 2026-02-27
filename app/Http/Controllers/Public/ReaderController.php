<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Episode;

class ReaderController extends Controller
{
    public function read(Comic $comic, Episode $episode)
    {
        if ($comic->status !== 'published') {
            abort(404);
        }

        if ($episode->comic_id !== $comic->id) {
            abort(404);
        }

        $prevEpisode = $comic->episodes()->where('episode_number', '<', $episode->episode_number)->orderByDesc('episode_number')->first();
        $nextEpisode = $comic->episodes()->where('episode_number', '>', $episode->episode_number)->orderBy('episode_number')->first();

        return view('public.reader.show', compact('comic', 'episode', 'prevEpisode', 'nextEpisode'));
    }
}
