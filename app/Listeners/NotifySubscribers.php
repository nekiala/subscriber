<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribers implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        /** @var Post $post */
        $post = $event->post;

        // get subscribed users


    }
}
