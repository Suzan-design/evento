<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ValidationFormRequest;

class ConfirmPaymentRequest extends ValidationFormRequest
{

    public function rules(): array
    {
        return [
            'invoice_id' => 'required|exists:invoices,external_id' ,
            'customer_phone' => [
                'required',
                'string',
                'size:12',
                'regex:/^(96394|96395|96396)[0-9]{7}$/'
            ] ,
            'code' => 'required|string|size:6',
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:bookings,id' ,
            'event_id' => 'required|exists:events,id' ,
            'promo_code_id' => 'nullable'
        ];
    }
}
