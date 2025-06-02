<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaypalService
{
    public bool $isLive = false;

    public $baseUrl = '';

    public ?string $clientId = '';

    public ?string $clientSecret = '';

    /**
     * Create a new class instance.
     */
    public function __construct()
    {

        $this->isLive = setting('payment_paypal.is_live');
        $this->clientId = setting('payment_paypal.client_id');
        $this->clientSecret = setting('payment_paypal.client_secret');

        $this->baseUrl  = $this->isLive
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }

    public function initiatePayment(array $data)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->post("{$this->baseUrl}/v2/checkout/orders",  [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    // "reference_id" => $data['order_id'],
                    [
                        'amount' => [
                            'currency_code' => $data['currency'],
                            'value' => $data['amount'],
                        ],
                    ]
                ],
                'payment_source' => [
                    'paypal' => ['experience_context' => [
                        'return_url' => $data['redirect_url'],
                        'cancel_url' => $data['redirect_url']
                    ]]
                ]
            ]);
        // dd($response->json());

        return $response->json()['links'][1]['href'];
    }

    public function captureOrder(string $orderId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)

            ->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture", [
                'order_id' => $orderId
            ]);

        if ($response->created()) {
            return $response->json();
        }

        throw new \Exception('Unable to capture PayPal order: ' . $response->body());
    }

    public function getAccessToken()
    {
        $response = Http::asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Unable to retrieve PayPal access token: ' . $response->body());
    }
}
