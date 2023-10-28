<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminVendorProfileRequest;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Vendor $vendor)
    {
        return view('admin.vendor.index', [
            'vendor' => $vendor->load('user.user')->find(1)
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
    public function store(AdminVendorProfileRequest $request)
    {

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

        toastr('Vendor profile updated successfully');

        return redirect()->route('admin.vendor-profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
