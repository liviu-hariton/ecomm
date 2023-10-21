<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SliderRequest extends FormRequest
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
            'banner' => Request::input('new-slide-form') === '1' ? 'required|image|max:2048|mimes:jpg,jpeg,png' : 'sometimes|required|image|max:2048|mimes:jpg,jpeg,png',
            'type' => 'string|max:200',
            'title' => 'required|max:200',
            'starting_price' => 'max:200',
            'btn_url' => 'url',
            'sort_order' => 'required|integer',
            'status' => 'required'
        ];
    }
}
