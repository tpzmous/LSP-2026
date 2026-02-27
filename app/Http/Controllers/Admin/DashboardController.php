<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;
use App\Models\Episode;

class DashboardController extends Controller
{
    public function index()
    {
        $comicCount = Comic::count();
        $episodeCount = Episode::count();
        $recentComics = Comic::latest()->take(5)->get();

        return view('admin.dashboard', compact('comicCount', 'episodeCount', 'recentComics'));
    }
}
