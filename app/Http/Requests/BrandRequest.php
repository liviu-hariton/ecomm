<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BrandRequest extends FormRequest
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
            'slug' => Request::input('new-brand-form') === "1" ? 'required|max:200|unique:brands,slug' : 'required|max:200|unique:brands,slug,'.$this->route('brand')->id,
            'logo' => Request::input('new-brand-form') === '1' ? 'required|image|max:2048|mimes:jpg,jpeg,png' : 'sometimes|required|image|max:2048|mimes:jpg,jpeg,png',
            'icon' => 'sometimes|required',
            'status' => 'required',
            'featured' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => \Str::slug($this->slug)
        ]);
    }
}
