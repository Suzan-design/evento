<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ValidationFormRequest;

class CancelBookingRequest extends ValidationFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reason' => 'required|max:900' ,
            'id' => 'required'
        ];
    }
}
