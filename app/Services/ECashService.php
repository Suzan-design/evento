<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use function NunoMaduro\Collision\Exceptions\getMessage;

class ECashService{

    public function generateVerificationCode($merchantId, $merchantSecret, $amount, $OrderRef) {
        return strtoupper(md5($merchantId . $merchantSecret . $amount . $OrderRef));
    }
    
        
    public function checkoutWithECash($amount, $bookingId)
    {
        //$orderRef = uniqid(); // Generate a unique order reference
        
        //$amount = $amount;
        //dd(env('ECASH_REDIRECT_URL'));
        $verificationCode = $this->generateVerificationCode(env('ECASH_MERCHANT_ID'), env('ECASH_MERCHANT_SECRET'), $amount, $bookingId);
    
        $checkoutUrl = sprintf(
    "%sCheckout/Card/%s/%s/%s/SYP/%s/EN/%s/%s/%s",
    env('ECASH_CHECKOUT_URL'),
    env('ECASH_TERMINAL_KEY'),
    env('ECASH_MERCHANT_ID'),
    $verificationCode,
    $amount,
    $bookingId,
    urlencode(env('ECASH_REDIRECT_URL')),
    urlencode(env('ECASH_CALLBACK_URL'))
);

    
    
    //ddenv('ECASH_CALLBACK_URL');
        return $checkoutUrl;
    }
    
    public function getBearerToken()
    {
        $client = new Client();
        $response = $client->post('https://login.ecash-pay.com/connect/token', [
            'form_params' => [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'grant_type' => 'password',
                'scope' => 'TransactionManagementService',
                'username' => env('USERNAME'),
                'password' => 'C+!#(nuFe3m*U$fz',
            ]
        ]);
    
        return json_decode((string) $response->getBody(), true);
    }
    
    public function reverseTransaction($transactionNo)
    {
        $tokenData = $this->getBearerToken();
        $client = new Client();
        $response = $client->post('https://api.ecash-pay.com/api/transaction-management-service/Public/MerchantTransaction/ReverseTransaction', [
            'headers' => [
                'Authorization' => 'Bearer ' . $tokenData['access_token'],
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'TransactionNo' => $transactionNo,
            ]
        ]);
    
        return $response->getStatusCode() == 204 ? true : false;
    }

}