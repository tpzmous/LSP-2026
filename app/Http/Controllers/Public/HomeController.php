<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comic;

class HomeController extends Controller
{
    public function index()
    {
        $comics = Comic::where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('public.home', compact('comics'));
    }
}
