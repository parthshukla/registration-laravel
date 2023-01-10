<?php

namespace ParthShukla\Registration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * RegistrationRequest class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:127|unique:users,email',
            'password' => ['required','confirmed',
                            Password::min(8)->letters()
                                ->mixedCase()->numbers()
                                ->symbols()],
            'name' => 'required|max:255',
            'dob' => 'nullable|date_format:Y-m-d',
            'gender' => 'nullable|in:male,female,other',
            'contact_number'=>'required|numeric|min:10'
        ];
    }
}
// end of class RegistrationRequest
// end of file RegistrationRequest.php
