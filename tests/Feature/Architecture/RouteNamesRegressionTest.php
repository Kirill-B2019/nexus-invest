<?php

namespace Tests\Feature\Architecture;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RouteNamesRegressionTest extends TestCase
{
    public function test_key_named_routes_exist(): void
    {
        $requiredRouteNames = [
            'welcome',
            'features',
            'compliance',
            'documentation',
            'api.captcha.new',
            'lk',
            'lk.projects.store',
            'lk.projects.update',
            'lk.projects.submit',
            'lk.admin.projects.moderation.index',
            'lk.admin.projects.moderation.moderate',
            'api.nmess.token',
            'profile.edit',
            'login',
            'logout',
        ];

        foreach ($requiredRouteNames as $routeName) {
            $this->assertTrue(Route::has($routeName), "Route `{$routeName}` не найден.");
        }
    }
}
