<?php

namespace ParthShukla\Registration\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * UserNumberValidated
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@ahex.co.in>
 */
class UserNumberValidated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Instance of User
     * @var User
     */
    public $user;

    //-------------------------------------------------------------------------

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
// end of class UserNumberValidated
// end of file UserNumberValidated.php
