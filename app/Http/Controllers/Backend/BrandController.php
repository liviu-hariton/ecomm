<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $validated_data = $request->validated();

        if($request->hasFile('logo')) {
            $validated_data['logo'] = $this->uploadImage($request, 'logo', 'uploads');
        }

        Brand::create($validated_data);

        toastr('Brand created successfully');

        return redirect()->route('admin.brand.index');
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
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $validated_data = $request->validated();

        if($request->hasFile('banner')) {
            if(\File::exists(public_path($brand->banner))) {
                \File::delete(public_path($brand->banner));
            }

            $validated_data['logo'] = $this->uploadImage($request, 'logo', 'uploads');
        }

        $brand->update($validated_data);

        toastr('Brand updated successfully');

        return redirect()->route('admin.brand.edit', $brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if(!is_null($brand->logo)) {
            $this->deleteImage($brand->logo);
        }

        $brand->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.brand.index');
        }
    }
}
