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
            $this->extendRelationalTable($driver);
        }

        DB::table('news_feed_items')->whereNull('status')->orWhere('status', '')->update(['status' => 'published']);
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('news_feed_items', function (Blueprint $table) {
            if ($this->foreignKeyExists('news_feed_items', 'news_feed_items_author_id_foreign')) {
                $table->dropForeign(['author_id']);
            }
            if ($this->indexExists('news_feed_items', 'news_feed_items_status_published_at_index')) {
                $table->dropIndex(['status', 'published_at']);
            }
            if ($this->indexExists('news_feed_items', 'news_feed_items_slug_unique')) {
                $table->dropUnique(['slug']);
            }

            $drop = [];
            foreach (['slug', 'body', 'status', 'author_id', 'source_meta'] as $column) {
                if (Schema::hasColumn('news_feed_items', $column)) {
                    $drop[] = $column;
                }
            }
            if ($drop !== []) {
                $table->dropColumn($drop);
            }
        });
    }

    private function extendRelationalTable(string $driver): void
    {
        Schema::table('news_feed_items', function (Blueprint $table) {
            if (! Schema::hasColumn('news_feed_items', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
            if (! Schema::hasColumn('news_feed_items', 'body')) {
                $table->longText('body')->nullable()->after('description');
            }
            if (! Schema::hasColumn('news_feed_items', 'status')) {
                $table->string('status', 32)->default('published')->after('source');
            }
            // Без constrained(): FK добавляем отдельным шагом — иначе на MySQL/MariaDB часто 1215
            // при совмещении ADD COLUMN + FOREIGN KEY в одном ALTER.
            if (! Schema::hasColumn('news_feed_items', 'author_id')) {
                $table->unsignedBigInteger('author_id')->nullable()->after('status');
            }
            if (! Schema::hasColumn('news_feed_items', 'source_meta')) {
                $table->json('source_meta')->nullable()->after('author_id');
            }
        });

        if (! $this->indexExists('news_feed_items', 'news_feed_items_slug_unique') && Schema::hasColumn('news_feed_items', 'slug')) {
            Schema::table('news_feed_items', function (Blueprint $table) {
                $table->unique('slug');
            });
        }

        if (! $this->indexExists('news_feed_items', 'news_feed_items_status_published_at_index') && Schema::hasColumn('news_feed_items', 'status')) {
            Schema::table('news_feed_items', function (Blueprint $table) {
                $table->index(['status', 'published_at']);
            });
        }

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE news_feed_items MODIFY external_id VARCHAR(255) NULL');
            DB::statement('ALTER TABLE news_feed_items MODIFY url VARCHAR(1000) NULL');
            // Явно выравниваем тип под users.id (bigint unsigned)
            DB::statement('ALTER TABLE news_feed_items MODIFY author_id BIGINT UNSIGNED NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE news_feed_items ALTER COLUMN external_id DROP NOT NULL');
            DB::statement('ALTER TABLE news_feed_items ALTER COLUMN url DROP NOT NULL');
        }

        $this->ensureAuthorForeignKey();
    }

    private function ensureAuthorForeignKey(): void
    {
        if (! Schema::hasColumn('news_feed_items', 'author_id')) {
            return;
        }

        if ($this->foreignKeyExists('news_feed_items', 'news_feed_items_author_id_foreign')) {
            return;
        }

        // Убираем «битые» ссылки до создания FK
        $userIds = DB::table('users')->pluck('id');
        DB::table('news_feed_items')
            ->whereNotNull('author_id')
            ->whereNotIn('author_id', $userIds)
            ->update(['author_id' => null]);

        Schema::table('news_feed_items', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    private function foreignKeyExists(string $table, string $name): bool
    {
        $database = Schema::getConnection()->getDatabaseName();
        $row = DB::selectOne(
            'SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = ?',
            [$database, $table, $name, 'FOREIGN KEY']
        );

        return $row !== null;
    }

    private function indexExists(string $table, string $name): bool
    {
        $database = Schema::getConnection()->getDatabaseName();
        $row = DB::selectOne(
            'SELECT INDEX_NAME FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND INDEX_NAME = ?
             LIMIT 1',
            [$database, $table, $name]
        );

        return $row !== null;
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
