<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NexusAiHealthTest extends TestCase
{
    use RefreshDatabase;

    public function test_footer_displays_both_status_columns(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Статус блокчейна ГАНИМЕД')
            ->assertSee('Статус НЕКСУС ИИ');
    }

    public function test_it_reports_an_active_nexus_ai_service_and_check_time(): void
    {
        Cache::forget('nexus_ai_health');
        config([
            'services.nexus_ai.health_url' => 'http://31.128.38.96/api/health',
            'services.nexus_ai.health_cache_ttl' => 30,
        ]);
        Http::fake([
            'http://31.128.38.96/api/health' => Http::response(['status' => 'ok']),
        ]);

        $response = $this->getJson(route('api.nexus-ai.health'));

        $response->assertOk()
            ->assertJsonPath('ok', true)
            ->assertJsonPath('status', 'Активен')
            ->assertJsonStructure(['checked_at']);
        Http::assertSent(fn ($request) => $request->url() === 'http://31.128.38.96/api/health');
    }

    public function test_it_reports_nexus_ai_as_unavailable_when_health_is_not_ok(): void
    {
        Cache::forget('nexus_ai_health');
        config([
            'services.nexus_ai.health_url' => 'http://31.128.38.96/api/health',
            'services.nexus_ai.health_cache_ttl' => 30,
        ]);
        Http::fake([
            'http://31.128.38.96/api/health' => Http::response(['status' => 'starting']),
        ]);

        $response = $this->getJson(route('api.nexus-ai.health'));

        $response->assertOk()
            ->assertJsonPath('ok', false)
            ->assertJsonPath('status', 'Недоступен')
            ->assertJsonStructure(['checked_at']);
    }
}
