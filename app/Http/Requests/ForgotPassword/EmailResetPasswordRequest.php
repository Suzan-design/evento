<?php

namespace App\Http\Requests\ForgotPassword;


use App\Http\Requests\ValidationFormRequest;

class EmailResetPasswordRequest extends ValidationFormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|exists:reset_code_passwords,code',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/', // Must contain at least one letter and one number
            ],
            'phone_number' => 'required | exists:mobile_users,phone_number'
        ];
    }
}
