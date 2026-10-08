<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterStoreRequest;
use App\Models\NewsletterSubscription;
use Illuminate\Http\RedirectResponse;

/**
 * |KB 2025-02-18 Подписка на рассылку новостей платформы. Восстановление отписанных.
 */
class NewsletterController extends Controller
{
    /**
     * Подписка на рассылку новостей платформы.
     */
    public function store(NewsletterStoreRequest $request): RedirectResponse
    {
        $email = $request->input('email');

        $subscription = NewsletterSubscription::withTrashed()->firstOrNew(['email' => $email]);
        $subscription->email = $email;
        $subscription->is_active = true;

        if ($subscription->trashed()) {
            $subscription->restore();
        }

        if ($request->user()) {
            $subscription->user_id = $request->user()->id;
        }

        $subscription->save();

        return back()->with('newsletter_success', __('Спасибо! Вы успешно подписаны на рассылку новостей платформы.'))->withFragment('newsletter-form');
    }
}
