<?php

namespace ParthShukla\Registration\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
/**
 * ValidateMobileRequest class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class ValidateMobileRequest extends FormRequest
{
    /**
     * Determine if the mobile is validate to make this request.
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
            'contact_number' => 'required|numeric',
        ];
    }
}
// end of class ValidateMobileRequest

