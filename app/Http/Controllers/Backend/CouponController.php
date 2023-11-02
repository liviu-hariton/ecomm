<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $validated_data = $request->validated();

        Coupon::create($validated_data);

        toastr('Coupon created successfully');

        return redirect()->route('admin.coupons.index');
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
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $validated_data = $request->validated();

        $coupon->update($validated_data);

        toastr('Coupon updated successfully');

        return redirect()->route('admin.coupons.edit', $coupon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.coupons.index');
        }
    }
}
