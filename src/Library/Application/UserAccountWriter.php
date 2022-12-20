<?php

namespace ParthShukla\Registration\Library\Application;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use ParthShukla\Registration\Events\UserRegistered;
use ParthShukla\Registration\Mail\WelcomeMail;

/**
 * UserAccountWriter class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class UserAccountWriter
{
    /**
     * Instance of User
     *
     * @var User
     */
    protected $user;

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    /**
     * Saves the user information in the database.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // initializing the information to be saved
        $this->user->name = $data['name'];
        $this->user->email = $data['email'];
        $this->user->password = Hash::make($data['password']);
        $this->user->gender = empty($data['gender']) ? null : $data['gender'];
        $this->user->date_of_birth = empty($data['dob']) ? null : $data['dob'];
        // saving the updated information
        $this->user->save();
        // sending mail to the user
        event(new UserRegistered($this->user));//Mail::to($this->user->email)->send(new WelcomeMail($this->user));
        return true;
    }

}
// end of class UserAccountWriter
// end of file UserAccountWriter.php
