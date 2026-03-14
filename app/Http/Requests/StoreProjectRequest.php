<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Rules\ImageMinDimensions;
use Illuminate\Foundation\Http\FormRequest;

/**
 * |KB 2026-03-13 Валидация сохранения проекта (черновик или шаг формы).
 */
class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('initiator') || $this->user()?->hasRole('super-admin');
    }

    public function rules(): array
    {
        $rules = [
            'step' => ['sometimes', 'integer', 'in:1,2,3,4,5'],
            'name' => ['nullable', 'string', 'max:200'],
            'pitch' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:5000'],
            'industry' => ['nullable', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:200'],
            'sector_direction' => ['nullable', 'string', 'max:100'],
            'stage' => ['nullable', 'string', 'in:idea,analysis,backlog,in_development,pilot,production,scaling,suspended,completed'],
            'project_type' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'image_cover' => ['nullable', 'array'],
            'image_cover.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:5120', new ImageMinDimensions(300, 300)],
            'image_card' => ['nullable', 'array'],
            'image_card.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:5120', new ImageMinDimensions(550, 300)],
            'document_presentation' => ['nullable', 'file', 'mimes:pdf,ppt,pptx', 'max:20480'],
            'document_business_plan' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:20480'],
            'document_financial_model' => ['nullable', 'file', 'mimes:pdf,xls,xlsx', 'max:20480'],
            'target_amount' => ['nullable', 'integer', 'min:0'],
            'min_investment' => ['nullable', 'integer', 'min:0'],
            'duration_months' => ['nullable', 'integer', 'min:1', 'max:600'],
            'investment_form' => ['nullable', 'string', 'in:equity,loan,convertible,tokenization,other'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'inn' => ['nullable', 'string', 'max:12'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:500'],
        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('Название проекта'),
            'pitch' => __('Краткое описание'),
            'description' => __('Полное описание'),
            'industry' => __('Отрасль'),
            'region' => __('Регион'),
            'sector_direction' => __('Сектор направления'),
            'project_type' => __('Тип проекта'),
            'category' => __('Категория'),
            'stage' => __('Стадия проекта'),
            'image_cover' => __('Обложка 1:1'),
            'image_card' => __('Карточка 16:9'),
            'target_amount' => __('Требуемый объём инвестиций'),
            'min_investment' => __('Минимальная сумма входа'),
            'duration_months' => __('Срок реализации'),
            'investment_form' => __('Форма участия'),
            'company_name' => __('Наименование организации'),
            'inn' => __('ИНН'),
            'contact_person' => __('Контактное лицо'),
            'phone' => __('Телефон'),
            'email' => __('Email'),
            'website' => __('Сайт проекта'),
        ];
    }
}
