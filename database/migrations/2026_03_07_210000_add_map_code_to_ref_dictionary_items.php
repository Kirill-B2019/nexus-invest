<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Колонка для синхронизации с картой регионов (код субъекта на карте, напр. RU-MOW, RU-SPE).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->string('map_code', 20)->nullable()->after('country_code')->comment('Код региона на карте (синхронизация с SVG/картой)');
        });
    }

    public function down(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->dropColumn('map_code');
        });
    }
};
