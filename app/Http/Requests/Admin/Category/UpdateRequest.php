<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['Super Admin', 'Administrator']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'order' => ['nullable', 'numeric'],
            'icon' => ['nullable', 'file', 'mimes:svg,png,jpg,webp'],
            'is_visible' => ['nullable', 'string'],
        ];
    }
}
