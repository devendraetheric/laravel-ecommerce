<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RazorpayService
{

    public $baseUrl = '';

    public ?string $clientId = '';

    public ?string $clientSecret = '';

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->clientId = setting('payment_razorpay.client_id');
        $this->clientSecret = setting('payment_razorpay.client_secret');

        $this->baseUrl = 'https://api.razorpay.com';
    }

    public function initiatePayment(array $data)
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->baseUrl}/v1/payment_links",  [
                'currency' => $data['currency'],
                'amount' => $data['amount'],
                // "reference_id" => $data['order_id'],
                'accept_partial' => false,
                'callback_url' => $data['redirect_url'],
                "callback_method" => "get"
            ]);

        return $response->json()['short_url'];
    }

    public function checkStatus(string $razorpay_payment_id)
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->get("{$this->baseUrl}/v1/payments/{$razorpay_payment_id}");

        return $response->json();
    }
}
