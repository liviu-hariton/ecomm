<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\SettingsTrait;
use F9Web\Meta\Meta;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use SettingsTrait;

    public function show(Product $product)
    {
        $product_data = $product->load([
            'category', 'brand', 'vendor', 'images', 'variants'
        ]);

        Meta::set('title', $product_data->meta_title ? $product_data->meta_title : $product_data->nme)
            ->set('description', $product_data->meta_description ? $product_data->meta_description : $product_data->short_description);

        return view('frontend.pages.product', [
            'product' => $product_data
        ]);
    }
}
