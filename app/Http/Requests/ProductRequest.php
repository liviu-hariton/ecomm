<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:200',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:200',
            'slug' => Request::input('new-product-form') === "1" ? 'required|max:200|unique:products,slug' : 'required|max:200|unique:products,slug,'.$this->route('product')->id,
            'image' => Request::input('new-product-form') === '1' ? 'required|image|max:2048|mimes:jpg,jpeg,png' : 'sometimes|required|image|max:2048|mimes:jpg,jpeg,png',
            'video_link' => 'nullable|url',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'price' => 'required|decimal:2',
            'qty' => 'required|integer',
            'short_description' => 'required',
            'long_description' => 'required',
            'sku' => 'required',
            'offer_price' => 'decimal:2|lt:price',
            'offer_start_date' => 'date|before_or_equal:offer_end_date',
            'offer_end_date' => 'date|after_or_equal:offer_start_date',
            'is_top' => 'nullable|integer',
            'is_best' => 'nullable|integer',
            'is_featured' => 'nullable|integer',
            'approved' => 'sometimes|required',
            'status' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => \Str::slug($this->slug),
            'sku' => \Str::of($this->sku)->slug()->upper()
        ]);
    }
}
