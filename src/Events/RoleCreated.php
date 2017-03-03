<?php

namespace Story\Cms\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Story\Cms\Models\Role;
use Illuminate\Http\Request;

class RoleCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $role;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Role $role, Request $request)
    {
        $this->role = $role;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('role-created');
    }
}
