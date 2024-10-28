<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('welcome');

Route::resource('/albums', \App\Http\Controllers\AlbumController::class);
Route::resource('/overview', \App\Http\Controllers\OverviewController::class);


Route::get('/search', [\App\Http\Controllers\AlbumController::class, 'search'])->name('search');
Route::get('/users/search', [\App\Http\Controllers\UserListController::class, 'search'])->name('users.search');
Route::get('/overview/search', [\App\Http\Controllers\OverviewController::class, 'search'])->name('overview.search');
Route::get('/overview/cheese', [\App\Http\Controllers\OverviewController::class, 'cheese'])->name('overview.cheese');

Route::post('/users/{id}/toggle-public', [\App\Http\Controllers\UserListController::class, 'togglePublic'])->name('users.togglePublic');


Route::resource('/users', \App\Http\Controllers\UserListController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
