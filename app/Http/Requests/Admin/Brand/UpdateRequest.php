<?php

namespace App\Http\Requests\Admin\Brand;

use App\Models\Brand;
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
            'name'              => ['required', 'string', Rule::unique('brands', 'name')->ignore($this->brand)],
            'slug'              => ['required', 'string', Rule::unique('brands', 'slug')->ignore($this->brand)],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ];
    }
}
