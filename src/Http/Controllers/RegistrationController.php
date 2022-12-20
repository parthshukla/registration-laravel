<?php

namespace ParthShukla\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ParthShukla\Registration\Http\Requests\RegistrationRequest;
use ParthShukla\Registration\Library\Application\UserAccountWriter;

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

    //-------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param UserAccountWriter $userAccountWriter
     */
    public function __construct(UserAccountWriter $userAccountWriter)
    {
        $this->userAccountWriter = $userAccountWriter;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
// end of class RegistrationController
// end of file RegistrationController.php
