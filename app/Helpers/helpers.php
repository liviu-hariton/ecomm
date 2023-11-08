<?php

function menuItemActive(array $route)
{
    foreach($route as $route_item) {
        if(request()->routeIs($route_item)) {
            return 'active';
        }
    }
}

function userRole()
{
    return auth()->user() ? auth()->user()->role : null;
}

function productHasDiscount($data): bool
{
    if($data->offer_price > 0 && strtotime($data->offer_start_date) <= time() && strtotime($data->offer_end_date) >= time()) {
        return true;
    }

    return false;
}

function computeProductDiscount($data): float
{
    return ceil(($data->price - $data->offer_price) / $data->price * 100);
}

function productPrice($data)
{
    return productHasDiscount($data) ? $data->offer_price : $data->price;
}

function cartSubtotal()
{
    $total = 0;

    $cart_items = Cart::content();

    foreach($cart_items as $cart_item) {
        $total += ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
    }

    return $total;
}

function cartTotal()
{
    $total = 0;

    $cart_items = Cart::content();

    foreach($cart_items as $cart_item) {
        $total += ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
    }

    $cart_discount = cartDiscount();

    if($cart_discount > 0) {
        $total -= $cart_discount;
    }

    return $total;
}

function cartDiscount()
{
    $discount = 0;

    $cart_subtotal = cartSubtotal();

    if(session()->has('coupon')) {
        if(session()->get('coupon')->discount_type == 'fixed') {
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
