<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * |KB 2026-03-13 Валидация отправки проекта на модерацию.
 */
class SubmitProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        $project = $this->route('project');
        return $project && $project->canSubmit() && $project->user_id === $this->user()?->id;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'pitch' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'max:5000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('Название проекта'),
            'pitch' => __('Краткое описание'),
            'description' => __('Полное описание'),
        ];
    }
}
