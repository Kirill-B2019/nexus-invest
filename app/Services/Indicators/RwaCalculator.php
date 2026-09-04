<?php

namespace App\Services\Indicators;

use App\Models\RwaGlobal;

/**
 * Расчёт метрик RWA vs DeFi и глобального RWA-трекера.
 */
class RwaCalculator
{
    public function compute(RwaGlobal $row): RwaGlobal
    {
        $share = null;
        if ($row->rwa_deposits_b !== null && $row->defi_deposits_b !== null) {
            $sum = $row->rwa_deposits_b + $row->defi_deposits_b;
            $share = abs($sum) > 1e-12 ? $row->rwa_deposits_b / $sum : null;
        }

        $growthSpread = null;
        if ($row->rwa_deposits_yoy_pct !== null && $row->defi_deposits_yoy_pct !== null) {
            $growthSpread = $row->rwa_deposits_yoy_pct - $row->defi_deposits_yoy_pct;
        }

        $momentum = null;
        if ($row->rwa_spot_volume_yoy_pct !== null && $row->dex_total_volume_yoy_pct !== null) {
            $momentum = $row->rwa_spot_volume_yoy_pct - $row->dex_total_volume_yoy_pct;
        }

        $row->rwa_deposit_share = $share !== null ? round($share, 6) : null;
        $row->growth_spread_pct = $growthSpread !== null ? round($growthSpread, 4) : null;
        $row->rwa_momentum_pct = $momentum !== null ? round($momentum, 4) : null;

        return $row;
    }
}
