<?php
namespace App\Http\Controllers\api;

use App\Http\Requests\OtpVerify\generateRequest;
use App\Http\Requests\OtpVerify\OtpVerifyAccountRequest;
use App\Services\api\OtpService;
use Illuminate\Http\Request;

class AuthOtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function generate(generateRequest $request)
    {
        $verificationCode = $this->otpService->generateOtp($request->phone_number);

        return response()->json([
            'status' => true , 
            'otp' => $verificationCode
        ]);
    }

    public function OtpVerifyAccount(Request $request)
    {
        $response = $this->otpService->verifyOtp($request->phone_number, $request->otp);

        return response()->json([
            'status' => $response['status'],
            'token' => $response['message']
        ]);
    }

}
