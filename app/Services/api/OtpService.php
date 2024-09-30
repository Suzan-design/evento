<?php


namespace App\Services\api;


use App\Models\User\MobileUser;
use App\Models\User\OtpVerificationCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class OtpService
{
    public function generateOtp($phoneNumber)
    {
        $otp = rand(1234, 9999) ;
        $trimmedNumber = ltrim($phoneNumber, '0');
        //$response = Http::get('https://bms.syriatel.sy/API/SendTemplateSMS.aspx?user_name=Evento&password=Pp@123123&template_code=Evento_t1&param_list='.$otp.'&sender=Evento.App.&to=963'.$trimmedNumber);

        return OtpVerificationCode::create([
            'phone_number' => $phoneNumber,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function verifyOtp($phone_number, $otp)
    {
        $verificationCode = OtpVerificationCode::where('phone_number', $phone_number)->where('otp', $otp)->first();

        if (!$verificationCode) {
            return ['status' => false, 'message' => 'Your OTP is not correct'];
        }

        if (Carbon::now()->isAfter($verificationCode->expire_at)) {
            $verificationCode->delete();
            return ['status' => false, 'message' => 'Your OTP has been expired'];
        }

        $user = MobileUser::where('phone_number' , $phone_number);
        $user->update(['is_verified' => true]);
        $verificationCode->delete();

        $user = $user->first() ;
        $token = $user->createToken('Api Token')->plainTextToken  ;

        return ['status' => true, 'message' => $token];
    }
}
