<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Helpers\ImageHelper;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    protected $post;

    public function __construct()
    {
        $this->post = new PostService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->post->pending();

        return view('post_list')->with([
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $paths = ImageHelper::uploadWithThumbnail($request->file('image'));

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['image'] = $paths['original'];
        $data['thumbnail'] = $paths['thumbnail'];

        $post = Post::create($data);

        $post->tags()->create([
            'title' => $data['tag']
        ]);

        if ($post) {
            session()->flash('success', 'Post created successfully.');
            return back();
        } else {
            session()->flash('error', 'Something wrong happened. Please try again.');
            return back()->withInput();
        }
    }

    public function accept(Post $post)
    {
        $this->post->accept($post);

        session()->flash('success', 'Successfully accepted.');
        return back();
    }

    public function reject(Post $post)
    {
        $this->post->reject($post);

        session()->flash('success', 'Successfully rejected.');
        return back();
    }

    public function archived()
    {
        $posts = $this->post->archived();

        return view('post_archived')->with([
            'posts' => $posts
        ]);
    }

    public function acceptReject()
    {
        $posts = $this->post->acceptReject();

        return view('post_accept_reject')->with([
            'posts' => $posts
        ]);
    }
}
