<?php

namespace App\Http\Controllers\Backend;

use AllowDynamicProperties;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $validated_data = $request->validated();

        if($request->hasFile('banner')) {
            $validated_data['banner'] = $this->uploadImage($request, 'banner', 'uploads');
        }

        Slider::create($validated_data);

        toastr('Slide created successfully');

        return redirect()->route('admin.slider.index');
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
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $validated_data = $request->validated();

        if($request->hasFile('banner')) {
            if(\File::exists(public_path($slider->banner))) {
                \File::delete(public_path($slider->banner));
            }

            $validated_data['banner'] = $this->uploadImage($request, 'banner', 'uploads');
        }

        $slider->update($validated_data);

        toastr('Slide updated successfully');

        return redirect()->route('admin.slider.edit', $slider);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
