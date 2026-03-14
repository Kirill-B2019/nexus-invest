<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

/**
 * |KB 2026-03-13 Валидация модерации проекта (одобрение/отклонение).
 */
class ModerateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('super-admin') || $this->user()?->can('moderate-projects');
    }

    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:approve,reject'],
            'moderation_comment' => ['required_if:action,reject', 'nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'action' => __('Действие'),
            'moderation_comment' => __('Комментарий модератора'),
        ];
    }
}
