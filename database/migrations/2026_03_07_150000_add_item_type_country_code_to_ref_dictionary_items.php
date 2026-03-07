<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Признак типа и страна для элементов справочника (для Регионов: тип — страна/регион/город, страна — код страны).
     */
    public function up(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->string('item_type', 50)->nullable()->after('description')->comment('Тип: country, region, city');
            $table->string('country_code', 10)->nullable()->after('item_type')->comment('Код страны (ISO) для привязки региона/города');
        });
    }

    public function down(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->dropColumn(['item_type', 'country_code']);
        });
    }
};
