<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicNotificationRequest extends ValidationFormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:organizer,venue,event',
            'organizer_id' => 'required_if:type,organizer|nullable|exists:organizers,id',
            'venue_id' => 'required_if:type,venue|nullable|exists:venues,id',
            'event_id' => 'required_if:type,event|nullable|exists:events,id',
        ];
    }
}
