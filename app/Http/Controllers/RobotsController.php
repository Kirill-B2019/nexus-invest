<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

/**
 * Динамический robots.txt: абсолютный Sitemap и закрытие служебных путей.
 */
class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /lk',
            'Disallow: /profile',
            'Disallow: /login',
            'Disallow: /register',
            'Disallow: /forgot-password',
            'Disallow: /reset-password',
            'Disallow: /confirm-password',
            'Disallow: /verify-email',
            'Disallow: /api/',
            '',
            'Sitemap: ' . route('sitemap'),
            '',
        ];

        return response(implode("\n", $lines), 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
