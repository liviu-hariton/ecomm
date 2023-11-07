<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|max:200',
            'country' => 'required|max:200',
            'state' => 'required|max:200',
            'city' => 'required|max:200',
            'address' => 'required',
            'zipcode' => 'required|max:200',
            'type' => 'required|max:200'
        ];
    }
}
