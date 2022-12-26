<?php

namespace ParthShukla\Registration\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AccountValidationToken model
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class AccountValidationToken extends Model
{
    use SoftDeletes;

    /**
     * Table associated with the model
     *
     * @var string
     */
    protected $table = 'account_validation_tokens';

    /**
     * Attribute name for the primary key
     *
     * @var null
     */
    protected $primaryKey = null;

    /**
     * Flag to signal if primary key is autoincrmenting value
     *
     * @var bool
     */
    public $incrementing = false;

    //-------------------------------------------------------------------------

    /**
     * Method to disable the user validation token
     *
     * @param int $userId
     * @return mixed
     */
    public function disableUserAccountValidationToken(int $userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    //-------------------------------------------------------------------------

    /**
     * Scopes a query to only include tokens which are active
     *
     * @param $query
     * @param int $tokenLifeTimeInSec
     * @return void
     */
    public function scopeActiveToken($query, int $tokenLifeTimeInSec)
    {
        return $query->whereRaw('UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at) <= '.$tokenLifeTimeInSec);
    }


}
// end of class AccountValidationToken
// end of file AccountValidationToken.php
