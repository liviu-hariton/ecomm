<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PayPalSettings;
use App\Models\StripeSettings;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $paypal_settings = null;
        $stripe_settings = null;

        return view('admin.payment-settings.index', [
            'paypal_settings' => PayPalSettings::first() ?? $paypal_settings,
            'stripe_settings' => StripeSettings::first() ?? $stripe_settings
        ]);
    }
}
