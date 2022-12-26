<?php

namespace ParthShukla\Registration\Library\Application;

use Illuminate\Support\Str;
use ParthShukla\Registration\Models\AccountValidationToken;

class TokenGenerator
{

    /**
     * Instance of AccountValidation class
     *
     * @var AccountValidationToken
     */
    protected $accountValidationToken;

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param AccountValidationToken $accountValidationToken
     */
    public function __construct(AccountValidationToken $accountValidationToken)
    {
        $this->accountValidationToken = $accountValidationToken;
    }

    //-------------------------------------------------------------------------

    /**
     * Saves and returns the token for validating a user account.
     *
     * @param int $userId
     * @return string
     */
    public function getUserAccountVerificationToken(int $userId)
    {
        // creating account verificaiton token
        $token = sha1(Str::uuid()->toString());

        // disabling any previously generated active token
        $this->accountValidationToken->disableUserAccountValidationToken($userId);

        // adding a new token
        $this->accountValidationToken->token = $token;
        $this->accountValidationToken->user_id = $userId;
        $this->accountValidationToken->save();
        return $token;
    }
}
// end of class TokenGenerator
// end of file TokenGenerator.php
