<?php

namespace App\Http\Requests\Organizer;

use App\Http\Requests\ValidationFormRequest;

class OrganizerRequest extends ValidationFormRequest
{

    public function rules()
    {
        $rules =  [
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'covering_area' => 'required|string|max:1000',
            'other_category' => 'nullable|string|max:255',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_ids' => 'required|array',
            'category_ids.*' => 'required|exists:event_categories,id',
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
