<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_feed_items', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique()->comment('ID публикации в источнике (Дзен)');
            $table->string('title');
            $table->string('url', 1000);
            $table->string('image_url', 1000)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('source', 64)->default('dzen');
            $table->timestamps();
        });

        Schema::table('news_feed_items', function (Blueprint $table) {
            $table->index(['source', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_feed_items');
    }
};
