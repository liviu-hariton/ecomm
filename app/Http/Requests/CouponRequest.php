<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|unique:coupons',
            'qty' => 'required|integer',
            'max_use' => 'required|integer',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_type' => 'required',
            'discount_amount' => 'required|decimal:2',
            'status' => 'required|integer'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => \Str::of($this->code)->slug()->upper()
        ]);
    }
}
