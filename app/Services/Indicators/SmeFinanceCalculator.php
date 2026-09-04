<?php

namespace App\Services\Indicators;

use App\Models\SmeFinance;

/**
 * Расчёт спреда стоимости капитала SME vs ЦФА НЕКСУС.
 */
class SmeFinanceCalculator
{
    public function compute(SmeFinance $row): SmeFinance
    {
        $row->spread_sme_pct = round(
            (float) $row->sme_loan_rate_pct - (float) $row->cfa_yield_nexus_pct,
            4
        );

        return $row;
    }
}
