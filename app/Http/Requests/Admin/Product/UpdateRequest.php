<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($this->product)],
            'short_description' => ['nullable', 'string'],
            'long_description'  => ['nullable', 'string'],
            'regular_price'     => ['required', 'numeric', 'min:0'],
            'selling_price'     => ['required', 'numeric', 'min:0'],
            'sku'               => ['nullable', 'string'],
            'barcode'           => ['nullable', 'string'],
            'is_active'         => ['boolean'],
            'is_featured'       => ['boolean'],
            'category_id'       => ['nullable', 'exists:categories,id'],
            'brand_id'          => ['nullable', 'exists:brands,id'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'product-images'    => ['nullable', 'array'],
            'product-images.*'  => ['image', 'max:1024'],
        ];
    }
}
