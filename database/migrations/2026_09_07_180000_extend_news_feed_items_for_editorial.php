<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Расширение ленты новостей: редакционные статьи, статусы, задел под агентства.
 */
return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            $this->rebuildSqliteTable();
        } else {
            Schema::table('news_feed_items', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('title');
                $table->longText('body')->nullable()->after('description');
                $table->string('status', 32)->default('published')->after('source');
                $table->foreignId('author_id')->nullable()->after('status')->constrained('users')->nullOnDelete();
                $table->json('source_meta')->nullable()->after('author_id');
                $table->index(['status', 'published_at']);
            });

            if ($driver === 'mysql') {
                DB::statement('ALTER TABLE news_feed_items MODIFY external_id VARCHAR(255) NULL');
                DB::statement('ALTER TABLE news_feed_items MODIFY url VARCHAR(1000) NULL');
            } elseif ($driver === 'pgsql') {
                DB::statement('ALTER TABLE news_feed_items ALTER COLUMN external_id DROP NOT NULL');
                DB::statement('ALTER TABLE news_feed_items ALTER COLUMN url DROP NOT NULL');
            }
        }

        DB::table('news_feed_items')->whereNull('status')->orWhere('status', '')->update(['status' => 'published']);
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('news_feed_items', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropConstrainedForeignId('author_id');
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'body', 'status', 'source_meta']);
        });
    }

    /**
     * SQLite: имена индексов глобальные, поэтому безопаснее пересоздать таблицу целиком.
     */
    private function rebuildSqliteTable(): void
    {
        Schema::disableForeignKeyConstraints();

        $rows = DB::table('news_feed_items')->get()->map(static fn ($row) => (array) $row)->all();

        Schema::drop('news_feed_items');

        Schema::create('news_feed_items', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable()->unique();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->string('url', 1000)->nullable();
            $table->string('image_url', 1000)->nullable();
            $table->text('description')->nullable();
            $table->longText('body')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('source', 64)->default('dzen');
            $table->string('status', 32)->default('published');
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->json('source_meta')->nullable();
            $table->timestamps();
            $table->index(['source', 'published_at']);
            $table->index(['status', 'published_at']);
        });

        foreach ($rows as $row) {
            $row['status'] = $row['status'] ?? 'published';
            $row['slug'] = $row['slug'] ?? null;
            $row['body'] = $row['body'] ?? null;
            $row['author_id'] = $row['author_id'] ?? null;
            $row['source_meta'] = $row['source_meta'] ?? null;
            DB::table('news_feed_items')->insert($row);
        }

        Schema::enableForeignKeyConstraints();
    }
};
