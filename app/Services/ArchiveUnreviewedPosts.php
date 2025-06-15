<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Post;

class ArchiveUnreviewedPosts
{
    /**
     * Create a new class instance.
     */
    public function __invoke()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        $posts = Post::where('created_at', '<=', $threeDaysAgo)->get();

        foreach($posts as $post){
            $post->status = "Archived";
            $post->save();
        }
    }
}
