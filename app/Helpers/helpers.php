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
    return auth()->user()->role;
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
