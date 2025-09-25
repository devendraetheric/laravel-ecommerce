<?php

namespace App\Http\Requests\Admin\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'code'               => ['required', 'string'],
            'description'        => ['nullable'],
            'type'               => ['required'],
            'value'              => ['required', 'numeric'],
            'start_date'         => ['required'],
            'end_date'           => ['required'],
            'total_quantity'     => ['required', 'numeric'],
            'use_per_user'       => ['required', 'numeric'],
            'max_discount_value' => ['required', 'numeric'],
            'min_cart_value'     => ['required', 'numeric'],
            'max_cart_value'     => ['required', 'numeric'],
            'is_for_new_user'    => ['required'],
        ];
    }
}
