<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\TitipTulisan;

class TitipTulisanStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $titipTulisan;

    /**
     * Create a new event instance.
     */
    public function __construct(TitipTulisan $titipTulisan)
    {
        $this->titipTulisan = $titipTulisan;
    }
}
