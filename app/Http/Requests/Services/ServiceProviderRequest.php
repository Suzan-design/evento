<?php

namespace App\Http\Requests\Services;

use App\Http\Requests\ValidationFormRequest;

class ServiceProviderRequest extends ValidationFormRequest
{

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'bio_ar' => 'required|string|max:1000',
            'category_id' => 'required|exists:service_categories,id',
            'location_work_governorate' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];

        if($this->request->get('albums')) {
            foreach($this->request->get('albums') as $key => $val) {
                $rules['albums.'.$key.'.name'] = 'required|string|max:255';
                $rules['albums.'.$key.'.images.*'] = 'image|mimes:jpeg,png,jpg,gif,svg';
                $rules['albums.'.$key.'.videos.*'] = 'mimes:mp4,mov,avi,flv|max:20480'; // Example for video validation
            }
        }

        return $rules;
    }

}
