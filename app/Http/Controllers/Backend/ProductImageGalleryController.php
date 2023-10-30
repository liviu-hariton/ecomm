<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageGalleryRequest;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageGalleryController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail(\request()->pid);

        $this->authorize('view', $product);

        return $dataTable->render(userRole().'.product.image-gallery.index', [
            'product' => $product,
            'vendor' => auth()->user()->vendor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageGalleryRequest $request)
    {
        $validated_data = $request->validated();

        File::ensureDirectoryExists(public_path().'/uploads/products/'.$request->product_id);

        $paths = $this->uploadMultipleImages($request, 'images', 'uploads/products/'.$request->product_id);

        foreach($paths as $path) {
            $validated_data['image'] = $path;

            ProductImageGallery::create($validated_data);
        }

        toastr('Image(s) uploaded successfully');

        return redirect()->route(userRole().'.image-gallery.index', [
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
    public function edit(ProductImageGallery $imageGallery)
    {
        $this->authorize('view', $imageGallery);

        return view(userRole().'.product.image-gallery.edit', [
            'image_gallery' => $imageGallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductImageGalleryRequest $request, ProductImageGallery $imageGallery)
    {
        $validated_data = $request->validated();

        if($request->hasFile('image')) {
            if(\File::exists(public_path($imageGallery->image))) {
                \File::delete(public_path($imageGallery->image));
            }

            $validated_data['image'] = $this->uploadImage($request, 'banner', 'uploads/products/'.$imageGallery->product_id);
        }

        $imageGallery->update($validated_data);

        toastr('Slide updated successfully');

        return redirect()->route(userRole().'.image-gallery.edit', $imageGallery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImageGallery $imageGallery)
    {
        $pid = $imageGallery->product_id;

        if(!is_null($imageGallery->image)) {
            $this->deleteImage($imageGallery->image);
        }

        $imageGallery->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route(userRole().'.image-gallery.index', ['pid' => $pid]);
        }
    }
}
