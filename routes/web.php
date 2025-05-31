<?php

use App\Http\Controllers\PostController;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
    $tags = Tag::orderBy('title', 'asc')->pluck('title', 'id');

    return view('welcome')->with([
        'categories' => $categories,
        'tags' => $tags
    ]);
});

Route::post('/store', [PostController::class, 'store'])->name('post.store');
