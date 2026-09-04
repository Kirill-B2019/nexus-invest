<?php

namespace App\Services\Indicators;

use App\Models\CfaMarketRu;
use App\Models\CfaRisk;
use App\Models\IndicatorSource;
use App\Models\RwaGlobal;
use App\Models\SmeFinance;
use Illuminate\Support\Carbon;

/**
 * Фасад: сборка JSON для API и запуск парсеров.
 */
class IndustryIndicatorsService
{
    public function __construct(
        private readonly CfaMarketCalculator $cfaCalculator,
        private readonly RwaCalculator $rwaCalculator,
        private readonly SmeFinanceCalculator $smeCalculator,
    ) {}

    /**
     * @return array{ran: array<string, mixed>, errors: array<string, string>}
     */
    public function runParsers(): array
    {
        return app(IndicatorRefreshService::class)->runParsers([
            'ncr', 'procfa', 'rwa_xyz', 'coinshares',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function cfaTemperature(): array
    {
        $current = CfaMarketRu::latestSnapshot();
        if (! $current) {
            return $this->unavailable('cfa-temperature');
        }

        $previous = CfaMarketRu::query()
            ->where('id', '!=', $current->id)
            ->orderByDesc('snapshot_date')
            ->first();

        $calc = $this->cfaCalculator;
        $interpretation = $calc->interpretTemperature((float) $current->cfa_temp_index);

        return [
            'ok' => true,
            'cfa_temp_index' => round((float) $current->cfa_temp_index, 1),
            'interpretation' => $interpretation,
            'interpretation_label' => match ($interpretation) {
                'cooling' => 'Охлаждение',
                'overheat' => 'Перегрев / активный рост',
                default => 'Нейтрально',
            },
            'components' => [
                'placement' => [
                    'value' => $current->placement_growth,
                    'norm' => $current->placement_norm,
                    'trend' => $calc->trendFromDelta($current->placement_growth, $previous?->placement_growth),
                ],
                'secondary' => [
                    'value' => $current->secondary_share,
                    'norm' => $current->secondary_norm,
                    'trend' => $calc->trendFromDelta($current->secondary_share, $previous?->secondary_share),
                ],
                'quality' => [
                    'value' => $current->quality_share,
                    'norm' => $current->quality_norm,
                    'trend' => $calc->trendFromDelta($current->quality_share, $previous?->quality_share),
                ],
                'users' => [
                    'value' => $current->user_growth,
                    'norm' => $current->user_norm,
                    'trend' => $calc->trendFromDelta($current->user_growth, $previous?->user_growth),
                ],
            ],
            'last_updated_at' => $this->iso($current->updated_at ?? $current->snapshot_date),
            'sources' => $this->sourcesPayload(['ncr', 'procfa', 'cbr']),
            'explanation' => 'Индикатор показывает текущее состояние российского рынка ЦФА: от «охлаждения» до «перегрева». Рассчитывается на основе данных НКР, цфа.рф и Банка России. Обновляется ежемесячно.',
            'update_frequency' => 'monthly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function rwaVsDefi(): array
    {
        // Только квартальные снимки; месячные (2026-09) из rwa-global исключаем
        $rows = RwaGlobal::query()
            ->whereNotNull('rwa_deposits_b')
            ->whereNotNull('defi_deposits_b')
            ->orderBy('snapshot_date')
            ->get()
            ->filter(fn (RwaGlobal $r) => (bool) preg_match('/^\d{4}-Q[1-4]$/', (string) $r->period_label))
            ->unique('period_label')
            ->values();

        if ($rows->isEmpty()) {
            return $this->unavailable('rwa-vs-defi');
        }

        $latest = $rows->last();

        return [
            'ok' => true,
            'quarters' => $rows->map(fn (RwaGlobal $r) => [
                'quarter' => $r->period_label,
                'rwa_deposits_b' => $r->rwa_deposits_b,
                'defi_deposits_b' => $r->defi_deposits_b,
                'rwa_deposit_share' => $r->rwa_deposit_share,
            ])->values()->all(),
            'growth_spread_pct' => $latest->growth_spread_pct,
            'rwa_momentum_pct' => $latest->rwa_momentum_pct,
            'rwa_spot_volume_yoy_pct' => $latest->rwa_spot_volume_yoy_pct,
            'dex_total_volume_yoy_pct' => $latest->dex_total_volume_yoy_pct,
            'last_updated_at' => $this->iso($latest->updated_at ?? $latest->snapshot_date),
            'sources' => $this->sourcesPayload(['coinshares']),
            'explanation' => 'Как меняется распределение капитала между токенизированными реальными активами (RWA) и классическим DeFi. Рост доли RWA указывает на сдвиг в сторону реальных активов. Обновляется ежеквартально.',
            'update_frequency' => 'quarterly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function liquidityLight(): array
    {
        $current = CfaMarketRu::latestSnapshot();
        if (! $current || $current->liquidity_index === null) {
            return $this->unavailable('liquidity-light');
        }

        $history = CfaMarketRu::query()
            ->whereNotNull('secondary_share')
            ->orderBy('snapshot_date')
            ->get(['period_label', 'secondary_share']);

        $interpretation = $this->cfaCalculator->interpretLiquidity((float) $current->liquidity_index);

        return [
            'ok' => true,
            'liquidity_index' => round((float) $current->liquidity_index, 1),
            'interpretation' => $interpretation,
            'interpretation_label' => match ($interpretation) {
                'low' => 'Низкая',
                'high' => 'Высокая',
                default => 'Средняя',
            },
            'secondary_share' => $current->secondary_share,
            'history' => $history->map(fn (CfaMarketRu $r) => [
                'quarter' => $r->period_label,
                'secondary_share' => $r->secondary_share,
            ])->values()->all(),
            'last_updated_at' => $this->iso($current->updated_at ?? $current->snapshot_date),
            'sources' => $this->sourcesPayload(['ncr', 'procfa', 'cbr']),
            'explanation' => 'Индикатор показывает, насколько легко инвестор может продать ЦФА на вторичном рынке до погашения. Низкая ликвидность означает высокий риск выхода. Данные: НКР, цфа.рф. Обновляется ежеквартально.',
            'update_frequency' => 'quarterly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function rwaGlobal(): array
    {
        $latest = RwaGlobal::query()
            ->whereNotNull('rwa_distributed_value_b')
            ->orderByDesc('snapshot_date')
            ->first();

        if (! $latest) {
            return $this->unavailable('rwa-global');
        }

        return [
            'ok' => true,
            'rwa_distributed_value_b' => $latest->rwa_distributed_value_b,
            'rwa_holders_m' => $latest->rwa_holders_m,
            'daily_transfer_volume_b' => $latest->daily_transfer_volume_b,
            'tokenized_treasuries_b' => $latest->tokenized_treasuries_b,
            'tokenized_private_credit_b' => $latest->tokenized_private_credit_b,
            'rwa_spot_volume_b' => $latest->rwa_spot_volume_b,
            'structure' => [
                'funds_pct' => $latest->structure_funds_pct,
                'commodities_pct' => $latest->structure_commodities_pct,
                'stocks_pct' => $latest->structure_stocks_pct,
            ],
            'deltas_30d' => $latest->deltas_30d ?? [],
            'last_updated_at' => $this->iso($latest->updated_at ?? $latest->snapshot_date),
            'sources' => $this->sourcesPayload(['rwa_xyz', 'coinshares']),
            'explanation' => 'Индикатор показывает глобальный масштаб токенизации реальных активов (RWA): общую стоимость, число держателей, объём трансферов и структуру по классам активов. Данные: RWA.xyz, CoinShares. Обновляется ежемесячно.',
            'update_frequency' => 'monthly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function smeCost(): array
    {
        $latest = SmeFinance::latestSnapshot();
        if (! $latest) {
            return $this->unavailable('sme-cost');
        }

        return [
            'ok' => true,
            'sme_loan_rate_pct' => $latest->sme_loan_rate_pct,
            'cfa_yield_nexus_pct' => $latest->cfa_yield_nexus_pct,
            'spread_sme_pct' => $latest->spread_sme_pct,
            'last_updated_at' => $this->iso($latest->updated_at ?? $latest->snapshot_date),
            'sources' => $this->sourcesPayload(['cbr', 'nexus']),
            'explanation' => 'Индикатор сравнивает среднюю стоимость привлечения капитала для малого и среднего бизнеса через банковские кредиты и через платформу НЕКСУС (ЦФА). Положительный спрэд означает экономию относительно кредита. Данные: Банк России, внутренняя статистика НЕКСУС. Обновляется ежеквартально.',
            'update_frequency' => 'quarterly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function riskMap(): array
    {
        $risks = CfaRisk::query()->active()->get();
        if ($risks->isEmpty()) {
            return $this->unavailable('risk-map');
        }

        $updated = $risks->max('updated_at') ?? $risks->max('fetched_at');

        return [
            'ok' => true,
            'risks' => $risks->map(fn (CfaRisk $r) => [
                'id' => $r->risk_code,
                'name' => $r->name,
                'level' => $r->level,
                'level_label' => match ($r->level) {
                    'low' => 'Низкий',
                    'high' => 'Высокий',
                    default => 'Средний',
                },
                'manifestation' => $r->manifestation,
                'control' => $r->control,
            ])->values()->all(),
            'last_updated_at' => $this->iso($updated),
            'sources' => $this->sourcesPayload(['ncr', 'smartlab', 'cbr']),
            'explanation' => 'Индикатор показывает основные риски инвестирования в ЦФА по классификации НКР. Для каждого риска указан уровень, типичные проявления и минимальные меры контроля. Данные: НКР, аналитические обзоры. Обновляется раз в полгода или при изменении регулирования.',
            'update_frequency' => 'semiannual',
        ];
    }

    /**
     * @param  list<string>  $codes
     * @return list<array{name: string, url: ?string, published_at: ?string, code: string}>
     */
    private function sourcesPayload(array $codes): array
    {
        $sources = IndicatorSource::query()->whereIn('code', $codes)->get()->keyBy('code');
        $out = [];
        foreach ($codes as $code) {
            $s = $sources->get($code);
            $cfg = config("indicators.sources.$code", []);
            $published = null;
            if ($s) {
                $publishedRaw = $s->fetches()
                    ->where('status', 'ok')
                    ->latest('fetched_at')
                    ->value('published_at');
                if ($publishedRaw) {
                    try {
                        $published = Carbon::parse($publishedRaw)->format('Y-m-d');
                    } catch (\Throwable) {
                        $published = null;
                    }
                }
            }
            $out[] = [
                'code' => $code,
                'name' => $s?->name ?? ($cfg['name'] ?? $code),
                'url' => $s?->url ?? ($cfg['url'] ?? null),
                'published_at' => $published,
            ];
        }

        return $out;
    }

    /**
     * @return array<string, mixed>
     */
    private function unavailable(string $slug): array
    {
        return [
            'ok' => false,
            'error' => 'unavailable',
            'message' => 'Данные временно недоступны',
            'indicator' => $slug,
            'last_updated_at' => null,
            'sources' => [],
        ];
    }

    private function iso(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }
        if ($value instanceof Carbon) {
            return $value->utc()->toIso8601String();
        }

        try {
            return Carbon::parse($value)->utc()->toIso8601String();
        } catch (\Throwable) {
            return null;
        }
    }
}
