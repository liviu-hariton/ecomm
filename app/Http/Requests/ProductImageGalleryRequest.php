<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductImageGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'images.*' => Request::input('new-image-form') === '1' ? 'required|image|max:2048|mimes:jpg,jpeg,png' : 'sometimes|required|image|max:2048|mimes:jpg,jpeg,png',
            'title' => 'sometimes|max:200',
            'alt' => 'sometimes|max:200',
            'product_id' => 'sometimes|required|integer',
            'vendor_id' => 'sometimes|required|integer',
            'sort_order' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer'
        ];
    }
}
