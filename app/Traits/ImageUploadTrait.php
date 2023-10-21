<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUploadTrait {
    public function uploadImage(Request $request, $inputName, $path) {
        if($request->hasFile($inputName)) {
            $image = $request->{$inputName};

            $extension = $image->getClientOriginalExtension();
            $image_name = $inputName.'_'.uniqid().'.'.$extension;

            $image->move(public_path($path), $image_name);

            return $path.'/'.$image_name;
        }
    }
}
