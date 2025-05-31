<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Helpers\ImageHelper;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $paths = ImageHelper::uploadWithThumbnail($request->file('image'));

        $data = $request->validated();
        $data['user_id'] = 2;
        $data['image'] = $paths['original'];
        $data['thumbnail'] = $paths['thumbnail'];

        $post = Post::create($data);

        if ($post) {
            session()->flash('success', 'Post created successfully.');
            return back();
        } else {
            session()->flash('error', 'Something wrong happened. Please try again.');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
