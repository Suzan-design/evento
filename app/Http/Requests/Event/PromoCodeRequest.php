<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image', // Assuming the image column contains the file path
            'code' => 'required|string|unique:promo_codes,code', // Replace 'your_table_name' with the actual table name
            'discount' => 'required|integer',
            'limit' => 'required|integer',
            'start-date' => 'required',
            'end-date' => 'required|after:start-date',
        ];
    }
}
