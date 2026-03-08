<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Поле для хранения пути к скан-копии документа (справочник «Регуляторные документы»).
     */
    public function up(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->string('document_file', 500)->nullable()->after('map_code');
        });
    }

    public function down(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->dropColumn('document_file');
        });
    }
};
