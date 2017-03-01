<?php

namespace Story\Cms\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Story\Cms\Models\Post;
use Illuminate\Http\Request;

class PostUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, Request $request)
    {
        $this->post = $post;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post-created');
    }
}
