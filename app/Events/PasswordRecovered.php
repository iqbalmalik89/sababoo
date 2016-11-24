<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\AdminUser;

class PasswordRecovered
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user;

    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}