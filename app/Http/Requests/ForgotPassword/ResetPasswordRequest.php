<?php

namespace App\Http\Requests\ForgotPassword;

use App\Http\Requests\ValidationFormRequest;

class ResetPasswordRequest extends ValidationFormRequest
{

    public function rules(): array
    {
        return [
            'old_password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/', // Must contain at least one letter and one number
            ], 'new_password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/', // Must contain at least one letter and one number
            ],
        ];
    }
}
