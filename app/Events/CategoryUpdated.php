<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Category;

class CategoryUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category;
    public $action; // created, updated, deleted

    /**
     * Create a new event instance.
     */
    public function __construct(Category $category, $action = 'updated')
    {
        $this->category = $category;
        $this->action = $action;
    }
}
