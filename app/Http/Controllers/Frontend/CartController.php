<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if($product->qty === 0) {
            return response([
                'status' => 'out_of_stock',
                'message' => 'Product os out of stock'
            ]);
        }

        if($request->qty > $product->qty) {
            return response([
                'status' => 'qty_unavailable',
                'message' => 'There is insufficient stock for this product!'
            ]);
        }

        $variants = [];
        $variant_price_add = 0;

        if($request->has('variant')) {
            foreach($request->variant as $variant_id=>$variant_item_id) {
                $variant_item = ProductVariantItem::find($variant_item_id);

                $variants[$variant_item->product_variant->name]['name'] = $variant_item->name;
                $variants[$variant_item->product_variant->name]['price'] = $variant_item->price;

                $variant_price_add += $variant_item->price;
            }
        }

        if(productHasDiscount($product)) {
            $product->price = productPrice($product);
        }

        $cart_data = [];
        $cart_data['id'] = $product->id;
        $cart_data['name'] = $product->name;
        $cart_data['qty'] = $request->qty;
        $cart_data['price'] = $product->price;
        $cart_data['weight'] = 1;
        $cart_data['options']['variants'] = $variants;
        $cart_data['options']['variants_amount'] = $variant_price_add;
        $cart_data['options']['image'] = $product->image;
        $cart_data['options']['slug'] = $product->slug;

        Cart::add($cart_data);

        return response([
            'status' => 'success',
            'message' => 'Product successfully added to cart',
            ...$this->cartSummaryResponse()

        ]);
    }

    public function cartSummaryResponse()
    {
        return [
            'cart_subtotal' => $this->cartSubTotal(),
            'cart_total' => $this->cartTotal(),
            'cart_count' => Cart::content()->count(),
            'cart_sidebar_products' => $this->cartSidebarProducts(),
            'cart_discount' => $this->cartDiscount()
        ];
    }

    public function cartDetails()
    {
        return view('frontend.pages.cart-details', [
            'items' => Cart::content()
        ]);
    }

    public function updateProductQty(Request $request)
    {
        $product = Product::findOrFail(Cart::get($request->cart_id)->id);

        if($product->qty === 0) {
            return response([
                'status' => 'out_of_stock',
                'message' => 'Product os out of stock'
            ]);
        }

        if($request->qty > $product->qty) {
            return response([
                'status' => 'qty_unavailable',
                'message' => 'There is insufficient stock for this product!'
            ]);
        }

        Cart::update($request->cart_id, $request->qty);

        return response([
            'status' => 'success',
            'message' => 'Product quantity successfully updated',
            'product_total' => $this->cartProductTotal($request->cart_id),
            ...$this->cartSummaryResponse()
        ]);
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->cart_id);

        return response([
            'status' => 'success',
            'message' => 'Product successfully deleted from cart',
            ...$this->cartSummaryResponse()
        ]);
    }

    public function cartSubTotal()
    {
        $total = 0;

        $cart_items = Cart::content();

        foreach($cart_items as $cart_item) {
            $total += ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
        }

        return $total;
    }

    public function cartTotal()
    {
        $total = $this->cartSubTotal();

        $cart_discount = $this->cartDiscount();

        if($cart_discount > 0) {
            $total -= $cart_discount;
        }

        return $total;
    }

    public function cartProductTotal($cart_id)
    {
        $cart_item = Cart::get($cart_id);

        return ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
    }

    public function cartDiscount()
    {
        $discount = 0;

        $cart_subtotal = $this->cartSubTotal();

        if(session()->has('coupon')) {
            if(session()->get('coupon')->discount_type === 'fixed') {
                $discount += session()->get('coupon')->discount_amount;
            } else {
                $discount += $cart_subtotal * session()->get('coupon')->discount_amount / 100;

            }
        }

        if($discount > $cart_subtotal) {
            $discount = $cart_subtotal;
        }

        return $discount;
    }

    public function clearCart()
    {
        Cart::destroy();

        session()->forget('coupon');

        return response([
            'status' => 'success',
            'message' => 'Cart cleared successfully!'
        ]);
    }

    public function clearCoupon()
    {
        session()->forget('coupon');

        return response([
            'status' => 'success',
            'message' => 'Coupon cleared successfully!',
            ...$this->cartSummaryResponse()
        ]);
    }

    public function cartSidebarProducts()
    {
        $output = '';

        $cart_items = Cart::content();

        if(Cart::content()->count() > 0) {
            foreach($cart_items as $cart_item) {
                $output .= \Illuminate\Support\Facades\View::make('components.products.cart-sidebar')
                    ->with('item', $cart_item)
                    ->render();
            }
        } else {
            $output = '<li>Your cart is empty</li>';
        }

        return $output;
    }

    public function applyCoupon(Request $request)
    {
        if(!$request->coupon_code) {
            return response([
                'status' => 'error',
                'message' => 'Please provide a coupon code'
            ]);
        }

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon) {
            return response([
                'status' => 'error',
                'message' => 'The coupon is not active or does not exists!'
            ]);
        }

        if($coupon->start_date > date('Y-m-d H:i:s') || $coupon->end_date < date('Y-m-d H:i:s')) {
            return response([
                'status' => 'warning',
                'message' => 'The coupon is not active yet or has expired!'
            ]);
        }

        if($coupon->usages > $coupon->qty) {
            return response([
                'status' => 'warning',
                'message' => 'The coupon cannot be used anymore!'
            ]);
        }

        session(['coupon' => $coupon]);

        return response([
            'status' => 'success',
            'message' => 'Coupon applied successfully!',
            ...$this->cartSummaryResponse()
        ]);
    }
}
