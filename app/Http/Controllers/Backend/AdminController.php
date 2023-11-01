<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function changeStatus(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->status = $request->status;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Status has been successfully updated!'
        ]);
    }

    public function changeFeatured(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->featured = $request->featured;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Status has been successfully updated!'
        ]);
    }

    public function changeApproved(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->approved = $request->approved;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Status has been successfully updated!'
        ]);
    }

    public function changeDefault(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $model::where('product_variant_id', $request->vid)->update(['is_default' => 0]);

        $object = $model::findOrFail($request->id);
        $object->is_default = $request->is_default;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Item has been successfully set as default!'
        ]);
    }

    public function changeHomeCarousel(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->home_carousel = $request->home_carousel;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Item status in flash sale home carousel updated!'
        ]);
    }

    public function changeAttribute(Request $request) {
        $model = str_replace("^", "\\", $request->model);

        $object = $model::findOrFail($request->id);
        $object->{$request->attribute} = $request->enabled;
        $object->save();

        return response([
            'status' => 'success',
            'message' => 'Attribute has been successfully updated!'
        ]);
    }
}
