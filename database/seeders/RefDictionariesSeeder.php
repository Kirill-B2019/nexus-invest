<?php

namespace Database\Seeders;

use App\Models\RefDictionary;
use App\Models\RefDictionaryGroup;
use Illuminate\Database\Seeder;

/**
 * Справочники по группам (территориальные, экономические и т.д.).
 * Запускать после RefDictionaryGroupsSeeder.
 */
class RefDictionariesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'territorial' => [
                ['code' => 'regions', 'name' => 'Регионы', 'description' => 'Страны, регионы и города с привязкой к часовому поясу и регуляторным особенностям.', 'sort_order' => 10],
                ['code' => 'countries', 'name' => 'Страны', 'description' => 'Государства с ISO-кодами, принадлежностью к ЕАЭС/ЕС и уровнем странового риска.', 'sort_order' => 20],
                ['code' => 'regulatory_regimes', 'name' => 'Регуляторные режимы', 'description' => 'Наборы применимых законов и нормативных актов (ЦБ РФ, европейские режимы, KYC/AML).', 'sort_order' => 30],
                ['code' => 'regulatory_documents', 'name' => 'Регуляторные документы', 'description' => 'Законы, приказы ЦБ, директивы ЕС с датами вступления в силу.', 'sort_order' => 40],
            ],
            'economic' => [
                ['code' => 'funding_types', 'name' => 'Типы финансирования', 'description' => 'Способы привлечения капитала: долевое, долговое, конвертируемый займ, гранты, RWA, ревеню-шеринг.', 'sort_order' => 10],
                ['code' => 'funding_sources', 'name' => 'Источники финансирования', 'description' => 'Типы инвесторов и кредиторов: венчурные фонды, банки, краудфандинг и др.', 'sort_order' => 20],
                ['code' => 'investment_stages', 'name' => 'Инвестиционные стадии', 'description' => 'Этапы цикла: предпосев, Seed, Series A/B/C, пре-IPO, IPO, пост-IPO.', 'sort_order' => 30],
                ['code' => 'investment_types', 'name' => 'Типы инвестирования', 'description' => 'Способы участия: прямые вложения, конвертируемые инструменты, проектное финансирование, токены.', 'sort_order' => 40],
                ['code' => 'investment_strategies', 'name' => 'Инвестиционные стратегии', 'description' => 'Стили: венчурный рост, value-инвестирование, доходные стратегии, корпоративный инвестор.', 'sort_order' => 50],
                ['code' => 'deal_statuses', 'name' => 'Статусы сделки (инвестиции)', 'description' => 'Этап жизни сделки: на рассмотрении, одобрена, в исполнении, завершена, отклонена.', 'sort_order' => 60],
                ['code' => 'operating_income_types', 'name' => 'Виды операционных доходов', 'description' => 'Источники выручки: подписка, комиссии, процентный доход, лицензирование, white-label.', 'sort_order' => 70],
                ['code' => 'investment_income_types', 'name' => 'Виды инвестиционных доходов', 'description' => 'Доходы инвестора: дивиденды, прирост капитала, купон, success-fee.', 'sort_order' => 80],
                ['code' => 'currencies', 'name' => 'Валюты', 'description' => 'Фиатные и цифровые валюты, стейблкоины, внутренние токены экосистемы.', 'sort_order' => 90],
            ],
            'sectors' => [
                ['code' => 'sector_directions', 'name' => 'Сектора направлений', 'description' => 'Крупные направления: финтех, DeFi, цифровые активы, RWA, инфраструктура, KYC/AML, IoT.', 'sort_order' => 10],
                ['code' => 'industries', 'name' => 'Отрасли', 'description' => 'Отрасли клиентов и партнёров: банковские услуги, управление активами, МСП-кредитование, страхование.', 'sort_order' => 20],
            ],
            'projects' => [
                ['code' => 'project_categories', 'name' => 'Категории проектов', 'description' => 'Роль в экосистеме: базовая платформа, клиентский продукт, внутренний сервис, исследовательский проект.', 'sort_order' => 10],
                ['code' => 'project_types', 'name' => 'Типы проектов', 'description' => 'Технологический и функциональный тип: блокчейн-платформа, DEX, KYC-сервис, мобильное приложение, API-шлюз.', 'sort_order' => 20],
                ['code' => 'project_statuses', 'name' => 'Статусы проектов', 'description' => 'Жизненный цикл: идея, анализ, в разработке, пилот, промышленная эксплуатация, приостановлен, завершён.', 'sort_order' => 30],
            ],
            'regulation_risk' => [
                ['code' => 'risk_categories', 'name' => 'Категории рисков', 'description' => 'Виды рисков: рыночные, кредитные, операционные, технологические, регуляторные, кибер, санкционные.', 'sort_order' => 10],
                ['code' => 'risk_levels', 'name' => 'Уровни риска', 'description' => 'Градации: низкий, умеренный, повышенный, высокий, критический.', 'sort_order' => 20],
                ['code' => 'investment_attractiveness_criteria', 'name' => 'Критерии инвестиционной привлекательности', 'description' => 'Параметры оценки: размер рынка, product-market fit, команда, конкурентная среда, exit-потенциал.', 'sort_order' => 30],
                ['code' => 'project_metrics', 'name' => 'Метрики эффективности проекта', 'description' => 'Показатели: IRR, NPV, срок окупаемости, LTV, CAC, маржинальность, TVL, выручка, EBITDA.', 'sort_order' => 40],
                ['code' => 'measurement_units', 'name' => 'Единицы измерения', 'description' => 'Единицы для метрик: %, руб., USD, токены и т.п.', 'sort_order' => 50],
                ['code' => 'investment_rating', 'name' => 'Инвестиционный рейтинг проекта', 'description' => 'Интегральная оценка (шкала A–E или 1–10) для сравнения проектов.', 'sort_order' => 60],
                ['code' => 'reporting_frequency', 'name' => 'Периодичность отчётности', 'description' => 'Интервалы: ежемесячно, ежеквартально, ежегодно.', 'sort_order' => 70],
            ],
            'clients_channels' => [
                ['code' => 'client_segments', 'name' => 'Сегменты клиентов', 'description' => 'Группы пользователей: B2B, B2C, B2G, МСП, крупный корпоративный бизнес, состоятельные клиенты.', 'sort_order' => 10],
                ['code' => 'service_channels', 'name' => 'Каналы обслуживания', 'description' => 'Способы взаимодействия: веб-кабинеты, мобильные приложения, API, white-label, партнёрские интеграции.', 'sort_order' => 20],
                ['code' => 'product_types', 'name' => 'Типы продуктов', 'description' => 'Формы решений: SaaS, on-premise, white-label платформы, кастомные внедрения, API-продукты.', 'sort_order' => 30],
                ['code' => 'counterparty_types', 'name' => 'Типы контрагентов', 'description' => 'Роль в сделке: эмитент, заёмщик, инвестор, платформа, регулятор, партнёр.', 'sort_order' => 40],
            ],
            'tech' => [
                ['code' => 'tech_stack', 'name' => 'Технологический стек', 'description' => 'Языки, фреймворки, СУБД, типы блокчейн-сетей и ВМ, DevOps, безопасность.', 'sort_order' => 10],
                ['code' => 'token_types', 'name' => 'Типы токенов и цифровых активов', 'description' => 'Утилитарные, управления, стейблкоины, RWA-токены, LP-токены, токены доступа.', 'sort_order' => 20],
            ],
        ];

        foreach ($data as $groupCode => $dictionaries) {
            $group = RefDictionaryGroup::where('code', $groupCode)->first();
            if (! $group) {
                continue;
            }

            foreach ($dictionaries as $row) {
                RefDictionary::firstOrCreate(
                    [
                        'ref_dictionary_group_id' => $group->id,
                        'code' => $row['code'],
                    ],
                    [
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'sort_order' => $row['sort_order'],
                    ]
                );
            }
        }
    }
}
