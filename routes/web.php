<?php

use App\Http\Controllers\PostController;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $categories = Category::pluck('title', 'id');
    $tags = Tag::pluck('title', 'id');

    return view('dashboard')->with([
        'categories' => $categories,
        'tags' => $tags
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/store', [PostController::class, 'store'])->name('post.store');
});

Route::get('/admin/dashboard', [PostController::class, 'index'])->name('post.index');
Route::get('/accept/{post}', [PostController::class, 'accept'])->name('post.accept');
Route::get('/reject/{post}', [PostController::class, 'reject'])->name('post.reject');
Route::get('/accept-reject', [PostController::class, 'acceptReject'])->name('post.accept.reject');
Route::get('/archived', [PostController::class, 'archived'])->name('post.archived');


require __DIR__ . '/auth.php';
