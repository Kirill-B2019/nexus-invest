<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * |KB 2026-03-13 Поля формы проекта из справочников: сектор направлений, тип проекта, категория.
 * region и industry уже есть — хранят code из ref_dictionary_items.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('sector_direction', 100)->nullable()->after('industry');
            $table->string('project_type', 100)->nullable()->after('stage');
            $table->string('category', 100)->nullable()->after('project_type');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['sector_direction', 'project_type', 'category']);
        });
    }
};
