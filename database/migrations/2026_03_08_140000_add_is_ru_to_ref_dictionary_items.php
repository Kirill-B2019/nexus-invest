<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Признак RU (российский документ) для справочника «Регуляторные документы».
     */
    public function up(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->boolean('is_ru')->default(false)->after('document_url');
        });
    }

    public function down(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->dropColumn('is_ru');
        });
    }
};
