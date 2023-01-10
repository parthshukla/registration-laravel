<?php

namespace ParthShukla\Registration\Library\Application;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use ParthShukla\Registration\Models\UsersOtpValidation;

class OtpGenerator
{

    /**
     * Instance of UsersOtpValidation class
     *
     * @var UsersOtpValidation
     */
    protected $UsersOtpValidation;

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param UsersOtpValidation $UsersOtpValidation
     */
    public function __construct(UsersOtpValidation $UsersOtpValidation)
    {
        $this->UsersOtpValidation = $UsersOtpValidation;
    }

    //-------------------------------------------------------------------------

     /**
     * Generate random number for otp
     */
     private function otpGenerator($otpLength) {
        $digits = $otpLength;
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
     }
    //-------------------------------------------------------------------------

    /**
     * Saves and returns the otp for validating a user account.
     *
     * @param int $userId
     * @return string
     */
    public function getAccountVerificationOtp(int $userId)
    {
        // creating account otp 
        $otp = $this->otpGenerator(4);

        if(config('ps-register.otpStoredInCache')) // otp to be stored in redis cache
        {
            Redis::set($otp, $userId, 'EX', config('ps-register.userOtpLifeTime'));
        }
        else { // otp to be stored in db

            // disabling any previously generated active otp
            $this->UsersOtpValidation->disableUsersOtpValidation($userId);

            // adding a new otp
            $this->UsersOtpValidation->otp = $otp;
            $this->UsersOtpValidation->user_id = $userId;
            $this->UsersOtpValidation->save();
            //return $otp;
        }

        return $otp;
    }
       
}
// end of class OtpGenerator
// end of file OtpGenerator.php
