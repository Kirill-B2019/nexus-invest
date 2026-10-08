<?php

namespace App\Http\Requests;

use App\Rules\MathCaptcha;
use App\Services\CaptchaService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'captcha_token' => ['required', 'string'],
            'captcha_answer' => ['required', 'string', new MathCaptcha(App::make(CaptchaService::class))],
        ];

        if (config('app.asset_version')) {
            $rules['asset_version'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Укажите имя.'),
            'email.required' => __('Укажите адрес электронной почты.'),
            'email.email' => __('Укажите корректный адрес электронной почты.'),
            'message.required' => __('Введите сообщение.'),
        ];
    }
}
