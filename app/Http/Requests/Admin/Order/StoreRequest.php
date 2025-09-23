<?php

namespace App\Http\Requests\Admin\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'order_number'   => ['required', 'string', 'max:255', Rule::unique(Order::class)],
            'order_date'     => ['required'],
            'status'         => ['nullable', 'string'],
            'payment_status' => ['nullable', 'string', 'default:pending'],
            'payment_method' => ['nullable', 'string', 'default:cash'],
            'user_id'        => ['required', 'exists:users,id'],

            'address.name'           => ['required', 'string', 'max:50'],
            'address.country_id'     => ['required'],
            'address.contact_name'   => ['required', 'string', 'max:60'],
            'address.phone'          => ['required'],
            'address.address_line_1' => ['required', 'string', 'max:50'],
            'address.address_line_2' => ['nullable', 'string', 'max:50'],
            'address.city'           => ['required', 'string', 'max:50'],
            'address.zip_code'       => ['required', 'string', 'max:10'],
            'address.state_id'       => ['required'],

            // 'items' => ['required', 'array', 'min:1'],

            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
            'items.*.price'      => ['required', 'numeric', 'min:0'],
            'items.*.tax_rate'   => ['required', 'numeric', 'min:0', 'max:100'],
            'items.*.total'      => ['required', 'numeric', 'min:0'],

            'sub_total'       => ['required', 'numeric', 'min:0'],
            'delivery_charge' => ['required', 'numeric', 'min:0'],
            'grand_total'     => ['required', 'numeric', 'min:0'],
            'notes'           => ['nullable']
        ];
    }
}
