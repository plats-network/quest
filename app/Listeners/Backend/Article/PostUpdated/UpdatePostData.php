<?php

namespace App\Listeners\Backend\Article\PostUpdated;

use App\Events\Backend\Article\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdatePostData implements ShouldQueue
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
    public function handle(PostUpdated $event)
    {
        $post = $event->post;

        Log::debug('Listeners: UpdatePostData');
    }
}
