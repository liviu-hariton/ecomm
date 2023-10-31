<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.home', [
            'top_slides' => Slider::where('status', 1)->orderBy('sort_order')->get(),
            'flash_sale' => FlashSale::with('carouselItems')->find(1)
        ]);
    }
}
