<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Элементы (значения) справочников.
     */
    public function up(): void
    {
        Schema::create('ref_dictionary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_dictionary_id')->constrained('ref_dictionaries')->cascadeOnDelete();
            $table->string('code', 100);
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['ref_dictionary_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ref_dictionary_items');
    }
};
