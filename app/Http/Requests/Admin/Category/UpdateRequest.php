<?php

namespace App\Http\Requests\Admin\Category;

use App\Models\Category;
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
            'name'              => ['required', 'string', Rule::unique('categories', 'name')->ignore($this->category)],
            'slug'              => ['required', 'string', Rule::unique('categories', 'slug')->ignore($this->category)],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'featured-image'    => ['nullable', 'image', 'max:1024'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ];
    }
}
