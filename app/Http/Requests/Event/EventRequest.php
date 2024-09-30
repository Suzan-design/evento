<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TotalTicketNumber;

class EventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:event_categories,id',
            'venue_id' => 'required|exists:venues,id',
            'capacity' => 'required|integer|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'ticket_price' => 'required|numeric|min:0',
            'description' => 'required|string|max:2000',
            'amenity' => 'nullable|array',
            'amenity.*.price' => 'required_with:amenity.*|numeric|min:0',
            'amenity.*.description' => 'nullable|string|max:1000',
            'classes' => ['required', 'array', new TotalTicketNumber($this->input('capacity'))],
            'classes.*.code' => 'required|string|max:255',
            'classes.*.description' => 'required|string|max:255',
            'classes.*.description_ar' => 'required|string|max:255',
            'classes.*.ticket_number' => 'required|numeric|min:1',
            'classes.*.ticket_price' => 'required|numeric|min:0',
            'classes.*.amenity_ids' => 'nullable|array',
            'service_providers' => 'nullable|array',
            'service_providers.*' => 'exists:service_providers,id',
            'event_trips' => 'nullable|array',
            'event_trips.*.start_date' => 'required_with:event_trips.*|date|after_or_equal:today',
            'event_trips.*.end_date' => 'required_with:event_trips.*|date|after_or_equal:event_trips.*.start_date',
            'event_trips.*.description' => 'nullable|string|max:1000',
            'organizer_id' => 'required|exists:organizers,id',
            'images' => 'required|array',
            'images.*' => 'image',
            'app_taxes_type' => 'required|in:amount,percent',
            'app_taxes' => 'required|numeric|min:0',
            'ecash_taxes' => 'required|numeric|min:0',
            'website' => 'nullable|url',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'refund_policy' => 'required|string',
            'cancellation_time' => 'required|integer',
            'cancellation_policy' => 'required|string',
            'refund_policy_ar' => 'required|string',
            'cancellation_policy_ar' => 'required|string',
        ];
    }
}
