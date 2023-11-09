<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSettings;
use Illuminate\Http\Request;

class StripeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'client_id' => 'required',
            'secret_key' => 'required',
            'status' => 'required|integer',
            'mode' => 'required',
            'country' => 'required|max:200',
            'currency' => 'required|max:200',
            'currency_rate' => 'required|decimal:2',
        ]);

        StripeSettings::updateOrCreate(
            ['id' => $id],
            $validated_data
        );

        toastr('Stripe settings updated successfully');

        return redirect()->route('admin.payment-settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
