<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Переименование поля: скан документа → ссылка (URL) на документ.
     */
    public function up(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->renameColumn('document_file', 'document_url');
        });
    }

    public function down(): void
    {
        Schema::table('ref_dictionary_items', function (Blueprint $table) {
            $table->renameColumn('document_url', 'document_file');
        });
    }
};
