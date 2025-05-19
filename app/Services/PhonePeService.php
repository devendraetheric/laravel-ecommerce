<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PhonePeService
{
    public bool $isLive = false;

    public $auth_url = '';

    public $payment_url = '';

    public ?string $clientId = '';

    public ?string $clientSecret = '';

    public int $clientVersion = 1;

    public function __construct()
    {

        $this->isLive = config('phonepe.is_live');
        $this->clientId = config('phonepe.client_id');
        $this->clientSecret = config('phonepe.client_secret');
        $this->clientVersion = config('phonepe.client_version');

        $this->auth_url = $this->isLive ? 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token' : 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token';

        $this->payment_url = $this->isLive ? 'https://api.phonepe.com/apis/pg/checkout/v2/pay' : 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay';
    }

    public function initiatePayment(array $data)
    {

        $authResponse = $this->authorize();

        $payload = [
            'merchantOrderId' => $data['order_id'],
            'amount' => $data['amount'], // in paise
            'paymentFlow' => [
                'type' => 'PG_CHECKOUT',
                "message" => "Payment for " . $data['order_id'],
                "merchantUrls" => [
                    "redirectUrl" => $data['redirect_url']
                ],
                "paymentModeConfig" => [
                    "enabledPaymentModes" => [
                        [
                            "type" => "UPI_INTENT"
                        ],
                        [
                            "type" => "UPI_COLLECT"
                        ],
                        [
                            "type" => "UPI_QR"
                        ],
                        [
                            "type" => "NET_BANKING"
                        ],
                        [
                            "type" => "CARD",
                            "cardTypes" => [
                                "DEBIT_CARD",
                                "CREDIT_CARD"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => "O-Bearer " . $authResponse['access_token'],
        ])->post($this->payment_url, $payload);

        return $response->object()->redirectUrl;
    }

    public function checkStatus(string $orderId)
    {
        $authResponse = $this->authorize();

        $url = $this->isLive ? "https://api.phonepe.com/apis/pg/checkout/v2/order/$orderId/status" : "https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/$orderId/status";

        $response = Http::acceptJson()->withHeaders([
            'Authorization' => "O-Bearer " . $authResponse['access_token'],
        ])->get($url);

        return $response->json();
    }

    public function authorize()
    {
        try {
            $response = Http::asForm()->post(
                $this->auth_url,
                [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'client_version' => $this->clientVersion,
                    'grant_type' => 'client_credentials'
                ]
            );

            return $response->json();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
