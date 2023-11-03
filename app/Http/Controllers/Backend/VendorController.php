<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminVendorProfileRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use F9Web\Meta\Meta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    use ImageUploadTrait;

    public function dashboard()
    {
        Meta::set('title', 'Seller dashboard');

        return view('vendor.dashboard.dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(VendorDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Meta::set('title', 'Create seller profile');

        return view('admin.vendor.create', [
            'users' => User::whereDoesntHave('vendor')->where('role', 'not like', 'user')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminVendorProfileRequest $request)
    {
        $validated_data = $request->validated();

        if($request->hasFile('banner')) {
            $validated_data['banner'] = $this->uploadImage($request, 'banner', 'uploads/vendors');
        }

        Vendor::create($validated_data);

        toastr('Vendor created successfully');

        return redirect()->route('admin.vendor.index');
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
    public function edit(Vendor $vendor)
    {
        Meta::set('title', 'Update seller profile');

        return view('admin.vendor.edit', [
            'vendor' => $vendor
        ]);
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

        $vendor->where('id', $vendor->id)->update($validated_data);

        toastr('Vendor updated successfully');

        return redirect()->route('admin.vendor.edit', $vendor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
