<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * |KB 2026-03-13 Таблица проектов инициаторов: черновики, модерация, статусы.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status', 32)->default('draft'); // draft, moderation, approved, rejected
            $table->text('moderation_comment')->nullable();

            // Шаг 1: Основные сведения
            $table->string('name', 200)->nullable();
            $table->string('pitch', 500)->nullable();
            $table->text('description')->nullable();
            $table->string('industry', 100)->nullable();
            $table->string('region', 200)->nullable();
            $table->string('stage', 50)->nullable(); // idea, development, mvp, operating, scaling

            // Шаг 2: Финансы
            $table->unsignedBigInteger('target_amount')->nullable();
            $table->unsignedBigInteger('min_investment')->nullable();
            $table->unsignedInteger('duration_months')->nullable();
            $table->string('investment_form', 100)->nullable(); // equity, loan, convertible, tokenization, other

            // Шаг 3: Заявитель
            $table->string('company_name', 255)->nullable();
            $table->string('inn', 12)->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 255)->nullable();

            $table->timestamps();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('moderated_at')->nullable();
            $table->foreignId('moderated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->index(['user_id', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
