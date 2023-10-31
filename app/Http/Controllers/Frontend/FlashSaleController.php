<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        return view('frontend.pages.flash-sales', [
            'flash_sale' => FlashSale::find(1),
            'flash_sale_items' => FlashSale::find(1)->carouselItems()->paginate(12)
        ]);
    }
}
