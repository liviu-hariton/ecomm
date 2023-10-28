<?php

namespace App\Http\Requests;

use App\Rules\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminVendorProfileRequest extends FormRequest
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
            'banner' => 'sometimes|image|max:2048|mimes:jpg,jpeg,png',
            'phone' => ['required', new PhoneValidation],
            'email' => 'required|email',
            'address' => 'required|max:200',
            'facebook' => 'url',
            'instagram' => 'url',
            'twitter' => 'url',
            'description' => 'sometimes',
            'shop_name' => 'required|max:200',
        ];
    }
}
