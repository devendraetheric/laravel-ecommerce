<?php

namespace App\Http\Requests\Admin\Blog\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Blog\Category as BlogCategory;
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
            'name'              => ['required', 'string', Rule::unique('blog_categories', 'name')->ignore($this->blog_category)],
            'slug'              => ['required', 'string', Rule::unique('blog_categories', 'slug')->ignore($this->blog_category)],
            'description'       => ['nullable', 'string'],
            'is_active'         => ['boolean', 'default(true)'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
        ];
    }
}
