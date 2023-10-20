<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'image' => 'image|max:2048'
        ]);

        $user = auth()->user();

        if($request->hasFile('image')) {
            if(\File::exists(public_path($user->image))) {
                \File::delete(public_path($user->image));
            }

            $image = $request->image;

            $image_name = rand().'_'.$image->getClientOriginalName();

            $image->move(public_path('uploads'), $image_name);

            $path = "/uploads/".$image_name;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with(
            'success', 'Profile updated successfully!'
        );
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8'
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with(
            'success', 'Password updated successfully!'
        );
    }
}
