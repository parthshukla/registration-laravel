<?php

namespace ParthShukla\Registration\Library\Application;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use ParthShukla\Registration\Events\UserRegistered;

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

    /**
     * Instance of TokenGenerator
     *
     * @var TokenGenerator
     */
    protected $tokenGenerator;

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param User $user
     * @param TokenGenerator $tokenGenerator
     */
    public function __construct(User $user, TokenGenerator $tokenGenerator)
    {
        $this->user = $user;
        $this->tokenGenerator = $tokenGenerator;
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
        //getting the user account validation token
        $accountValidationToken = $this->tokenGenerator->getUserAccountVerificationToken($this->user->id);
        // sending mail to the user
        event(new UserRegistered($this->user, $accountValidationToken));
        return true;        
    }

    //-------------------------------------------------------------------------

    /**
     * Sends account validation token via email
     * 
     * @var array $data
     * @return boolean
     */
    public function getAccountValidationToken(array $data) :bool
    {

        $user = $this->user->where('email', '=', $data['email'])->first();

        if($user->status == 'pending') {
            $accountValidationToken = $this->tokenGenerator->getUserAccountVerificationToken($user->id);
            event(new UserRegistered($user, $accountValidationToken));
            return true;
        }

        return false;
    } 
}
// end of class UserAccountWriter
// end of file UserAccountWriter.php
