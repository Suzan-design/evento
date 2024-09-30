<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ValidationFormRequest;

class BookingRequest extends ValidationFormRequest
{

    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'class_id' => 'required|exists:event_classes,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer|min:0',
            'phone_number' => 'required|string',
            'options' => 'nullable|array',
            'options.*' => 'exists:amenities,id',
            'promo_code_id' => 'nullable|integer',
            //'customer_phone'  => [
            //    'required',
             //   'string',
             //   'size:12',
            //    'regex:/^(96394|96395|96396)[0-9]{7}$/'
            //] ,
            'offer_id' => 'nullable|exists:offers,id'
        ];
    }
}
