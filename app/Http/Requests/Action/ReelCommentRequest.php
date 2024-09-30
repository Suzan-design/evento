<?php

namespace App\Http\Requests\Action;

use App\Http\Requests\ValidationFormRequest;

class ReelCommentRequest extends ValidationFormRequest
{
    public function rules(): array
    {
        return [
            'body' => 'required|string'
        ];
    }
}
