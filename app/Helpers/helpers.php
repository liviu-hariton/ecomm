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
