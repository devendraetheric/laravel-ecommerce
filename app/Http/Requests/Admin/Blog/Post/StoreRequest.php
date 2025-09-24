<?php

namespace App\Http\Requests\Admin\Blog\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Blog\Post as BlogPost;

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
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['required', 'string', 'max:255', Rule::unique(BlogPost::class)],
            'content'           => ['nullable', 'string'],
            'blog_category_id'  => ['nullable', 'exists:blog_categories,id'],
            'published_at'      => ['required'],
            'seo_title'         => ['nullable', 'string'],
            'seo_description'   => ['nullable', 'string'],
            'status'            => ['required']
        ];
    }
}
