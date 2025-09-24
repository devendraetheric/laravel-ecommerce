<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name'              => ['required', 'string', 'max:50'],
            'country_id'        => ['required'],
            'contact_name'      => ['required', 'string', 'max:60'],
            'phone'             => ['required'],
            'address_line_1'    => ['required', 'string', 'max:50'],
            'address_line_2'    => ['nullable', 'string', 'max:50'],
            'city'              => ['required', 'string', 'max:50'],
            'zip_code'          => ['required', 'string', 'max:10'],
            'state_id'          => ['required'],
            'is_default'        => ['required', 'boolean'],
        ];
    }
}
