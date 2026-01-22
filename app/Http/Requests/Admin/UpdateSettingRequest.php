<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('manage_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        $config = config('site-settings');

        foreach($config as $group => $settings) {
            foreach($settings as $key => $definition) {
                $rule = $this->getValidationRule($definition['type']);
                $rules["{$group}.{$key}"] = $rule;
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.*.required' => 'The :attribute field is required.',
            '*.*.email' => 'The :attribute must be a valid email address.',
            '*.*.url' => 'The :attribute must be a valid URL.',
        ];
    }

    private function getValidationRule(string $type): array
    {
        return match($type) {
            'string' => ['nullable', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'integer' => ['nullable', 'integer'],
            'boolean' => ['nullable', 'boolean'],
            'email' => ['nullable', 'email', 'max:255'],
            'url' => ['nullable', 'url', 'max:255'],
            'json' => ['nullable', 'json'],
            default => ['nullable', 'string', 'max:255'],
        };
    }
}
