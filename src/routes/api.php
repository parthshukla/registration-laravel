<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {

    Route::post('register', [\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'store'])->name('register');
    Route::get('validate_account/{token}',[\ParthShukla\Registration\Http\Controllers\RegistrationController::class, 'validateAccount'])
        ->name('account_validation');
});
