<?php

namespace Tests\Unit\Indicators;

use App\Services\Indicators\IndicatorNormalizer;
use PHPUnit\Framework\TestCase;

class IndicatorNormalizerTest extends TestCase
{
    public function test_placement_growth_anchors(): void
    {
        $this->assertSame(0.0, IndicatorNormalizer::placementGrowth(-0.15));
        $this->assertSame(50.0, IndicatorNormalizer::placementGrowth(0.0));
        $this->assertSame(100.0, IndicatorNormalizer::placementGrowth(0.25));
        $this->assertEqualsWithDelta(60.0, IndicatorNormalizer::placementGrowth(0.04), 0.01);
    }

    public function test_secondary_share_anchors(): void
    {
        $this->assertSame(0.0, IndicatorNormalizer::secondaryShare(0.01));
        $this->assertSame(40.0, IndicatorNormalizer::secondaryShare(0.036));
        $this->assertSame(100.0, IndicatorNormalizer::secondaryShare(0.12));
    }

    public function test_quality_and_user_growth(): void
    {
        $this->assertSame(60.0, IndicatorNormalizer::qualityShare(0.50));
        $this->assertSame(50.0, IndicatorNormalizer::userGrowth(0.0));
        $this->assertSame(0.0, IndicatorNormalizer::userGrowth(-0.20));
    }
}
