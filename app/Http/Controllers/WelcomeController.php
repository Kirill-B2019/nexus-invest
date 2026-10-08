<?php

namespace App\Http\Controllers;

use App\Models\NewsFeedItem;
use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * |KB 2025-02-18 Главная страница сайта (после входа). Публичная часть.
 *
 * @see CONVENTIONS.md — оркестрация только, кэш SVG, нет N+1
 */
class WelcomeController extends Controller
{
    /**
     * Ключ кэша для SVG карты.
     */
    private const SVG_CACHE_KEY = 'welcome.map_svg';

    /**
     * Ключ кэша для справочников карты.
     */
    private const DICT_CACHE_KEY = 'welcome.map_dictionaries';

    /**
     * TTL кэша в секундах (1 час).
     */
    private const CACHE_TTL = 3600;

    /**
     * Коды справочников для фильтров карты (порядок отображения).
     *
     * @var string[]
     */
    private const MAP_FILTER_DICT_CODES = [
        'industries',
        'sector_directions',
        'funding_types',
        'investment_stages',
        'project_categories',
        'project_types',
        'investment_rating',
        'product_types',
    ];

    /**
     * Код региона Москвы для приоритетного отображения.
     */
    private const MOSCOW_REGION_CODE = 'RU-MOW';

    public function __invoke()
    {
        // Заполнить published_at только у внешних записей без даты (не трогаем черновики редакции).
        NewsFeedItem::whereNull('published_at')
            ->whereIn('source', [NewsFeedItem::SOURCE_DZEN, NewsFeedItem::SOURCE_AGENCY])
            ->update(['published_at' => DB::raw('created_at')]);

        $newsFeedItems = NewsFeedItem::forFeed(12)->get();

        $regionsForMap = $this->getRegionsForMap();
        $mapSvg = $this->getMapSvg();
        $mapFilterDictionaries = $this->getMapFilterDictionaries();

        $welcomeFaqItems = $this->getWelcomeFaqItems();
        $welcomeFaqLead = $this->getWelcomeFaqLead();

        return view('welcome', compact('newsFeedItems', 'regionsForMap', 'mapSvg', 'mapFilterDictionaries', 'welcomeFaqItems', 'welcomeFaqLead') + [
            'title' => __('Платформа проектного финансирования и токенизации'),
        ]);
    }

    /**
     * Получить регионы для карты с кэшированием.
     *
     * @return array<string, mixed>
     */
    private function getRegionsForMap(): array
    {
        return Cache::remember('welcome.regions', self::CACHE_TTL, function () {
            $dict = RefDictionary::whereHas('group', fn ($q) => $q->where('code', 'territorial'))
                ->where('code', 'regions')
                ->first();

            if (!$dict) {
                return [];
            }

            $regions = RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                ->whereNotNull('map_code')
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name', 'code', 'map_code'])
                ->keyBy('map_code')
                ->toArray();

            // Москва первой в списке регионов фильтра карты
            if (!empty($regions[self::MOSCOW_REGION_CODE])) {
                $moscow = [self::MOSCOW_REGION_CODE => $regions[self::MOSCOW_REGION_CODE]];
                unset($regions[self::MOSCOW_REGION_CODE]);
                $regions = $moscow + $regions;
            }

            return $regions;
        });
    }

    /**
     * Получить SVG карты с кэшированием.
     */
    private function getMapSvg(): string
    {
        return Cache::remember(self::SVG_CACHE_KEY, self::CACHE_TTL, function () {
            $svgPath = public_path('assets/svg/russia-regions.svg');

            if (file_exists($svgPath)) {
                return file_get_contents($svgPath);
            }

            return '';
        });
    }

    /**
     * Получить справочники для фильтров карты без N+1.
     *
     * @return array<array{code: string, name: string, items: array<int, array<string, mixed>>}>
     */
    private function getMapFilterDictionaries(): array
    {
        return Cache::remember(self::DICT_CACHE_KEY, self::CACHE_TTL, function () {
            // Один запрос для всех справочников
            $dicts = RefDictionary::whereIn('code', self::MAP_FILTER_DICT_CODES)
                ->get(['id', 'code', 'name'])
                ->keyBy('code');

            // Один запрос для всех элементов справочников
            $dictIds = $dicts->pluck('id')->toArray();
            $items = RefDictionaryItem::whereIn('ref_dictionary_id', $dictIds)
                ->where('is_active', true)
                ->get(['id', 'ref_dictionary_id', 'name', 'code'])
                ->groupBy('ref_dictionary_id');

            $result = [];
            foreach (self::MAP_FILTER_DICT_CODES as $code) {
                $dict = $dicts->get($code);

                $dictItems = [];
                if ($dict) {
                    $dictCollection = $items->get($dict->id);
                    if ($dictCollection instanceof \Illuminate\Support\Collection) {
                        $dictItems = $dictCollection->map(function (RefDictionaryItem $item) {
                            return [
                                'id' => $item->id,
                                'name' => $item->name,
                                'code' => $item->code,
                            ];
                        })->toArray();
                    }
                }

                $result[] = [
                    'code' => $code,
                    'name' => $dict ? $dict->name : $code,
                    'items' => $dictItems,
                ];
            }

            return $result;
        });
    }

    /**
     * Получить FAQ-элементы для главной страницы.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getWelcomeFaqItems(): array
    {
        return [
            [
                'question' => 'Что такое НЕКСУС?',
                'answer' => 'НЕКСУС — экосистема проектного финансирования и токенизации активов в соответствии с российским законодательством (в том числе № 282-ФЗ от 04.08.2026 о цифровых валютах и цифровых правах): запуск проектов, выпуск и обращение цифровых активов, в том числе RWA (токенизация прав на реальные активы), утилитарные цифровые права (УЦП), токенизация иных активов, сопровождение сделок и развитие вторичного рынка в рамках модели платформы.',
                'tags' => ['282-ФЗ · ЦФА · RWA'],
                'open' => true,
            ],
            [
                'question' => 'Чем цифровые активы и ЦФА отличаются от «криптовалюты»?',
                'answer' => 'ЦФА и иные цифровые активы в контуре платформы выпускаются и обращаются по правилам 282‑ФЗ и договорной модели оператора: есть эмитент, раскрытие информации, учёт прав и требования к инвесторам. Это не свободно обращающаяся «криптовалюта» и не анонимные расчёты вне правового поля РФ.',
                'tags' => ['282-ФЗ · ЦФА'],
            ],
            [
                'question' => 'На какой технологии построен блокчейн ГАНИМЕД?',
                'answer' => 'ГАНИМЕД реализован как высокопроизводительная распределённая платформа (в т.ч. на Go), с гибридным консенсусом PoSA, EVM‑совместимостью для смарт‑контрактов и развитием экосистемы под задачи токенизации и учёта цифровых активов в соответствии с применимыми требованиями.',
                'tags' => ['ГАНИМЕД · PoSA · EVM'],
            ],
            [
                'question' => 'Кто может стать участником платформы?',
                'answer' => 'Доступ к функциям личного кабинета и сделкам предоставляется после регистрации и прохождения процедур идентификации и комплаенса (KYC/AML) в объёме, предусмотренном правилами платформы и законодательством. Набор ролей (инициатор проекта, инвестор, эксперт и др.) определяется моделью доступа и назначенными правами.',
                'tags' => ['KYC/AML · роли'],
            ],
            [
                'question' => 'Что такое iGND и «смягчение рисков» в экосистеме?',
                'answer' => [
                    'iGND — внутренний токен экосистемы в логике программ смягчения последствий формально описанных риск‑событий по проектам для инвесторов, выбравших соответствующие планы участия.',
                    'Условия начислений, ограничения и правовая природа закреплены в документах платформы и смарт‑контрактах на блокчейне ГАНИМЕД; начисления не гарантируются и зависят от наступления событий и параметров пулов.',
                ],
                'tags' => ['iGND · риски'],
            ],
            [
                'question' => 'Где ознакомиться с официальными документами и White Paper?',
                'answer' => 'Актуальные PDF (публичная оферта, пользовательское соглашение, политика конфиденциальности, KYC/AML, White Paper и др.) доступны по ссылкам в подвале сайта; расширенные технические и методические материалы — в разделе «Документация».',
                'tags' => ['Документы · White Paper'],
            ],
            [
                'question' => 'Как обрабатываются персональные данные?',
                'answer' => 'Обработка ведётся в соответствии с 152‑ФЗ и политикой конфиденциальности: указаны цели, категории данных, сроки и права субъектов; применяются организационные и технические меры защиты, согласованные с заявленными в документе целями.',
                'tags' => ['152-ФЗ · ПДн'],
            ],
            [
                'question' => 'На каком этапе развития находится платформа?',
                'answer' => [
                    'Функционал выводится поэтапно согласно дорожной карте: отдельные модули и интеграции могут находиться в стадии MVP или пилота.',
                    'Блоки «прогресс реализации» и дорожная карта на сайте отражают ориентировочное состояние и планы; конкретные сроки не являются публичной офертой до их отдельного официального объявления.',
                ],
                'tags' => ['Roadmap · MVP'],
            ],
        ];
    }

    /**
     * Получить lead-текст для FAQ-секции.
     */
    private function getWelcomeFaqLead(): string
    {
        return __('Ниже — ответы на частые вопросы. Дополнительные материалы — в разделе ')
            . '<a class="faq-panel-dark__doc-link" href="' . e(route('documentation')) . '">' . e(__('«Документация»')) . '</a>.';
    }
}
