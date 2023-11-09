<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PayPalSettings;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index()
    {
        if(!session()->has('shipping_method') || !session()->has('shipping_address')) {
            return redirect()->route('user.checkout');
        }

        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    private function paypalSettings()
    {
        $paypal_settings = PayPalSettings::first();

        return [
            'mode'    => $paypal_settings->mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => $paypal_settings->client_id,
                'client_secret'     => $paypal_settings->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypal_settings->client_id,
                'client_secret'     => $paypal_settings->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $paypal_settings->currency,
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
        ];
    }

    /**
     * @throws \Throwable
     */
    public function payWithPaypal()
    {
        $paypal_settings = PayPalSettings::first();

        $paypal_config = $this->paypalSettings();

        $provider = new PayPalClient($paypal_config);
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $paypal_config['currency'],
                        "value" => round((cartTotalWithShipping() * $paypal_settings->currency_rate), 2),
                    ]
                ],
            ],
        ]);

        if(!is_null($response['id'])) {
            return redirect()->away($response['links'][1]['href']);
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    /**
     * @throws \Throwable
     */
    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient($this->paypalSettings());
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if($response['status'] == 'COMPLETED') {
            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr()->error('Payment cancelled!');

        return redirect()->route('user.payment');
    }
}
