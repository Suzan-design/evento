<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function my_promo_code()
    {
        $user = Auth::user();
        $promoCodes = $user->promoCodes()->with('events:title,title_ar')->get();
        return response()->json([
            'status' => true,
            'promoCodes' => $promoCodes,
        ]);
    }

    public function my_promo_code_booking($event_id)
    {
        $id = Auth::guard('mobile')->id();
        $promoCode = PromoCode::whereHas('users', function ($q) use ($id) {
            $q->where('mobile_user_id', $id);
        })->whereHas('events', function ($q) use ($event_id) {
            $q->where('event_id', $event_id);
        })->get();

        return response()->json([
            'status' => true ,
            'promoCode' => $promoCode
        ]);
    }
}

