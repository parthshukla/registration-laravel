<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {

    Route::post('register', [\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'store'])->name('register');
    
    Route::get('validate_account/{token}',[\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'validateAccount'])
        ->name('account_validation');
    
    Route::post('account/validation_token/resend',[\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'resendValidationToken'])->name('resend_account_validaiton');
    
    Route::post('account/validation_otp/resend',[\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'resendValidationOtp'])->name('resend_account_validaiton_via_otp');
    
    Route::post('validate_account_via_otp',[\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'validateAccountViaOtp'])->name('validate_account_via_otp');
        
});
