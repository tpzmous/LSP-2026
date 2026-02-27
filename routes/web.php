<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ComicController as AdminComicController;
use App\Http\Controllers\Admin\EpisodeController as AdminEpisodeController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ComicController as PublicComicController;
use App\Http\Controllers\Public\ReaderController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/comics', [PublicComicController::class, 'index'])->name('comic.index');
Route::get('/comic/{id}', [PublicComicController::class, 'show'])->name('comic.show');
Route::get('/comic/{comic}/episode/{episode}', [ReaderController::class, 'read'])->name('reader.show');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('comics', AdminComicController::class);
    Route::resource('comics.episodes', AdminEpisodeController::class)->shallow();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
