<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\ValidationFormRequest;

class CalculateInvoiceAmountRequest extends ValidationFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'class_id' => 'required|exists:event_classes,id',
                'promo_code_id' =>  'nullable|exists:event_promo_code,promo_code_id|exists:user_promo_code,promo_code_id',
                'options.*' => 'nullable|exists:class_amenity,amenity_id|exists:amenity_event,amenity_id' ,
                'event_id' => 'required|exists:events,id'
            ];
    }
}
