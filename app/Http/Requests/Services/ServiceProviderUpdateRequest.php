<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderUpdateRequest extends FormRequest
{

    public function rules()
    {
        return[
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'bio_ar' => 'required|string|max:1000',
            'category_id' => 'required|integer|exists:service_categories,id',
            'location_work_governorate' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

}
