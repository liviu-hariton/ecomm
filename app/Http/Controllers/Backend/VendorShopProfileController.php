<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminVendorProfileRequest;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use F9Web\Meta\Meta;
use Illuminate\Http\Request;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Meta::set('title', 'My shop profile');

        return view('vendor.shop-profile.index', [
            'vendor' => Vendor::where('user_id', auth()->user()->id)->first()
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminVendorProfileRequest $request, Vendor $vendor)
    {
        $validated_data = $request->validated();

        if($request->hasFile('banner')) {
            if(\File::exists(public_path($vendor->banner))) {
                \File::delete(public_path($vendor->banner));
            }

            $validated_data['banner'] = $this->uploadImage($request, 'banner', 'uploads/vendors');
        }

        Vendor::where('user_id', auth()->user()->id)->update($validated_data);

        toastr('Your profile was updated successfully');

        return redirect()->route('vendor.shop-profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
