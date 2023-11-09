<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PayPalSettings;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Cart;

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

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function storeOrder($data)
    {
        $general_settings = Settings::first();

        $cart_total = cartTotalWithShipping();

        $order_data = [
            'invoice_id' => rand(100000, 9999999),
            'user_id' => auth()->user()->id,
            'subtotal' => cartSubTotal(),
            'amount' => $cart_total,
            'currency_name' => $general_settings->currency_name,
            'currency_icon' => $general_settings->currency_icon,
            'product_qty' => Cart::content()->count(),
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_status'],
            'order_address' => json_encode(session()->get('shipping_address')),
            'shipping_method' => json_encode(session()->get('shipping_method')),
            'coupon' => json_encode(session()->get('coupon')),
            'order_status' => 0,
        ];

        Order::create($order_data);

        $order_id = Order::latest()->first()->id;

        foreach(Cart::content() as $item) {
            $product = Product::find($item->id);

            $order_product = [
                'order_id' => $order_id,
                'product_id' => $product->id,
                'vendor_id' => $product->vendor_id,
                'product_name' => $product->name,
                'variants' => json_encode($item->options->has('variants') ? $item->options->variants : []),
                'variant_total' => $item->options->has('variants_amount') ? $item->options->variants_amount : 0,
                'unit_price' => $item->price,
                'qty' => $item->qty,
            ];

            OrderProduct::create($order_product);
        }

        $transaction_data = [
            'order_id' => $order_id,
            'transaction_id' => $data['transaction_id'],
            'payment_method' => $data['payment_method'],
            'amount' => $cart_total,
            'amount_real_currency' => $data['paid_amount'],
            'amount_real_currency_name' => $data['paid_currency'],
        ];

        Transaction::create($transaction_data);
    }

    public function clearSession()
    {
        Cart::destroy();

        session()->forget(['shipping_method', 'shipping_address', 'coupon']);
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
        $paypal_settings = PayPalSettings::first();

        $provider = new PayPalClient($this->paypalSettings());
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if($response['status'] == 'COMPLETED') {
            $data = [
                'payment_method' => 'PayPal',
                'payment_status' => 1,
                'transaction_id' => $response['id'],
                'paid_amount' => round((cartTotalWithShipping() * $paypal_settings->currency_rate), 2),
                'paid_currency' => $paypal_settings->currency
            ];

            $this->storeOrder($data);

            $this->clearSession();

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
