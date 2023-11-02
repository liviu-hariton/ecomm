<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRuleRequest;
use App\Models\ShippingRule;
use Illuminate\Http\Request;

class ShippingRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingRuleRequest $request)
    {
        $validated_data = $request->validated();

        ShippingRule::create($validated_data);

        toastr('Shipping rule created successfully');

        return redirect()->route('admin.shipping-rules.index');
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
    public function edit(ShippingRule $shippingRule)
    {
        return view('admin.shipping-rule.edit', [
            'shippingRule' => $shippingRule
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRuleRequest $request, ShippingRule $shippingRule)
    {
        $validated_data = $request->validated();

        $shippingRule->update($validated_data);

        toastr('Shipping rule updated successfully');

        return redirect()->route('admin.shipping-rules.edit', $shippingRule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRule $shippingRule)
    {
        $shippingRule->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.shipping-rules.index');
        }
    }
}
