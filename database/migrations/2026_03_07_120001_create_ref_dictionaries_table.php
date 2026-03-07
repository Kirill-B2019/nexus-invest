<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Справочники (таблицы) с привязкой к группе.
     */
    public function up(): void
    {
        Schema::create('ref_dictionaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_dictionary_group_id')->constrained('ref_dictionary_groups')->cascadeOnDelete();
            $table->string('code', 50);
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['ref_dictionary_group_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ref_dictionaries');
    }
};
