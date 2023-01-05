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

    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     * 
     */
    public $otp;

    //-------------------------------------------------------------------------

    /**
     * Create a new message instance
     *
     * @param User $user
     * @param string|null $token
     */
    public function __construct(User $user, string $token=null, $otp=null )
    {
        $this->user = $user;
        $this->token = $token;
        $this->otp = $otp;
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
