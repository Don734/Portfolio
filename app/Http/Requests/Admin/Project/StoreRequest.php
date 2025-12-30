<?php

namespace App\Http\Requests\Admin\Project;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Enums\ProjectVisibility;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
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
            'cover' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/webm|max:20000',
            'attachments.*' => 'nullable|file|max:10000',
            'status' => [new Enum(ProjectStatus::class)],
            'type' => [new Enum(ProjectType::class)],
            'started_at' => ['date'],
            'finished_at' => ['date'],
            'priority' => ['numeric'],
            'visibility' => [new Enum(ProjectVisibility::class)],
        ];
    }
}
