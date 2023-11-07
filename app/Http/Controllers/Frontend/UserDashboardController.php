<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use F9Web\Meta\Meta;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        Meta::set('title', 'Customer dashboard');

        return view('frontend.dashboard.dashboard');
    }
}
