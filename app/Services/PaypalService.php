<?php

namespace App\Services;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalService
{
    /**
     * @var PayPalClient
     */
    private $provider;

    public function __construct(PayPalClient $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function createOrder($value)
    {
        $this->setApiCredentials();
        $response = $this->provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.after'),
                "cancel_url" => route('checkouts.index'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $value
                    ]
                ]
            ]
        ]);

        return $response;
    }

    /**
     * @param string $token
     *
     * @return mixed
     */
    public function capturePaymentOrder($token)
    {
        $this->setApiCredentials();
        return $this->provider->capturePaymentOrder($token);
    }

    /**
     * @param array $links
     *
     * @return string|null
     */
    public function findApproveLink($links)
    {
        foreach ($links as $link) {
            if ($link['rel'] == 'approve') {
                return $link['href'];
            }
        }

        return null;
    }

    /**
     * @return void
     */
    public function setApiCredentials()
    {
        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->getAccessToken();
    }

    /**
     * @param array $cart
     *
     * @return string
     */
    public function calculateTotalAmount($cart)
    {
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item->course->discounted_price;
        }

        return number_format($totalAmount, 2);
    }
}
