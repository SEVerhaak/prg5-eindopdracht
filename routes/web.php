<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicOverviewController;
use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
    return view('home.index');
})->name('welcome');

// albums route
Route::resource('/albums', \App\Http\Controllers\AlbumController::class);
// overview route
Route::resource('/overview', PublicOverviewController::class);
//genre route
Route::resource('/genres', \App\Http\Controllers\GenreEditorController::class);
// user list route
Route::resource('/users', \App\Http\Controllers\UserListController::class);

// search routes
Route::get('/search', [\App\Http\Controllers\AlbumController::class, 'search'])->name('search');
Route::get('/users/search', [\App\Http\Controllers\UserListController::class, 'search'])->name('users.search');


// for the public toggle
Route::post('/users/{id}/toggle-public', [\App\Http\Controllers\UserListController::class, 'togglePublic'])->name('users.togglePublic');

// tailwind routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
