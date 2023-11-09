<?php

// Check if the current route matches any of the given route items and return "active" if there's a match.
function menuItemActive(array $route)
{
    foreach($route as $route_item) {
        if(request()->routeIs($route_item)) {
            return 'active';
        }
    }
}

// Return the role of the currently authenticated user or null if no user is authenticated.
function userRole()
{
    return auth()->user() ? auth()->user()->role : null;
}

// Check if a product has a discount based on specific conditions.
function productHasDiscount($data): bool
{
    // Check if the offer price is greater than 0 and if the current time is within the offer date range.
    if($data->offer_price > 0 && strtotime($data->offer_start_date) <= time() && strtotime($data->offer_end_date) >= time()) {
        return true; // The product has a discount.
    }

    return false; // No discount on the product.
}

// Calculate the percentage discount on a product based on its original price and offer price.
function computeProductDiscount($data): float
{
    // Calculate the percentage discount and round it up to the nearest whole number.
    return ceil(($data->price - $data->offer_price) / $data->price * 100);
}

// Determine the appropriate price for a product, considering whether it has a discount.
function productPrice($data)
{
    return productHasDiscount($data) ? $data->offer_price : $data->price;
}

// Calculate the subtotal of items in the shopping cart, considering quantity, price, and variant amounts of each cart item.
function cartSubtotal(): float|int
{
    $total = 0;

    $cart_items = Cart::content();

    foreach($cart_items as $cart_item) {
        // Calculate the subtotal for each cart item and accumulate the total.
        $total += ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
    }

    return $total;
}

// Calculate the total cost of items in the shopping cart, including cart discounts if applicable.
function cartTotal()
{
    $total = 0;

    $cart_items = Cart::content();

    foreach($cart_items as $cart_item) {
        // Calculate the total for each cart item and accumulate the total.
        $total += ($cart_item->price + $cart_item->options->variants_amount) * $cart_item->qty;
    }

    $cart_discount = cartDiscount();

    if($cart_discount > 0) {
        // Apply the cart discount to the total if it's greater than 0.
        $total -= $cart_discount;
    }

    return $total;
}

// Calculate the discount applied to the shopping cart based on coupons or discount codes.
function cartDiscount()
{
    $discount = 0;

    $cart_subtotal = cartSubtotal();

    if(session()->has('coupon')) {
        if(session()->get('coupon')->discount_type == 'fixed') {
            // If the coupon is of the "fixed" type, apply the fixed amount as a discount.
            $discount += session()->get('coupon')->discount_amount;
        } else {
            // If the coupon is of the "percentage" type, calculate the discount as a percentage of the cart subtotal.
            $discount += $cart_subtotal * session()->get('coupon')->discount_amount / 100;
        }
    }

    if($discount > $cart_subtotal) {
        // Ensure that the discount does not exceed the cart subtotal.
        $discount = $cart_subtotal;
    }

    return $discount;
}

// Retrieve the shipping fee from the session if a shipping method is selected, or return 0 if there's no selected method.
function cartShippingFee()
{
    return session()->has('shipping_method') ? session()->get('shipping_method')->cost : 0;
}

// Calculate the total cost of the shopping cart, including the cart total and shipping fee.
function cartTotalWithShipping()
{
    return cartTotal() + cartShippingFee();
}
