<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('Укажите адрес электронной почты.'),
            'email.email' => __('Укажите корректный адрес электронной почты.'),
        ];
    }
}
