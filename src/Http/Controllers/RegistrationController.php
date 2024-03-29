<?php

namespace ParthShukla\Registration\Http\Controllers;

use Illuminate\Http\Response;
use ParthShukla\Registration\Http\Requests\RegistrationRequest;
use ParthShukla\Registration\Http\Requests\ValidateEmailRequest;
use ParthShukla\Registration\Http\Requests\ValidateMobileRequest;
use ParthShukla\Registration\Http\Requests\ValidateOtpRequest;
use ParthShukla\Registration\Library\Application\Account;
use ParthShukla\Registration\Library\Application\UserAccountWriter;
use Illuminate\Http\Request;

/**
 * Registration class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class RegistrationController extends Controller
{

    /**
     * UserAccountWriter instance
     *
     * @var UserAccountWriter
     */
    protected $userAccountWriter;

    /**
     * Instance of Account
     *
     * @var Account
     */
    protected $account;

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param UserAccountWriter $userAccountWriter
     * @param Account $account
     */
    public function __construct(UserAccountWriter $userAccountWriter, Account $account)
    {
        $this->userAccountWriter = $userAccountWriter;
        $this->account = $account;
    }

    //-------------------------------------------------------------------------

    /**
     * Handles request for registering a new user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function store(RegistrationRequest $request)
    {
        
        if($this->userAccountWriter->create($request->validated()))
        {
            return response(['message' => __('ps-register::general.account_created_success')],
                    Response::HTTP_CREATED);
        }

        return response(['message' => __('ps-register::general.account_created_failed')],
                        Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    //-------------------------------------------------------------------------

    /**
     * Method to handle request for validating a user account.
     *
     * @param string $token
     * @return void
     */
    public function validateAccount(string $token)
    {
        if($this->account->validateUserAccount($token))
        {
            return response(['message' => __('ps-register::general.account_validation_success')], Response::HTTP_OK);
        }
        return response(['message' => __('ps-register::general.account_validation_failed')], Response::HTTP_BAD_REQUEST);
    }


    //-------------------------------------------------------------------------

    /**
     * Handles request for sending the otp
     * 
     * @var ValidateOtpRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function validateAccountViaOtp(ValidateOtpRequest $request)
    {
         
        if($this->account->validateUserAccountViaOtp($request->validated()))
        {
            return response(['message' => __('ps-register::general.account_validation_success')], Response::HTTP_OK);
        }
        return response(['message' => __('ps-register::general.account_validation_failed')], Response::HTTP_BAD_REQUEST);

    }


    //-------------------------------------------------------------------------

    /**
     * Handles request for sending the validation token
     * 
     * @var ValidateEMailRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function resendValidationToken(ValidateEmailRequest $request) {
        
        if($this->userAccountWriter->getAccountValidationToken($request->validated()))
        {
            return response(['message' => __('ps-register::general.account_validataion_link')], Response::HTTP_OK);
        }
        return response(['message' => __('ps-register::general.resend_account_validation_link_failed')], Response::HTTP_BAD_REQUEST);
    }

    //-------------------------------------------------------------------------

    /**
     * Handle request for sending otp
     * @var ValidateMobileRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function resendValidationOtp(ValidateMobileRequest $request) {
        
        if($this->userAccountWriter->getAccountValidationOtp($request->validated()))
        {
            return response(['message' => __('ps-register::general.otp_send_success')], Response::HTTP_OK);
        }
        return response(['message' => __('ps-register::general.resend_account_validation_link_failed')], Response::HTTP_BAD_REQUEST);
    }

}
// end of class RegistrationController
// end of file RegistrationController.php
