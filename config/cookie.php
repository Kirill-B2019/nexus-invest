<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Configuration
    |--------------------------------------------------------------------------
    |
    | URLs for cookie banner links. Can be overridden in .env.
    |
    */

    'consent' => [
        'cookie_name' => 'cookie_consent',
        'expire_days' => 180, // 6 месяцев

        'privacy_policy_url' => env('COOKIE_PRIVACY_POLICY_URL', 'doc/NexusPrivacyPolicy-14022026.pdf'),
        'terms_url' => env('COOKIE_TERMS_URL', 'doc/NexusUserAgreement-15022026.pdf'),
    ],

];
