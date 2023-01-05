<?php
namespace ParthShukla\Registration\Listeners;

use Illuminate\Support\Facades\Mail;
use ParthShukla\Registration\Events\UserOtpEvent;
use ParthShukla\Registration\Events\UserRegistered;
use ParthShukla\Registration\Mail\OtpMail;

/**
 * SendOtpMail listener class.
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@hotmail.com>
 */
class SendOtpMail
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
    public function handle(UserOtpEvent $event)
    {
        Mail::to($event->user->email)->send(new OtpMail($event->user,$event->otp));
    }
}
// end of class SendOtpMail
// end of file SendOtpMail.php
