<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
        $addressValidation = [
            'address.contact_name'      => ['required', 'string', 'max:255'],
            'address.email'             => ['required', 'email', 'max:255'],
            'address.phone'             => ['required', 'string', 'max:20'],
            'address.country_id'        => ['required', 'exists:countries,id'],
            'address.address_line_1'    => ['required', 'string', 'max:255'],
            'address.address_line_2'    => ['nullable', 'string', 'max:255'],
            'address.city'              => ['required', 'string', 'max:100'],
            'address.state_id'          => ['required', 'exists:states,id'],
            'address.zip_code'          => ['required', 'numeric', 'digits_between:4,10'],
        ];

        $validation = [
            'payment_method' => ['required'],
            'notes'          => ['nullable', 'string']
        ];

        if (Auth::check()) {
            $validation['address_id'] = ['required'];
        } else {
            $validation = array_merge($validation, $addressValidation);
        }

        return $validation;
    }
}
