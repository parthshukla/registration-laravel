<?php
namespace ParthShukla\Registration\Listeners;

use Illuminate\Support\Facades\Mail;
use ParthShukla\Registration\Events\UserRegistered;
use ParthShukla\Registration\Mail\WelcomeMail;

/**
 * SendWelcomeMail listener class.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@hotmail.com>
 */
class SendWelcomeMail
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
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
// end of class SendWelcomeMail
// end of file SendWelcomeMail.php
