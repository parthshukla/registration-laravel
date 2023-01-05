<?php

namespace ParthShukla\Registration\Library\Application;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use ParthShukla\Registration\Events\UserEmailValidated;
use ParthShukla\Registration\Events\UserNumberValidated;
use ParthShukla\Registration\Models\AccountValidationToken;
use ParthShukla\Registration\Models\UsersOtpValidation;

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
     * Instance for UsersOtpValidation
     * @var UsersOtpValidation
     */
    protected $usersOtpValidation;

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
    public function __construct(AccountValidationToken $accountValidationToken, User $user, UsersOtpValidation $usersOtpValidation)
    {
        $this->accountValidationToken = $accountValidationToken;
        $this->user = $user;
        $this->usersOtpValidation = $usersOtpValidation;

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
        
        if(config('ps-register.tokenStoredInCache')) // token is stored in redis cache
        {
            
            $userId = Redis::get($token);
           
            if($userId) {
                // removing the key
                Redis::del($token);
            }

        }
        else // token is stored in db
        {
            
            $result = $this->accountValidationToken->activeToken(config('ps-register.userAccountValidationTokenLifeTime'))
                ->where('token', $token)->select('token', 'user_id')->first();
            $userId = ($result) ? $result->user_id : false;
            
            // disabling the token
            $this->accountValidationToken->where('token', $token)->delete();
        }
        
        if($userId)
            {
                //activating the user account
                $this->activateUserAccountViaEmail($userId);
                //sending account activation notification email
                $user = $this->user->find($userId);
                event(new UserEmailValidated($user));
                return true;
            }


        return false;
    }

    //-------------------------------------------------------------------------

     /**
     * Method to validate a user account by taken otp
     *
     * @param string $otp
     * @return bool
     */
    public function validateUserAccountViaOtp($otp):bool
    {
        
        if(config('ps-register.otpStoredInCache')) // otp is stored in redis cache
        {
            
            $userId = Redis::get($otp);
           
            if($userId) {
                // removing the key
                Redis::del($otp);
            }

        }
        else // otp is stored in db
        {
            
            $result = $this->usersOtpValidation->activeOtp(config('ps-register.userOtpLifeTime'))
                ->where('otp', $otp)
                ->select('otp', 'user_id')
                ->first();
            $userId = ($result) ? $result->user_id : false;
            
            // disabling the otp
            $this->usersOtpValidation->where('otp', $otp)->delete();
        }
        
        if($userId)
            {
                //activating the user account
                $this->activateUserAccountViaOtp($userId);
               
                //sending account activation notification email
                $user = $this->user->find($userId);
                event(new UserNumberValidated($user));
                return true;
            }


        return false;
    }




    /**
     * Method to validate a user account again
     */
    public function validateUserAccountAgain(string $token,int $userId) {
       
        if(config('ps-register.tokenStoredInCache')) // token is stored in redis cache
        {
           
            $userId = Redis::get($token);
            if($userId) {
                // removing the key
                Redis::del($token);
            }

        }
        else // token is stored in db
        {
            $result = $this->accountValidationToken->activeToken(config('ps-register.userAccountValidationTokenLifeTime'))
                ->where('token', $token)->select('token', 'user_id')->first();
            $userId = ($result) ? $result->user_id : false;
            
            // disabling the token
            $this->accountValidationToken->where('token', $token)->delete();
        }

        if($userId)
            {
                //activating the user account
                $this->activateUserAccountViaEmail($userId);
                //sending account activation notification email
                $user = $this->user->find($userId);
                //event(new UserEmailValidated($user));
                return true;
            }


        return true;

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

    //-------------------------------------------------------------------------
    /**
     * Method to set the mobile verification field and change the user account
     * status to active.
     *
     * @param int $userId
     * @return mixed
     */
    private function activateUserAccountViaOtp(int $userId){
        return $this->user->where('id', '=', $userId)
        ->update([ 'mobile_verified_at' => DB::raw('NOW()'),
            'status' => 'active']);
    }

}
// end of class Account
// end of file Account.php
