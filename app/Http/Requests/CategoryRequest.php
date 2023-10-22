<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
            'parent_id' => Request::input('new-category-form') === "1" ? 'nullable' : 'nullable|not_in:'.$this->route('category')->id,
            'name' => 'required|max:200',
            'slug' => Request::input('new-category-form') === "1" ? 'required|max:200|unique:categories,slug' : 'required|max:200|unique:categories,slug,'.$this->route('category')->id,
            'icon' => 'sometimes|required',
            'status' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => \Str::slug($this->slug)
        ]);
    }

    public function messages(): array
    {
        return [
            'parent_id.not_in' => 'The category cannot be it\'s own parent'
        ];
    }
}
