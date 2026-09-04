<?php

namespace Database\Seeders;

use App\Models\CfaMarketRu;
use App\Models\CfaRisk;
use App\Models\IndicatorSource;
use App\Models\RwaGlobal;
use App\Models\SmeFinance;
use App\Services\Indicators\CfaMarketCalculator;
use App\Services\Indicators\RwaCalculator;
use App\Services\Indicators\SmeFinanceCalculator;
use Illuminate\Database\Seeder;

/**
 * Базовые снимки отраслевых индикаторов (фикстуры на основе открытых обзоров 2025–2026).
 */
class IndustryIndicatorsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSources();
        $this->seedCfaMarket();
        $this->seedRwaGlobal();
        $this->seedSmeFinance();
        $this->seedRisks();
    }

    private function seedSources(): void
    {
        foreach (config('indicators.sources', []) as $code => $meta) {
            IndicatorSource::query()->updateOrCreate(
                ['code' => $code],
                [
                    'name' => $meta['name'],
                    'url' => $meta['url'] ?? null,
                    'update_frequency' => $meta['update_frequency'] ?? null,
                ]
            );
        }
    }

    private function seedCfaMarket(): void
    {
        $calc = app(CfaMarketCalculator::class);

        $rows = [
            [
                'snapshot_date' => '2025-12-31',
                'period_label' => '2025-Q4',
                'placement_volume_3m' => 180.0,
                'placement_volume_prev_3m' => 165.0,
                'primary_turnover' => 420.0,
                'secondary_turnover' => 12.1,
                'issues_rated_or_secured' => 38,
                'issues_total' => 95,
                'active_users' => 52000,
                'active_users_prev' => 48000,
            ],
            [
                'snapshot_date' => '2026-03-31',
                'period_label' => '2026-Q1',
                'placement_volume_3m' => 210.0,
                'placement_volume_prev_3m' => 180.0,
                'primary_turnover' => 480.0,
                'secondary_turnover' => 17.9,
                'issues_rated_or_secured' => 45,
                'issues_total' => 100,
                'active_users' => 54000,
                'active_users_prev' => 52000,
            ],
            [
                'snapshot_date' => '2026-06-30',
                'period_label' => '2026-Q2',
                'placement_volume_3m' => 235.0,
                'placement_volume_prev_3m' => 210.0,
                'primary_turnover' => 520.0,
                'secondary_turnover' => 19.4,
                'issues_rated_or_secured' => 48,
                'issues_total' => 107,
                'active_users' => 45000,
                'active_users_prev' => 54000,
                'spread_avg_pct' => 2.8,
                'time_to_exit_days' => 18,
            ],
            [
                'snapshot_date' => '2026-09-01',
                'period_label' => '2026-08',
                'placement_volume_3m' => 250.0,
                'placement_volume_prev_3m' => 223.0,
                'primary_turnover' => 540.0,
                'secondary_turnover' => 20.2,
                'issues_rated_or_secured' => 52,
                'issues_total' => 115,
                'active_users' => 44800,
                'active_users_prev' => 54000,
                'spread_avg_pct' => 2.5,
                'time_to_exit_days' => 16,
            ],
        ];

        foreach ($rows as $data) {
            $row = CfaMarketRu::query()->firstOrNew([
                'snapshot_date' => $data['snapshot_date'],
                'period_label' => $data['period_label'],
            ]);
            $row->fill($data);
            $calc->compute($row);
            $row->save();
        }
    }

    private function seedRwaGlobal(): void
    {
        $calc = app(RwaCalculator::class);

        $rows = [
            [
                'snapshot_date' => '2025-06-30',
                'period_label' => '2025-Q2',
                'rwa_deposits_b' => 2.3,
                'defi_deposits_b' => 45.0,
                'rwa_deposits_yoy_pct' => 80.0,
                'defi_deposits_yoy_pct' => 10.0,
                'rwa_spot_volume_yoy_pct' => 120.0,
                'dex_total_volume_yoy_pct' => 5.0,
                'rwa_distributed_value_b' => 18.5,
                'rwa_holders_m' => 0.9,
                'daily_transfer_volume_b' => 3.2,
                'tokenized_treasuries_b' => 6.1,
                'tokenized_private_credit_b' => 3.4,
                'rwa_spot_volume_b' => 4.1,
                'structure_funds_pct' => 72.0,
                'structure_commodities_pct' => 18.0,
                'structure_stocks_pct' => 10.0,
                'deltas_30d' => [
                    'rwa_distributed_value_pct' => 2.1,
                    'rwa_holders_pct' => 4.5,
                    'daily_transfer_volume_pct' => 1.2,
                ],
            ],
            [
                'snapshot_date' => '2025-12-31',
                'period_label' => '2025-Q4',
                'rwa_deposits_b' => 4.1,
                'defi_deposits_b' => 42.0,
                'rwa_deposits_yoy_pct' => 150.0,
                'defi_deposits_yoy_pct' => -5.0,
                'rwa_spot_volume_yoy_pct' => 200.0,
                'dex_total_volume_yoy_pct' => -10.0,
                'rwa_distributed_value_b' => 28.0,
                'rwa_holders_m' => 1.2,
                'daily_transfer_volume_b' => 5.5,
                'tokenized_treasuries_b' => 10.2,
                'tokenized_private_credit_b' => 5.1,
                'rwa_spot_volume_b' => 6.8,
                'structure_funds_pct' => 75.0,
                'structure_commodities_pct' => 17.0,
                'structure_stocks_pct' => 8.0,
                'deltas_30d' => [
                    'rwa_distributed_value_pct' => 3.4,
                    'rwa_holders_pct' => 8.2,
                    'daily_transfer_volume_pct' => 6.1,
                ],
            ],
            [
                'snapshot_date' => '2026-06-30',
                'period_label' => '2026-Q2',
                'rwa_deposits_b' => 7.4,
                'defi_deposits_b' => 38.0,
                'rwa_deposits_yoy_pct' => 221.7,
                'defi_deposits_yoy_pct' => -15.6,
                'rwa_spot_volume_yoy_pct' => 280.0,
                'dex_total_volume_yoy_pct' => -10.0,
                'rwa_distributed_value_b' => 43.8,
                'rwa_holders_m' => 1.8,
                'daily_transfer_volume_b' => 8.4,
                'tokenized_treasuries_b' => 15.64,
                'tokenized_private_credit_b' => 7.47,
                'rwa_spot_volume_b' => 9.2,
                'structure_funds_pct' => 78.4,
                'structure_commodities_pct' => 16.2,
                'structure_stocks_pct' => 5.4,
                'deltas_30d' => [
                    'rwa_distributed_value_pct' => 1.82,
                    'rwa_holders_pct' => 58.69,
                    'daily_transfer_volume_pct' => 38.84,
                ],
            ],
        ];

        foreach ($rows as $data) {
            $row = RwaGlobal::query()->firstOrNew([
                'snapshot_date' => $data['snapshot_date'],
                'period_label' => $data['period_label'],
            ]);
            $row->fill($data);
            $calc->compute($row);
            $row->save();
        }
    }

    private function seedSmeFinance(): void
    {
        $calc = app(SmeFinanceCalculator::class);

        $rows = [
            [
                'snapshot_date' => '2025-12-31',
                'period_label' => '2025-Q4',
                'sme_loan_rate_pct' => 19.2,
                'cfa_yield_nexus_pct' => 16.8,
            ],
            [
                'snapshot_date' => '2026-06-30',
                'period_label' => '2026-Q2',
                'sme_loan_rate_pct' => 18.5,
                'cfa_yield_nexus_pct' => 16.2,
            ],
            [
                'snapshot_date' => '2026-09-01',
                'period_label' => '2026-Q3',
                'sme_loan_rate_pct' => 18.5,
                'cfa_yield_nexus_pct' => 16.2,
            ],
        ];

        foreach ($rows as $data) {
            $row = SmeFinance::query()->firstOrNew([
                'snapshot_date' => $data['snapshot_date'],
                'period_label' => $data['period_label'],
            ]);
            $row->fill($data);
            $calc->compute($row);
            $row->save();
        }
    }

    private function seedRisks(): void
    {
        $ncr = IndicatorSource::query()->where('code', 'ncr')->first();

        $risks = [
            [
                'risk_code' => 'credit',
                'name' => 'Кредитный / дефолт',
                'level' => 'medium',
                'manifestation' => 'Невыплата купона или погашения эмитентом ЦФА.',
                'control' => 'Проверять отчётность эмитента, рейтинг, наличие обеспечения.',
                'sort_order' => 10,
            ],
            [
                'risk_code' => 'liquidity',
                'name' => 'Ликвидность',
                'level' => 'high',
                'manifestation' => 'Невозможность продать ЦФА без большого дисконта до погашения.',
                'control' => 'Оценивать долю вторички, спреды, историю сделок на ОИС.',
                'sort_order' => 20,
            ],
            [
                'risk_code' => 'no_asv',
                'name' => 'Отсутствие АСВ',
                'level' => 'high',
                'manifestation' => 'ЦФА не защищены системой страхования вкладов.',
                'control' => 'Диверсифицировать портфель, не воспринимать ЦФА как депозит.',
                'sort_order' => 30,
            ],
            [
                'risk_code' => 'structural',
                'name' => 'Структурный / формула',
                'level' => 'medium',
                'manifestation' => 'Сложная структура выплат, зависимость от базового актива или формулы.',
                'control' => 'Читать эмиссионную документацию, моделировать сценарии выплат.',
                'sort_order' => 40,
            ],
            [
                'risk_code' => 'collateral',
                'name' => 'Обеспечение / RWA',
                'level' => 'medium',
                'manifestation' => 'Недостаточность или непрозрачность обеспечения реальным активом.',
                'control' => 'Проверять оценку залога, страхование, правовой статус RWA.',
                'sort_order' => 50,
            ],
            [
                'risk_code' => 'tech',
                'name' => 'Технологический',
                'level' => 'medium',
                'manifestation' => 'Сбои ОИС, ошибки смарт-контрактов, недоступность реестра.',
                'control' => 'Выбирать платформы с аудитом, резервными узлами и SLA.',
                'sort_order' => 60,
            ],
            [
                'risk_code' => 'legal_transition',
                'name' => 'Правовой переход',
                'level' => 'medium',
                'manifestation' => 'Изменения регулирования ЦФА и переходных норм.',
                'control' => 'Следить за актами Банка России и обновлениями документации ОИС.',
                'sort_order' => 70,
            ],
            [
                'risk_code' => 'tax',
                'name' => 'Налоговый',
                'level' => 'medium',
                'manifestation' => 'Неопределённость налогообложения доходов и операций с ЦФА.',
                'control' => 'Консультироваться с налоговым советником, учитывать НДФЛ/НП.',
                'sort_order' => 80,
            ],
            [
                'risk_code' => 'concentration',
                'name' => 'Концентрация / конфликт',
                'level' => 'medium',
                'manifestation' => 'Концентрация выпусков у одного эмитента или конфликт интересов ОИС.',
                'control' => 'Ограничивать долю одного эмитента, изучать аффилированность.',
                'sort_order' => 90,
            ],
            [
                'risk_code' => 'fraud',
                'name' => 'Мошенничество / мисселинг',
                'level' => 'high',
                'manifestation' => 'Введение в заблуждение о доходности, рисках или статусе актива.',
                'control' => 'Сверять маркетинг с эмиссионными документами, избегать «гарантий».',
                'sort_order' => 100,
            ],
        ];

        foreach ($risks as $risk) {
            CfaRisk::query()->updateOrCreate(
                ['risk_code' => $risk['risk_code']],
                array_merge($risk, [
                    'is_active' => true,
                    'published_at' => '2026-09-03',
                    'fetched_at' => now(),
                    'source_id' => $ncr?->id,
                ])
            );
        }
    }
}
