<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
    //return redirect()->route('about-us');
})->name('welcome');

/*
Route::get('/products/{name}', function ($name) {
    return view('product.show', ['product' => $name]);
})->name('product.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
*/

Route::resource('/products', ProductController::class);

Route::resource('/tests', \App\Http\Controllers\TestsController::class);

Route::resource('/upload', \App\Http\Controllers\UploadController::class);

Route::resource('/overview', \App\Http\Controllers\overviewController::class);


Route::get('/about-us/{id}', function(?string $id = null) {
    return view('about-us',
        [
            'user_id' => $id
        ]);
})->whereNumber('id');

Route::get('/secret', [\App\Http\Controllers\secret::class, 'secret'])->name('secret');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
