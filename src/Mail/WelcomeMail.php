<?php

namespace ParthShukla\Registration\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * RegistrationSuccess
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@hotmail.com>
 */
class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User instance
     *
     * @var User
     */
    public $user;

    //-------------------------------------------------------------------------

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ps-register::emails.registration.welcome');
    }
}
// end of class RegistrationSuccess
// end of file WelcomeMail.php
