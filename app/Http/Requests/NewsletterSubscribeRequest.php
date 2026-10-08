<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация подписки на рассылку.
 *
 * @see CONVENTIONS.md — валидация только в Form Requests
 */
class NewsletterSubscribeRequest extends FormRequest
{
    /**
     * Получить правила валидации.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ];
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => __('Укажите адрес электронной почты.'),
            'email.email' => __('Укажите корректный адрес электронной почты.'),
        ];
    }
}
