<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Таблицы отраслевых индикаторов ЦФА/RWA (публичная аналитика).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicator_sources', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->unique()->comment('Код источника: ncr, procfa, coinshares, rwa_xyz, cbr');
            $table->string('name');
            $table->string('url', 1000)->nullable();
            $table->string('update_frequency', 32)->nullable()->comment('monthly|quarterly|semiannual|event');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('indicator_source_fetches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('indicator_sources')->cascadeOnDelete();
            $table->string('source_url', 1000)->nullable();
            $table->date('published_at')->nullable();
            $table->timestamp('fetched_at');
            $table->string('status', 16)->default('ok')->comment('ok|warning|error');
            $table->string('message', 500)->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();

            $table->index(['source_id', 'fetched_at']);
            $table->index('status');
        });

        // Снимки рынка ЦФА РФ — индикаторы 1 (температура) и 3 (ликвидность)
        Schema::create('cfa_market_ru', function (Blueprint $table) {
            $table->id();
            $table->date('snapshot_date');
            $table->string('period_label', 32)->comment('Напр. 2026-Q2 или 2026-08');
            $table->decimal('placement_volume_3m', 18, 4)->nullable()->comment('Размещения за последние 3 мес, млрд руб.');
            $table->decimal('placement_volume_prev_3m', 18, 4)->nullable();
            $table->decimal('primary_turnover', 18, 4)->nullable()->comment('Первичный оборот, млрд руб.');
            $table->decimal('secondary_turnover', 18, 4)->nullable()->comment('Вторичный оборот, млрд руб.');
            $table->unsignedInteger('issues_rated_or_secured')->nullable();
            $table->unsignedInteger('issues_total')->nullable();
            $table->unsignedInteger('active_users')->nullable();
            $table->unsignedInteger('active_users_prev')->nullable();
            $table->decimal('spread_avg_pct', 8, 4)->nullable()->comment('Средний спред вторички, %');
            $table->unsignedSmallInteger('time_to_exit_days')->nullable();

            $table->decimal('placement_growth', 10, 6)->nullable();
            $table->decimal('secondary_share', 10, 6)->nullable();
            $table->decimal('quality_share', 10, 6)->nullable();
            $table->decimal('user_growth', 10, 6)->nullable();

            $table->decimal('placement_norm', 8, 2)->nullable();
            $table->decimal('secondary_norm', 8, 2)->nullable();
            $table->decimal('quality_norm', 8, 2)->nullable();
            $table->decimal('user_norm', 8, 2)->nullable();

            $table->decimal('cfa_temp_index', 8, 2)->nullable();
            $table->decimal('liquidity_index', 8, 2)->nullable();

            $table->foreignId('fetch_id')->nullable()->constrained('indicator_source_fetches')->nullOnDelete();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['snapshot_date', 'period_label']);
            $table->index('snapshot_date');
        });

        // Глобальные RWA / DeFi — индикаторы 2 и 6
        Schema::create('rwa_global', function (Blueprint $table) {
            $table->id();
            $table->date('snapshot_date');
            $table->string('period_label', 32);
            $table->decimal('rwa_deposits_b', 14, 4)->nullable();
            $table->decimal('defi_deposits_b', 14, 4)->nullable();
            $table->decimal('rwa_deposit_share', 10, 6)->nullable();
            $table->decimal('rwa_deposits_yoy_pct', 10, 4)->nullable();
            $table->decimal('defi_deposits_yoy_pct', 10, 4)->nullable();
            $table->decimal('growth_spread_pct', 10, 4)->nullable();
            $table->decimal('rwa_spot_volume_yoy_pct', 10, 4)->nullable();
            $table->decimal('dex_total_volume_yoy_pct', 10, 4)->nullable();
            $table->decimal('rwa_momentum_pct', 10, 4)->nullable();

            $table->decimal('rwa_distributed_value_b', 14, 4)->nullable();
            $table->decimal('rwa_holders_m', 12, 4)->nullable();
            $table->decimal('daily_transfer_volume_b', 14, 4)->nullable();
            $table->decimal('tokenized_treasuries_b', 14, 4)->nullable();
            $table->decimal('tokenized_private_credit_b', 14, 4)->nullable();
            $table->decimal('rwa_spot_volume_b', 14, 4)->nullable();

            $table->decimal('structure_funds_pct', 8, 2)->nullable();
            $table->decimal('structure_commodities_pct', 8, 2)->nullable();
            $table->decimal('structure_stocks_pct', 8, 2)->nullable();

            $table->json('deltas_30d')->nullable();
            $table->foreignId('fetch_id')->nullable()->constrained('indicator_source_fetches')->nullOnDelete();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['snapshot_date', 'period_label']);
            $table->index('snapshot_date');
        });

        // Стоимость капитала SME — индикатор 7
        Schema::create('sme_finance', function (Blueprint $table) {
            $table->id();
            $table->date('snapshot_date');
            $table->string('period_label', 32);
            $table->decimal('sme_loan_rate_pct', 8, 4);
            $table->decimal('cfa_yield_nexus_pct', 8, 4);
            $table->decimal('spread_sme_pct', 8, 4);
            $table->foreignId('fetch_id')->nullable()->constrained('indicator_source_fetches')->nullOnDelete();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['snapshot_date', 'period_label']);
            $table->index('snapshot_date');
        });

        // Риск-ландшафт ЦФА — индикатор 8
        Schema::create('cfa_risks', function (Blueprint $table) {
            $table->id();
            $table->string('risk_code', 64)->unique();
            $table->string('name');
            $table->string('level', 16)->comment('low|medium|high');
            $table->text('manifestation');
            $table->text('control');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->date('published_at')->nullable();
            $table->timestamp('fetched_at')->nullable();
            $table->foreignId('source_id')->nullable()->constrained('indicator_sources')->nullOnDelete();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cfa_risks');
        Schema::dropIfExists('sme_finance');
        Schema::dropIfExists('rwa_global');
        Schema::dropIfExists('cfa_market_ru');
        Schema::dropIfExists('indicator_source_fetches');
        Schema::dropIfExists('indicator_sources');
    }
};
