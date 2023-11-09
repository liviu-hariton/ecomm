<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if(Cart::content()->count() === 0) {
            return redirect()->route('cart');
        }

        return view('frontend.pages.checkout', [
            'addresses' => UserAddress::where('user_id', auth()->id())->get(),
            'shipping_rules' => ShippingRule::all()
        ]);
    }

    public function checkoutSubmit(Request $request)
    {
        $request->validate([
            'shipping_method_id' => 'required|integer',
            'shipping_address_id' => 'required|integer'
        ]);

        $shipping_rule = ShippingRule::findOrFail($request->shipping_method_id);
        $shipping_address = UserAddress::findOrFail($request->shipping_address_id);

        if($shipping_rule) {
            session()->put('shipping_method', $shipping_rule);
        }

        if($shipping_address) {
            session()->put('shipping_address', $shipping_address);
        }

        return response([
            'status' => 'success',
            'redirect_url' => route('user.payment')
        ]);
    }
}
