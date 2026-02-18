<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * |KB 2025-02-18 Подписка на рассылку новостей платформы. Восстановление отписанных.
 */
class NewsletterController extends Controller
{
    /**
     * Подписка на рассылку новостей платформы.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ], [
            'email.required' => __('Укажите адрес электронной почты.'),
            'email.email' => __('Укажите корректный адрес электронной почты.'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->withFragment('newsletter-form');
        }

        $email = $request->input('email');

        $subscription = NewsletterSubscription::withTrashed()->firstOrNew(['email' => $email]);
        $subscription->email = $email;
        $subscription->is_active = true;

        if ($subscription->trashed()) {
            $subscription->restore();
        }

        if (auth()->check()) {
            $subscription->user_id = auth()->id();
        }

        $subscription->save();

        return back()->with('newsletter_success', __('Спасибо! Вы успешно подписаны на рассылку новостей платформы.'))->withFragment('newsletter-form');
    }
}
