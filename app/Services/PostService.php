<?php

namespace App\Services;

use App\Models\Post;
use App\Notifications\Approval;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Rejection;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function pending()
    {
        return Post::with('category', 'tags')->where('status', 'Pending')->get();
    }

    public function archived()
    {
        return Post::with('category', 'tags')->where('status', 'Archived')->get();
    }

    public function acceptReject()
    {
        return Post::with('category', 'tags')->whereIn('status', ['Accepted', 'Rejected'])->orderBy('status', 'asc')->get();
    }

    public function accept($post)
    {
        $this->sendApproveNotification($post);

        $post->status = 'Accepted';
        $post->save();
    }

    public function reject($post)
    {
        $this->sendRejectNotification($post);

        $post->status = 'Rejected';
        $post->save();
    }

    public function sendApproveNotification($post)
    {
        Notification::send($post->user, new Approval($post));
    }

    public function sendRejectNotification($post)
    {
        Notification::send($post->user, new Rejection($post));
    }
}
