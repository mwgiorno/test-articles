<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => 'required|image',
            'headline' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'sections' => 'required|array',
            'sections.*' => 'required|exists:sections,id',
            'body' => 'required|string'
        ];
    }
}
