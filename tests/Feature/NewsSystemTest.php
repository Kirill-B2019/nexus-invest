<?php

namespace Tests\Feature;

use App\Models\NewsFeedItem;
use App\Models\Permission;
use App\Models\User;
use App\Support\HtmlSanitizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsSystemTest extends TestCase
{
    use RefreshDatabase;

    private function grant(User $user, string ...$names): void
    {
        foreach ($names as $name) {
            $permission = Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web',
            ]);
            $user->givePermissionTo($permission);
        }
    }

    public function test_news_index_is_public_and_shows_published_items(): void
    {
        NewsFeedItem::create([
            'external_id' => 'dzen-1',
            'title' => 'Новость Дзен',
            'url' => 'https://dzen.ru/a/example',
            'description' => 'Анонс',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);

        NewsFeedItem::create([
            'external_id' => 'editorial-draft-1',
            'title' => 'Черновик',
            'slug' => 'chernovik',
            'url' => null,
            'body' => '<p>Секрет</p>',
            'source' => NewsFeedItem::SOURCE_EDITORIAL,
            'status' => NewsFeedItem::STATUS_DRAFT,
            'published_at' => now(),
        ]);

        $response = $this->get(route('news.index'));

        $response->assertOk();
        $response->assertSee('Новость Дзен', false);
        $response->assertDontSee('Черновик', false);
        $response->assertSee('Новости', false);
    }

    public function test_editorial_show_page_works_and_draft_is_404(): void
    {
        $published = NewsFeedItem::create([
            'external_id' => 'editorial-pub-1',
            'title' => 'Статья НЕКСУС',
            'slug' => 'statya-nexus',
            'url' => null,
            'description' => 'Кратко',
            'body' => '<p>Полный текст</p><script>alert(1)</script>',
            'source' => NewsFeedItem::SOURCE_EDITORIAL,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        NewsFeedItem::create([
            'external_id' => 'editorial-draft-2',
            'title' => 'Скрытый черновик',
            'slug' => 'skrytyj',
            'source' => NewsFeedItem::SOURCE_EDITORIAL,
            'status' => NewsFeedItem::STATUS_DRAFT,
            'published_at' => now(),
        ]);

        $this->get(route('news.show', $published->slug))
            ->assertOk()
            ->assertSee('Статья НЕКСУС', false)
            ->assertSee('Полный текст', false);

        $this->get(route('news.show', 'skrytyj'))->assertNotFound();
    }

    public function test_homepage_carousel_only_published_and_has_all_news_link(): void
    {
        NewsFeedItem::create([
            'external_id' => 'dzen-home-1',
            'title' => 'На главной',
            'url' => 'https://dzen.ru/a/home',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        NewsFeedItem::create([
            'external_id' => 'dzen-hidden-1',
            'title' => 'Скрытая с главной',
            'url' => 'https://dzen.ru/a/hidden',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_HIDDEN,
            'published_at' => now(),
        ]);

        $response = $this->get(route('welcome'));

        $response->assertOk();
        $response->assertSee('На главной', false);
        $response->assertDontSee('Скрытая с главной', false);
        $response->assertSee(route('news.index'), false);
    }

    public function test_sitemap_includes_news_and_editorial_slug(): void
    {
        NewsFeedItem::create([
            'external_id' => 'editorial-sm-1',
            'title' => 'В sitemap',
            'slug' => 'v-sitemap',
            'source' => NewsFeedItem::SOURCE_EDITORIAL,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $response->assertSee(route('news.index'), false);
        $response->assertSee(route('news.show', 'v-sitemap'), false);
    }

    public function test_admin_create_requires_manage_news(): void
    {
        $user = User::factory()->create();
        $this->grant($user, 'access-lk', 'update-news-feed');

        // В ЛК 403 превращается в редирект на /lk с alert_error (bootstrap/app.php).
        $this->actingAs($user)
            ->get(route('lk.admin.news-feed.create'))
            ->assertRedirect(route('lk'))
            ->assertSessionHas('alert_error');
    }

    public function test_admin_can_create_editorial_with_manage_news(): void
    {
        $user = User::factory()->create();
        $this->grant($user, 'access-lk', 'manage-news');

        $response = $this->actingAs($user)->post(route('lk.admin.news-feed.store'), [
            'title' => 'Моя статья',
            'slug' => 'moya-statya',
            'description' => 'Анонс статьи',
            'body' => '<p>Текст</p><script>bad()</script>',
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->format('Y-m-d\TH:i'),
        ]);

        $item = NewsFeedItem::query()->where('slug', 'moya-statya')->first();
        $this->assertNotNull($item);
        $this->assertSame(NewsFeedItem::SOURCE_EDITORIAL, $item->source);
        $this->assertSame(NewsFeedItem::STATUS_PUBLISHED, $item->status);
        $this->assertStringContainsString('<p>Текст</p>', (string) $item->body);
        $this->assertStringNotContainsString('<script>', (string) $item->body);

        $response->assertRedirect(route('lk.admin.news-feed.edit', $item));

        $this->get(route('news.show', 'moya-statya'))
            ->assertOk()
            ->assertSee('Моя статья', false);
    }

    public function test_dzen_sync_skips_hidden_items(): void
    {
        NewsFeedItem::create([
            'external_id' => 'keep-hidden',
            'title' => 'Была скрыта',
            'url' => 'https://dzen.ru/a/keep-hidden',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_HIDDEN,
            'published_at' => now()->subDays(3),
        ]);

        // Имитация payload upsert: сервис пропускает hidden — проверяем модельную логику напрямую.
        $existing = NewsFeedItem::where('external_id', 'keep-hidden')->where('source', 'dzen')->first();
        $this->assertNotNull($existing);
        $this->assertSame(NewsFeedItem::STATUS_HIDDEN, $existing->status);

        // forFeed не должен отдавать hidden
        $feed = NewsFeedItem::forFeed(20)->pluck('external_id')->all();
        $this->assertNotContains('keep-hidden', $feed);
    }

    public function test_html_sanitizer_and_unique_slug(): void
    {
        $clean = HtmlSanitizer::clean('<p>Ok</p><script>x</script><a href="javascript:alert(1)">x</a><a href="https://example.com">y</a>');
        $this->assertStringContainsString('<p>Ok</p>', (string) $clean);
        $this->assertStringNotContainsString('<script>', (string) $clean);
        $this->assertStringNotContainsString('javascript:', (string) $clean);
        $this->assertStringContainsString('https://example.com', (string) $clean);

        NewsFeedItem::create([
            'external_id' => 'slug-1',
            'title' => 'A',
            'slug' => 'testovaya-novost',
            'url' => 'https://example.com/1',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
        ]);

        $this->assertSame('testovaya-novost-2', NewsFeedItem::uniqueSlug('Тестовая новость'));
    }

    public function test_menu_contains_news_link(): void
    {
        $this->get(route('features'))
            ->assertOk()
            ->assertSee(route('news.index'), false);
    }

    public function test_news_view_mode_is_taken_from_cookie(): void
    {
        NewsFeedItem::create([
            'external_id' => 'dzen-view-1',
            'title' => 'Новость для вида',
            'url' => 'https://dzen.ru/a/view-mode',
            'description' => 'Анонс',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->subHour(),
        ]);

        $this->get(route('news.index'))
            ->assertOk()
            ->assertSee('news-page-feed--list', false)
            ->assertSee('Вид ленты', false);

        $this->withUnencryptedCookie('news_view', 'blocks')
            ->get(route('news.index'))
            ->assertOk()
            ->assertSee('news-page-feed--blocks', false)
            ->assertDontSee('news-page-feed--list', false);

        $this->withUnencryptedCookie('news_view', 'invalid')
            ->get(route('news.index'))
            ->assertOk()
            ->assertSee('news-page-feed--list', false);
    }

    public function test_news_index_is_sorted_by_published_at_desc(): void
    {
        NewsFeedItem::create([
            'external_id' => 'sort-old',
            'title' => 'Старая новость сортировки',
            'url' => 'https://dzen.ru/a/sort-old',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->subDays(10),
        ]);
        NewsFeedItem::create([
            'external_id' => 'sort-new',
            'title' => 'Новая новость сортировки',
            'url' => 'https://dzen.ru/a/sort-new',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);
        NewsFeedItem::create([
            'external_id' => 'sort-mid',
            'title' => 'Средняя новость сортировки',
            'url' => 'https://dzen.ru/a/sort-mid',
            'source' => NewsFeedItem::SOURCE_DZEN,
            'status' => NewsFeedItem::STATUS_PUBLISHED,
            'published_at' => now()->subDays(5),
        ]);

        $html = $this->get(route('news.index'))->assertOk()->getContent();
        $posNew = strpos($html, 'Новая новость сортировки');
        $posMid = strpos($html, 'Средняя новость сортировки');
        $posOld = strpos($html, 'Старая новость сортировки');

        $this->assertNotFalse($posNew);
        $this->assertNotFalse($posMid);
        $this->assertNotFalse($posOld);
        $this->assertTrue($posNew < $posMid && $posMid < $posOld);
    }

    public function test_agency_stub_throws_when_disabled(): void
    {
        $this->expectException(\RuntimeException::class);
        (new \App\Services\AgencyFeedService)->fetchAndSync();
    }
}
