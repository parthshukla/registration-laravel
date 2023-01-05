<?php

namespace ParthShukla\Registration\Listeners;

use Illuminate\Support\Facades\Mail;
use ParthShukla\Registration\Mail\NumberVerified;

/**
 * SendNumberVerifiedMail
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class SendNumberVerifiedMail
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
    public function handle($event)
    {
        Mail::to($event->user->email)->send(new NumberVerified($event->user));
    }
}
// end of class SendNumberVerifiedMail
// end of file SendNumberVerifiedMail.php
