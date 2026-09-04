<?php

namespace Tests\Unit\Indicators;

use App\Models\CfaMarketRu;
use App\Services\Indicators\CfaMarketCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CfaMarketCalculatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_computes_temperature_and_liquidity(): void
    {
        $row = new CfaMarketRu([
            'placement_volume_3m' => 250,
            'placement_volume_prev_3m' => 223,
            'primary_turnover' => 540,
            'secondary_turnover' => 20.2,
            'issues_rated_or_secured' => 52,
            'issues_total' => 115,
            'active_users' => 44800,
            'active_users_prev' => 54000,
        ]);

        $calc = new CfaMarketCalculator;
        $calc->compute($row);

        $this->assertNotNull($row->cfa_temp_index);
        $this->assertGreaterThan(0, $row->cfa_temp_index);
        $this->assertLessThanOrEqual(100, $row->cfa_temp_index);
        $this->assertEqualsWithDelta(0.03607, $row->secondary_share, 0.001);
        $this->assertSame('neutral', $calc->interpretTemperature((float) $row->cfa_temp_index));
    }
}
