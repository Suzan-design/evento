<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ValidationFormRequest;

class ResellTicketRequest extends ValidationFormRequest
{

    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:bookings,id' ,
            'user_id' => 'required|exists:mobile_users,id'
        ];
    }
}
