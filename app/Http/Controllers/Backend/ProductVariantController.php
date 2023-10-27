<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable)
    {
        return $dataTable->render('admin.product.variant.index', [
            'product' => Product::findOrFail(\request()->pid),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.product.variant.create', [
            'product' => Product::findOrFail(\request()->pid)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|max:200',
            'status' => 'required|integer'
        ]);

        $validated_data['vendor_id'] = auth()->user()->vendor->id;

        ProductVariant::create($validated_data);

        toastr('Product variant created successfully');

        return redirect()->route('admin.variant.index', [
            'pid' => $request->product_id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $variant)
    {
        return view('admin.product.variant.edit', [
            'variant' => $variant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $variant)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:200',
            'status' => 'required|integer'
        ]);

        $variant->update($validated_data);

        toastr('Product variant updated successfully');

        return redirect()->route('admin.variant.edit', $variant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $variant)
    {
        $pid = $variant->product_id;

        ProductVariantItem::where('product_variant_id', $variant->id)->delete();

        $variant->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.variant.index', [
                'pid' => $pid
            ]);
        }
    }
}
