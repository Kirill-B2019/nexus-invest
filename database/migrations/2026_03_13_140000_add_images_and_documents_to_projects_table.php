<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * |KB 2026-03-13 Картинки (1:1 обложка, 16:9 карточка) и документы проектов.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_cover_path', 500)->nullable()->after('stage'); // 1:1 обложка каталога
            $table->string('image_card_path', 500)->nullable()->after('image_cover_path'); // 16:9 карточка проекта
            $table->string('website', 500)->nullable()->after('email'); // сайт проекта
        });

        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('type', 50); // presentation, business_plan, financial_model, other
            $table->string('path', 500);
            $table->string('original_name', 255)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['project_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['image_cover_path', 'image_card_path', 'website']);
        });
        Schema::dropIfExists('project_documents');
    }
};
