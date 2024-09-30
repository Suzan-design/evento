<?php

namespace App\Http\Requests\Venue;

use Illuminate\Foundation\Http\FormRequest;

class VenueUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Static rules for other fields
        return  [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'capacity' => 'required|integer|min:0',
            'governorate' => 'required',
            'location_description' => 'required|string|max:1000',
            'location_description_ar' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|max:25',
            'description' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
