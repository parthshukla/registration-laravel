<?php

namespace ParthShukla\Registration\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * UserRegistered event class.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@ahex.co.in>
 */
class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Instance of the user
     *
     * @var User
     */
    public $user;

    /**
     * User account validation token
     * 
     * @var string|null
     */
    public $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token = null, $otp = null)
    {
        $this->user  = $user;
        $this->token = $token;
        $this->otp   = $otp;
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
// end of class UserRegistered
// end of file UserRegistered.php
