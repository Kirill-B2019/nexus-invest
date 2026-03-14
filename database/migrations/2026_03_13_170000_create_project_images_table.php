<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * |KB 2026-03-13 Несколько изображений для обложки и карточки каталога.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('type', 20); // cover (1:1), card (16:9)
            $table->string('path', 500);
            $table->string('original_name', 255)->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['project_id', 'type']);
        });

        // Перенос существующих изображений
        $projects = DB::table('projects')->whereNotNull('image_cover_path')->orWhereNotNull('image_card_path')->get();
        foreach ($projects as $p) {
            if ($p->image_cover_path) {
                DB::table('project_images')->insert([
                    'project_id' => $p->id,
                    'type' => 'cover',
                    'path' => $p->image_cover_path,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if ($p->image_card_path) {
                DB::table('project_images')->insert([
                    'project_id' => $p->id,
                    'type' => 'card',
                    'path' => $p->image_card_path,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['image_cover_path', 'image_card_path']);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_cover_path', 500)->nullable();
            $table->string('image_card_path', 500)->nullable();
        });
        Schema::dropIfExists('project_images');
    }
};
