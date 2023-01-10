<?php

return [
    //token
    'userAccountValidationTokenLifeTime' => env('USER_ACCOUNT_VALIDATION_TOKEN_LIFETIME',600),
    'tokenStoredInCache' => false,
    
    //otp
    'userOtpLifeTime' => env('USER_OTP_LIFETIME',600),
    'otpStoredInCache'=> false

];
// end of file config.php
