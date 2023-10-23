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
}
