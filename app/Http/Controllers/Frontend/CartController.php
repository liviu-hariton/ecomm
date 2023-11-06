<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

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
        $cart_data['price'] = ($product->price + $variant_price_add) * $request->qty;
        $cart_data['weight'] = 1;
        $cart_data['options']['variants'] = $variants;
        $cart_data['options']['image'] = $product->image;
        $cart_data['options']['slug'] = $product->slug;

        Cart::add($cart_data);

        return response([
            'status' => 'success',
            'message' => 'Product successfully added to cart'
        ]);
    }
}
