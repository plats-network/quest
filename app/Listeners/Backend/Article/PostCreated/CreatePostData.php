<?php

namespace App\Listeners\Backend\Article\PostCreated;

use App\Events\Backend\Article\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CreatePostData implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        Log::debug('Listeners: CreatePostData');
    }
}
