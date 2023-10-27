<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.product.create', [
            'categories_tree' => (new CategoryController)->categoriesTree(
                selected: [$request->category_id]
            ),
            'brands' => Brand::all(),
            'sku' => Str::of(Str::random(6))->upper()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated_data = $request->validated();

        if($request->hasFile('image')) {
            $validated_data['image'] = $this->uploadImage($request, 'image', 'uploads/products');
        }

        $validated_data['vendor_id'] = auth()->user()->vendor->id;

        Product::create($validated_data);

        toastr('Product created successfully');

        return redirect()->route('admin.product.index');
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
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'categories_tree' => (new CategoryController)->categoriesTree(
                selected: [$product->category_id]
            ),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated_data = $request->validated();

        if($request->hasFile('image')) {
            if(\File::exists(public_path($product->image))) {
                \File::delete(public_path($product->image));
            }

            $validated_data['image'] = $this->uploadImage($request, 'image', 'uploads/products');
        }

        $product->update($validated_data);

        toastr('Product updated successfully');

        return redirect()->route('admin.product.edit', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if(!is_null($product->image)) {
            $this->deleteImage($product->image);
        }

        $images = ProductImageGallery::where('product_id', $product->id)->get();

        if(count($images) > 0) {
            foreach($images as $image) {
                $this->deleteImage($image->image);

                $image->delete();
            }

            File::deleteDirectory(public_path('uploads/products/'.$product->id));
        }

        ProductVariant::where('product_id', $product->id)->delete();
        ProductVariantItem::where('product_id', $product->id)->delete();

        $product->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.product.index');
        }
    }
}
