<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Slider;
use App\Traits\SettingsTrait;
use F9Web\Meta\Meta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SettingsTrait;

    public function __construct()
    {
        Meta::set('title', $this->generalSettings('meta_title'))
            ->set('description', $this->generalSettings('meta_description'));
    }

    public function index()
    {
        return view('frontend.home.home', [
            'top_slides' => Slider::where('status', 1)->orderBy('sort_order')->get(),
            'flash_sale' => FlashSale::with('carouselItems')->find(1)
        ]);
    }
}
