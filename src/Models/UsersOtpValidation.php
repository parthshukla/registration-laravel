<?php

namespace ParthShukla\Registration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * UsersOtpValidation model
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class UsersOtpValidation extends Model
{
    use SoftDeletes;

    /**
     * Table associated with the model
     *
     * @var string
     */
    protected $table = 'users_otp_validations';

    //-------------------------------------------------------------------------
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'status'
    ];


    //-------------------------------------------------------------------------
    /**
     * Method to disable the user validation token
     *
     * @param int $userId
     * @return mixed
     */
    public function disableUsersOtpValidation(int $userId)
    {
        return $this->where('user_id', $userId)->delete();
    }
    //-------------------------------------------------------------------------

    /**
     * Scopes a query to only include otp which are active
     *
     * @param $query
     * @param int $otpLifeTimeInSec
     * @return void
     */
    public function scopeActiveOtp($query, int $otpLifeTimeInSec)
    {
        return $query->whereRaw('UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at) <= '.$otpLifeTimeInSec);
    }
}
// end of class UsersOtpValidation
// end of file UsersOtpValidation.php
