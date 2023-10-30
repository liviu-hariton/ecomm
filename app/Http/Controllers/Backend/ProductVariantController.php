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
        $product = Product::findOrFail(\request()->pid);

        $this->authorize('view', $product);

        return $dataTable->render(userRole().'.product.variant.index', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->pid);

        $this->authorize('view', $product);

        return view(userRole().'.product.variant.create', [
            'product' => $product
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

        return redirect()->route(userRole().'.variant.index', [
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
        $this->authorize('view', $variant);

        return view(userRole().'.product.variant.edit', [
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

        return redirect()->route(userRole().'.variant.edit', $variant);
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

            return redirect()->route(userRole().'.variant.index', [
                'pid' => $pid
            ]);
        }
    }
}
