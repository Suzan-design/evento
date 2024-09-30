<?php

namespace App\Http\Requests\Event\RequestedEvent;

use App\Http\Requests\ValidationFormRequest;

class RequestedEventRequest extends ValidationFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'adults' => 'required|integer|min:0',
            'child' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
            'venue_id' => 'nullable|exists:venues,id',
            'service_provider_id' => 'required|array',
            'service_provider_id.*' => 'required|exists:service_providers,id',
            'additional_notes' => 'nullable|string',
            'event_category_id' => 'required|exists:event_request_categories,id',
        ];
    }
}
