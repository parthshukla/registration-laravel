<?php

namespace ParthShukla\Registration\Library\Application;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use ParthShukla\Registration\Events\UserEmailValidated;
use ParthShukla\Registration\Models\AccountValidationToken;

/**
 * Account class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class Account
{
    /**
     * Instance for AccountValidationToken
     *
     * @var AccountValidationToken
     */
    protected $accountValidationToken;

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
     * @param AccountValidationToken $accountValidationToken
     * @param User $user
     */
    public function __construct(AccountValidationToken $accountValidationToken, User $user)
    {
        $this->accountValidationToken = $accountValidationToken;
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    /**
     * Method to validate a user account
     *
     * @param string $token
     * @return bool
     */
    public function validateUserAccount(string $token):bool
    {
        $result = $this->accountValidationToken->activeToken(config('ps-register.userAccountValidationTokenLifeTime'))
            ->where('token', $token)->select('token', 'user_id')->first();

        if($result)
        {
            // disabling the token
            $this->accountValidationToken->where('token', $token)->delete();
            //activating the user account
            $this->activateUserAccountViaEmail($result->user_id);
            //sending account activation notification email
            $user = $this->user->find($result->user_id);
            event(new UserEmailValidated($user));
            return true;
        }
        return false;
    }

    //-------------------------------------------------------------------------

    /**
     * Method to set the email verification field and change the user account
     * status to active.
     *
     * @param int $userId
     * @return mixed
     */
    private function activateUserAccountViaEmail(int $userId)
    {
        return $this->user->where('id', '=', $userId)
                ->update([ 'email_verified_at' => DB::raw('NOW()'),
                    'status' => 'active']);
    }

}
// end of class Account
// end of file Account.php
