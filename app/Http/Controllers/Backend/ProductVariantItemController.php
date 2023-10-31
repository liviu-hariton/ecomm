<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariantItemRequest;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $itemDataTable)
    {
        $variant = ProductVariant::with('product')->findOrFail(\request()->vid);

        $this->authorize('view', $variant);

        return $itemDataTable->render(userRole().'.product.variant.item.index', [
            'variant' => $variant,
        ]);
    }

    public function create(Request $request)
    {
        $variant = ProductVariant::with('product')->findOrFail($request->vid);

        $this->authorize('view', $variant);

        return view(userRole().'.product.variant.item.create', [
            'variant' => $variant,
        ]);
    }

    public function store(ProductVariantItemRequest $request, ProductVariantItem $productVariantItem)
    {
        $validated = $request->validated();

        if(isset($validated['is_default']) && $validated['is_default'] === '1') {
            $productVariantItem::where('product_variant_id', $request->product_variant_id)->update(['is_default' => 0]);
        }

        $productVariantItem::create($validated);

        toastr('Product variant item created successfully');

        return redirect()->route(userRole().'.item.index', [
            'vid' => $request->product_variant_id
        ]);
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(ProductVariantItem $item)
    {
        $this->authorize('view', $item);

        return view(userRole().'.product.variant.item.edit', [
            'variant_item' => $item
        ]);
    }

    public function update(ProductVariantItemRequest $request)
    {
        $validated = $request->validated();

        if(isset($validated['is_default']) && $validated['is_default'] === '1') {
            ProductVariantItem::where('product_variant_id', $request->product_variant_id)->update(['is_default' => 0]);
        }

        $productVariantItem = ProductVariantItem::findOrFail($request->id);
        $productVariantItem->update($validated);

        toastr('Product variant updated successfully');

        return redirect()->route(userRole().'.item.edit', $productVariantItem);
    }

    public function destroy(ProductVariantItem $item)
    {
        $vid = $item->product_variant_id;

        $item->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route(userRole().'.item.index', [
                'vid' => $vid
            ]);
        }
    }
}
