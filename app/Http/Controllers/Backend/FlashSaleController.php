<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $temp_date = new stdClass();
        $temp_date->end_date = date('Y-m-d 23:59', time() + 60 * 60 * 24 * 10);

        return $dataTable->render('admin.flash-sale.index', [
            'flash_sale' => FlashSale::first() ?? $temp_date,
            'products' => Product::whereDoesntHave('flashSale')->active()->approved()->get()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'end_date' => 'required|date'
        ]);

        FlashSale::updateOrCreate(
            ['id' => '1'],
            ['end_date' => $request->end_date]
        );

        toastr('Flash sale end date updated successfully');

        return redirect()->route('admin.flash-sale.index');
    }

    public function addProducts(Request $request)
    {
        $validated_data = $request->validate([
            'products' => 'required'
        ]);

        foreach($request->products as $product) {
            FlashSaleItem::create([
                'flash_sale_id' => '1',
                'product_id' => $product,
                'status' => 1
            ]);
        }

        toastr('Flash sale products added successfully');

        return redirect()->route('admin.flash-sale.index');
    }

    public function removeProduct(Request $request)
    {
        FlashSaleItem::where('id', $request->fiid)->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item removed successfully from flash sale!'
            ]);
        } else {
            toastr('Item removed successfully from flash sale!');

            return redirect()->route('admin.flash-sale.index');
        }
    }
}
