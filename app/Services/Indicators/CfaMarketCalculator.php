<?php

namespace App\Services\Indicators;

use App\Models\CfaMarketRu;

/**
 * Расчёт индексов температуры рынка ЦФА и ликвидности вторички.
 */
class CfaMarketCalculator
{
    /**
     * Заполнить расчётные поля снимка и вернуть модель (без сохранения).
     */
    public function compute(CfaMarketRu $row): CfaMarketRu
    {
        $weights = config('indicators.cfa_temp_weights');

        $placementGrowth = IndicatorNormalizer::growthRate(
            $row->placement_volume_3m,
            $row->placement_volume_prev_3m
        );

        $totalTurnover = null;
        if ($row->primary_turnover !== null && $row->secondary_turnover !== null) {
            $totalTurnover = $row->primary_turnover + $row->secondary_turnover;
        }
        $secondaryShare = IndicatorNormalizer::safeRatio($row->secondary_turnover, $totalTurnover);

        $qualityShare = IndicatorNormalizer::safeRatio(
            $row->issues_rated_or_secured !== null ? (float) $row->issues_rated_or_secured : null,
            $row->issues_total !== null ? (float) $row->issues_total : null
        );

        $userGrowth = IndicatorNormalizer::growthRate(
            $row->active_users !== null ? (float) $row->active_users : null,
            $row->active_users_prev !== null ? (float) $row->active_users_prev : null
        );

        $placementNorm = $placementGrowth !== null
            ? IndicatorNormalizer::placementGrowth($placementGrowth)
            : 50.0;
        $secondaryNorm = $secondaryShare !== null
            ? IndicatorNormalizer::secondaryShare($secondaryShare)
            : 0.0;
        $qualityNorm = $qualityShare !== null
            ? IndicatorNormalizer::qualityShare($qualityShare)
            : 50.0;
        $userNorm = $userGrowth !== null
            ? IndicatorNormalizer::userGrowth($userGrowth)
            : 50.0;

        $cfaTemp = IndicatorNormalizer::clamp(
            ($weights['placement'] * $placementNorm)
            + ($weights['secondary'] * $secondaryNorm)
            + ($weights['quality'] * $qualityNorm)
            + ($weights['users'] * $userNorm)
        );

        $liquidityIndex = $this->computeLiquidityIndex($secondaryNorm, $row);

        $row->placement_growth = $placementGrowth;
        $row->secondary_share = $secondaryShare;
        $row->quality_share = $qualityShare;
        $row->user_growth = $userGrowth;
        $row->placement_norm = $placementNorm;
        $row->secondary_norm = $secondaryNorm;
        $row->quality_norm = $qualityNorm;
        $row->user_norm = $userNorm;
        $row->cfa_temp_index = $cfaTemp;
        $row->liquidity_index = $liquidityIndex;

        return $row;
    }

    public function interpretTemperature(float $index): string
    {
        if ($index <= 35) {
            return 'cooling';
        }
        if ($index <= 65) {
            return 'neutral';
        }

        return 'overheat';
    }

    public function interpretLiquidity(float $index): string
    {
        if ($index <= 30) {
            return 'low';
        }
        if ($index <= 60) {
            return 'medium';
        }

        return 'high';
    }

    public function trendFromDelta(?float $current, ?float $previous): string
    {
        if ($current === null || $previous === null) {
            return 'stable';
        }
        $delta = $current - $previous;
        if ($delta > 0.005) {
            return 'up';
        }
        if ($delta < -0.005) {
            return 'down';
        }

        return 'stable';
    }

    private function computeLiquidityIndex(float $secondaryNorm, CfaMarketRu $row): float
    {
        $hasSpread = $row->spread_avg_pct !== null;
        $hasTime = $row->time_to_exit_days !== null;

        if (! $hasSpread && ! $hasTime) {
            return IndicatorNormalizer::clamp($secondaryNorm);
        }

        $weights = config('indicators.liquidity_weights');
        $spreadNorm = $hasSpread
            ? IndicatorNormalizer::spread((float) $row->spread_avg_pct)
            : $secondaryNorm;
        $timeNorm = $hasTime
            ? IndicatorNormalizer::timeToExit((int) $row->time_to_exit_days)
            : $secondaryNorm;

        $wSec = $weights['secondary'];
        $wSpread = $hasSpread ? $weights['spread'] : 0.0;
        $wTime = $hasTime ? $weights['time'] : 0.0;
        $wSum = $wSec + $wSpread + $wTime;
        if ($wSum < 1e-9) {
            return IndicatorNormalizer::clamp($secondaryNorm);
        }

        return IndicatorNormalizer::clamp(
            ($wSec / $wSum) * $secondaryNorm
            + ($wSpread / $wSum) * $spreadNorm
            + ($wTime / $wSum) * $timeNorm
        );
    }
}
