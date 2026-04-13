<?php

namespace Database\Seeders;

use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Синхронизация элементов справочников:
 * - обновляет и добавляет значения по эталону;
 * - деактивирует значения, отсутствующие в эталоне.
 */
class RefDictionariesSyncSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            foreach ($this->itemsByDictionary() as $groupCode => $dictionaries) {
                foreach ($dictionaries as $dictCode => $items) {
                    $dict = RefDictionary::query()
                        ->whereHas('group', fn ($q) => $q->where('code', $groupCode))
                        ->where('code', $dictCode)
                        ->first();

                    if (! $dict) {
                        continue;
                    }

                    $codes = [];
                    foreach ($items as $index => $item) {
                        $code = (string) $item['code'];
                        $codes[] = $code;

                        $payload = [
                            'name' => $item['name'],
                            'description' => $item['description'] ?? null,
                            'sort_order' => (int) ($item['sort_order'] ?? (($index + 1) * 10)),
                            'is_active' => true,
                        ];

                        RefDictionaryItem::query()->updateOrCreate(
                            [
                                'ref_dictionary_id' => $dict->id,
                                'code' => $code,
                            ],
                            $payload
                        );
                    }

                    RefDictionaryItem::query()
                        ->where('ref_dictionary_id', $dict->id)
                        ->when(! empty($codes), fn ($q) => $q->whereNotIn('code', $codes))
                        ->update(['is_active' => false]);
                }
            }
        });
    }

    /**
     * Эталонные значения для синхронизации.
     *
     * @return array<string, array<string, array<int, array<string, mixed>>>>
     */
    private function itemsByDictionary(): array
    {
        return [
            'sectors' => [
                'sector_directions' => [
                    ['code' => 'fintech', 'name' => 'Финтех', 'sort_order' => 10],
                    ['code' => 'digital_assets', 'name' => 'Цифровые активы', 'sort_order' => 20],
                    ['code' => 'rwa', 'name' => 'RWA / токенизация реальных активов', 'sort_order' => 30],
                    ['code' => 'defi', 'name' => 'DeFi', 'sort_order' => 40],
                    ['code' => 'infrastructure', 'name' => 'Инфраструктурные решения', 'sort_order' => 50],
                    ['code' => 'kyc_aml', 'name' => 'KYC/AML и комплаенс', 'sort_order' => 60],
                    ['code' => 'ai_scoring', 'name' => 'ИИ и скоринг', 'sort_order' => 70],
                    ['code' => 'cybersecurity', 'name' => 'Кибербезопасность', 'sort_order' => 80],
                    ['code' => 'payments', 'name' => 'Платежные решения', 'sort_order' => 90],
                    ['code' => 'govtech', 'name' => 'GovTech / регтех', 'sort_order' => 100],
                    ['code' => 'iot', 'name' => 'IoT', 'sort_order' => 110],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
                'industries' => [
                    ['code' => 'banking', 'name' => 'Банковские услуги', 'sort_order' => 10],
                    ['code' => 'asset_management', 'name' => 'Управление активами', 'sort_order' => 20],
                    ['code' => 'sme_lending', 'name' => 'МСП-кредитование', 'sort_order' => 30],
                    ['code' => 'insurance', 'name' => 'Страхование', 'sort_order' => 40],
                    ['code' => 'real_estate', 'name' => 'Недвижимость и девелопмент', 'sort_order' => 50],
                    ['code' => 'production', 'name' => 'Производство', 'sort_order' => 60],
                    ['code' => 'logistics', 'name' => 'Логистика и цепочки поставок', 'sort_order' => 70],
                    ['code' => 'energy', 'name' => 'Энергетика', 'sort_order' => 80],
                    ['code' => 'agro', 'name' => 'Сельское хозяйство / агро', 'sort_order' => 90],
                    ['code' => 'retail', 'name' => 'Ритейл и e-commerce', 'sort_order' => 100],
                    ['code' => 'it', 'name' => 'IT и цифровые сервисы', 'sort_order' => 110],
                    ['code' => 'healthcare', 'name' => 'Здравоохранение / MedTech', 'sort_order' => 120],
                    ['code' => 'education', 'name' => 'Образование / EdTech', 'sort_order' => 130],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
            ],
            'economic' => [
                'investment_stages' => [
                    ['code' => 'pre_seed', 'name' => 'Предпосев', 'sort_order' => 10],
                    ['code' => 'seed', 'name' => 'Seed', 'sort_order' => 20],
                    ['code' => 'series_a', 'name' => 'Series A', 'sort_order' => 30],
                    ['code' => 'series_b', 'name' => 'Series B', 'sort_order' => 40],
                    ['code' => 'growth', 'name' => 'Growth / стадия роста', 'sort_order' => 50],
                    ['code' => 'pre_ipo', 'name' => 'Пре-IPO', 'sort_order' => 60],
                    ['code' => 'ipo', 'name' => 'IPO / публичное размещение', 'sort_order' => 70],
                    ['code' => 'post_ipo', 'name' => 'Пост-IPO', 'sort_order' => 80],
                    ['code' => 'restructuring', 'name' => 'Реструктуризация / turnaround', 'sort_order' => 90],
                ],
                'funding_types' => [
                    ['code' => 'equity', 'name' => 'Долевое финансирование', 'sort_order' => 10],
                    ['code' => 'debt', 'name' => 'Долговое финансирование', 'sort_order' => 20],
                    ['code' => 'convertible', 'name' => 'Конвертируемый займ', 'sort_order' => 30],
                    ['code' => 'project_bonds', 'name' => 'Облигационное / ЦФА-долговое размещение', 'sort_order' => 40],
                    ['code' => 'rwa_securitization', 'name' => 'RWA-секьюритизация', 'sort_order' => 50],
                    ['code' => 'revenue_share', 'name' => 'Ревеню-шеринг', 'sort_order' => 60],
                    ['code' => 'mezzanine', 'name' => 'Мезонинное финансирование', 'sort_order' => 70],
                    ['code' => 'factoring', 'name' => 'Факторинг', 'sort_order' => 80],
                    ['code' => 'leasing', 'name' => 'Лизинг', 'sort_order' => 90],
                    ['code' => 'grant', 'name' => 'Грант / субсидия', 'sort_order' => 100],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
                'funding_sources' => [
                    ['code' => 'venture_fund', 'name' => 'Венчурный фонд', 'sort_order' => 10],
                    ['code' => 'angel', 'name' => 'Частный инвестор (ангел)', 'sort_order' => 20],
                    ['code' => 'bank', 'name' => 'Банк', 'sort_order' => 30],
                    ['code' => 'corporate', 'name' => 'Корпоративный инвестор', 'sort_order' => 40],
                    ['code' => 'government', 'name' => 'Государственная программа', 'sort_order' => 50],
                    ['code' => 'crowdfunding', 'name' => 'Краудфандинг', 'sort_order' => 60],
                ],
                'investment_types' => [
                    ['code' => 'direct_equity', 'name' => 'Прямое вложение в капитал', 'sort_order' => 10],
                    ['code' => 'convertible_instrument', 'name' => 'Конвертируемый инструмент', 'sort_order' => 20],
                    ['code' => 'project_finance', 'name' => 'Проектное финансирование', 'sort_order' => 30],
                    ['code' => 'syndicated_loan', 'name' => 'Синдицированное кредитование', 'sort_order' => 40],
                    ['code' => 'tokens', 'name' => 'Покупка токенов / цифровых активов', 'sort_order' => 50],
                    ['code' => 'secondary', 'name' => 'Вторичная сделка', 'sort_order' => 60],
                ],
                'deal_statuses' => [
                    ['code' => 'draft', 'name' => 'Черновик', 'sort_order' => 10],
                    ['code' => 'under_review', 'name' => 'На рассмотрении', 'sort_order' => 20],
                    ['code' => 'approved', 'name' => 'Одобрена', 'sort_order' => 30],
                    ['code' => 'in_progress', 'name' => 'В исполнении', 'sort_order' => 40],
                    ['code' => 'partially_completed', 'name' => 'Частично исполнена', 'sort_order' => 50],
                    ['code' => 'completed', 'name' => 'Завершена', 'sort_order' => 60],
                    ['code' => 'rejected', 'name' => 'Отклонена', 'sort_order' => 70],
                    ['code' => 'cancelled', 'name' => 'Отменена', 'sort_order' => 80],
                ],
                'currencies' => [
                    ['code' => 'RUB', 'name' => 'Российский рубль', 'sort_order' => 10],
                    ['code' => 'USD', 'name' => 'Доллар США', 'sort_order' => 20],
                    ['code' => 'EUR', 'name' => 'Евро', 'sort_order' => 30],
                    ['code' => 'KZT', 'name' => 'Казахстанский тенге', 'sort_order' => 40],
                    ['code' => 'BYN', 'name' => 'Белорусский рубль', 'sort_order' => 50],
                    ['code' => 'USDT', 'name' => 'USDT (стейблкоин)', 'sort_order' => 60],
                    ['code' => 'USDC', 'name' => 'USDC (стейблкоин)', 'sort_order' => 70],
                ],
            ],
            'projects' => [
                'project_categories' => [
                    ['code' => 'base_platform', 'name' => 'Базовая платформа', 'sort_order' => 10],
                    ['code' => 'client_product', 'name' => 'Клиентский продукт', 'sort_order' => 20],
                    ['code' => 'internal_service', 'name' => 'Внутренний сервис', 'sort_order' => 30],
                    ['code' => 'infrastructure_module', 'name' => 'Инфраструктурный модуль', 'sort_order' => 40],
                    ['code' => 'compliance_module', 'name' => 'Комплаенс/регуляторный модуль', 'sort_order' => 50],
                    ['code' => 'analytics_module', 'name' => 'Аналитика/скоринг', 'sort_order' => 60],
                    ['code' => 'research', 'name' => 'Исследовательский проект', 'sort_order' => 70],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
                'project_types' => [
                    ['code' => 'blockchain_platform', 'name' => 'Блокчейн-платформа', 'sort_order' => 10],
                    ['code' => 'dex_market', 'name' => 'DEX / вторичный рынок', 'sort_order' => 20],
                    ['code' => 'tokenization', 'name' => 'Модуль токенизации активов', 'sort_order' => 30],
                    ['code' => 'kyc_aml_service', 'name' => 'KYC/AML-сервис', 'sort_order' => 40],
                    ['code' => 'scoring_engine', 'name' => 'Скоринг-движок', 'sort_order' => 50],
                    ['code' => 'risk_engine', 'name' => 'Риск-движок', 'sort_order' => 60],
                    ['code' => 'investor_cabinet', 'name' => 'Кабинет инвестора', 'sort_order' => 70],
                    ['code' => 'issuer_cabinet', 'name' => 'Кабинет инициатора проекта', 'sort_order' => 80],
                    ['code' => 'api_gateway', 'name' => 'API-шлюз / интеграционная шина', 'sort_order' => 90],
                    ['code' => 'mobile_app', 'name' => 'Мобильное приложение', 'sort_order' => 100],
                    ['code' => 'marketplace', 'name' => 'Маркетплейс результатов проектов', 'sort_order' => 110],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
                'project_statuses' => [
                    ['code' => 'idea', 'name' => 'Идея', 'sort_order' => 10],
                    ['code' => 'analysis', 'name' => 'Предварительный анализ', 'sort_order' => 20],
                    ['code' => 'backlog', 'name' => 'Воронка / бэклог', 'sort_order' => 30],
                    ['code' => 'in_development', 'name' => 'В разработке', 'sort_order' => 40],
                    ['code' => 'pilot', 'name' => 'Пилот', 'sort_order' => 50],
                    ['code' => 'production', 'name' => 'Промышленная эксплуатация', 'sort_order' => 60],
                    ['code' => 'scaling', 'name' => 'Масштабирование', 'sort_order' => 70],
                    ['code' => 'suspended', 'name' => 'Приостановлен', 'sort_order' => 80],
                    ['code' => 'completed', 'name' => 'Завершён', 'sort_order' => 90],
                ],
            ],
            'regulation_risk' => [
                'risk_categories' => [
                    ['code' => 'market', 'name' => 'Рыночный', 'sort_order' => 10],
                    ['code' => 'credit', 'name' => 'Кредитный', 'sort_order' => 20],
                    ['code' => 'operational', 'name' => 'Операционный', 'sort_order' => 30],
                    ['code' => 'technology', 'name' => 'Технологический', 'sort_order' => 40],
                    ['code' => 'legal', 'name' => 'Юридический / регуляторный', 'sort_order' => 50],
                    ['code' => 'cyber', 'name' => 'Кибер-риск', 'sort_order' => 60],
                    ['code' => 'reputation', 'name' => 'Репутационный', 'sort_order' => 70],
                    ['code' => 'sanctions', 'name' => 'Санкционный', 'sort_order' => 80],
                ],
                'risk_levels' => [
                    ['code' => 'low', 'name' => 'Низкий', 'sort_order' => 10],
                    ['code' => 'moderate', 'name' => 'Умеренный', 'sort_order' => 20],
                    ['code' => 'elevated', 'name' => 'Повышенный', 'sort_order' => 30],
                    ['code' => 'high', 'name' => 'Высокий', 'sort_order' => 40],
                    ['code' => 'critical', 'name' => 'Критический', 'sort_order' => 50],
                ],
                'investment_rating' => [
                    ['code' => 'A', 'name' => 'Рейтинг A (высокий)', 'sort_order' => 10],
                    ['code' => 'B', 'name' => 'Рейтинг B (выше среднего)', 'sort_order' => 20],
                    ['code' => 'C', 'name' => 'Рейтинг C (средний)', 'sort_order' => 30],
                    ['code' => 'D', 'name' => 'Рейтинг D (ниже среднего)', 'sort_order' => 40],
                    ['code' => 'E', 'name' => 'Рейтинг E (высокий риск)', 'sort_order' => 50],
                ],
                'reporting_frequency' => [
                    ['code' => 'monthly', 'name' => 'Ежемесячно', 'sort_order' => 10],
                    ['code' => 'quarterly', 'name' => 'Ежеквартально', 'sort_order' => 20],
                    ['code' => 'annually', 'name' => 'Ежегодно', 'sort_order' => 30],
                ],
                'measurement_units' => [
                    ['code' => 'pct', 'name' => 'Проценты (%)', 'sort_order' => 10],
                    ['code' => 'RUB', 'name' => 'Рубли (RUB)', 'sort_order' => 20],
                    ['code' => 'USD', 'name' => 'Доллары (USD)', 'sort_order' => 30],
                    ['code' => 'EUR', 'name' => 'Евро (EUR)', 'sort_order' => 40],
                    ['code' => 'tokens', 'name' => 'Токены', 'sort_order' => 50],
                    ['code' => 'units', 'name' => 'Штуки / единицы', 'sort_order' => 60],
                ],
            ],
            'clients_channels' => [
                'client_segments' => [
                    ['code' => 'b2b', 'name' => 'B2B', 'sort_order' => 10],
                    ['code' => 'b2c', 'name' => 'B2C', 'sort_order' => 20],
                    ['code' => 'b2g', 'name' => 'B2G', 'sort_order' => 30],
                    ['code' => 'sme', 'name' => 'МСП', 'sort_order' => 40],
                    ['code' => 'corporate', 'name' => 'Крупный корпоративный бизнес', 'sort_order' => 50],
                    ['code' => 'wealth', 'name' => 'Состоятельные клиенты', 'sort_order' => 60],
                    ['code' => 'fi', 'name' => 'Финансовые организации', 'sort_order' => 70],
                    ['code' => 'exchange', 'name' => 'Фин-хабы / биржи', 'sort_order' => 80],
                ],
                'service_channels' => [
                    ['code' => 'web', 'name' => 'Веб-кабинеты', 'sort_order' => 10],
                    ['code' => 'mobile', 'name' => 'Мобильные приложения', 'sort_order' => 20],
                    ['code' => 'api', 'name' => 'API-доступ', 'sort_order' => 30],
                    ['code' => 'white_label', 'name' => 'White-label витрины', 'sort_order' => 40],
                    ['code' => 'partner', 'name' => 'Партнерские интеграции', 'sort_order' => 50],
                ],
                'product_types' => [
                    ['code' => 'saas', 'name' => 'SaaS-сервис', 'sort_order' => 10],
                    ['code' => 'on_premise', 'name' => 'On-premise решение', 'sort_order' => 20],
                    ['code' => 'white_label', 'name' => 'White-label платформа', 'sort_order' => 30],
                    ['code' => 'api_product', 'name' => 'API-продукт', 'sort_order' => 40],
                    ['code' => 'tokenized_debt', 'name' => 'Токенизированный долговой инструмент', 'sort_order' => 50],
                    ['code' => 'tokenized_equity', 'name' => 'Токенизированный долевой инструмент', 'sort_order' => 60],
                    ['code' => 'rwa_product', 'name' => 'RWA-продукт', 'sort_order' => 70],
                    ['code' => 'analytics_subscription', 'name' => 'Аналитическая подписка', 'sort_order' => 80],
                    ['code' => 'consulting_support', 'name' => 'Консалтинг и сопровождение', 'sort_order' => 90],
                    ['code' => 'custom', 'name' => 'Кастомное внедрение', 'sort_order' => 100],
                    ['code' => 'other', 'name' => 'Другое', 'sort_order' => 900],
                ],
                'counterparty_types' => [
                    ['code' => 'issuer', 'name' => 'Эмитент', 'sort_order' => 10],
                    ['code' => 'borrower', 'name' => 'Заемщик', 'sort_order' => 20],
                    ['code' => 'investor', 'name' => 'Инвестор', 'sort_order' => 30],
                    ['code' => 'platform', 'name' => 'Платформа', 'sort_order' => 40],
                    ['code' => 'regulator', 'name' => 'Регулятор', 'sort_order' => 50],
                    ['code' => 'partner', 'name' => 'Партнер', 'sort_order' => 60],
                    ['code' => 'provider', 'name' => 'Провайдер сервиса', 'sort_order' => 70],
                ],
            ],
            'territorial' => [
                'countries' => [
                    ['code' => 'RU', 'name' => 'Россия', 'sort_order' => 10],
                    ['code' => 'KZ', 'name' => 'Казахстан', 'sort_order' => 20],
                    ['code' => 'BY', 'name' => 'Беларусь', 'sort_order' => 30],
                    ['code' => 'AM', 'name' => 'Армения', 'sort_order' => 40],
                    ['code' => 'KG', 'name' => 'Киргизия', 'sort_order' => 50],
                    ['code' => 'US', 'name' => 'США', 'sort_order' => 60],
                    ['code' => 'DE', 'name' => 'Германия', 'sort_order' => 70],
                    ['code' => 'FR', 'name' => 'Франция', 'sort_order' => 80],
                    ['code' => 'GB', 'name' => 'Великобритания', 'sort_order' => 90],
                    ['code' => 'CH', 'name' => 'Швейцария', 'sort_order' => 100],
                    ['code' => 'AE', 'name' => 'ОАЭ', 'sort_order' => 110],
                    ['code' => 'SG', 'name' => 'Сингапур', 'sort_order' => 120],
                ],
                'regulatory_documents' => [
                    ['code' => 'RU_115FZ', 'name' => 'Федеральный закон №115-ФЗ', 'sort_order' => 10],
                    ['code' => 'RU_134FZ', 'name' => 'Федеральный закон №134-ФЗ', 'sort_order' => 20],
                    ['code' => 'RU_230FZ', 'name' => 'Федеральный закон №230-ФЗ', 'sort_order' => 30],
                    ['code' => 'RU_CB_IDENT', 'name' => 'Положение ЦБ РФ об идентификации клиентов', 'sort_order' => 40],
                    ['code' => 'RU_ROSFINMON_GUIDES', 'name' => 'Методические рекомендации Росфинмониторинга', 'sort_order' => 50],
                    ['code' => 'RU_152FZ', 'name' => 'Федеральный закон №152-ФЗ', 'sort_order' => 60],
                    ['code' => 'RU_259FZ', 'name' => 'Федеральный закон №259-ФЗ', 'sort_order' => 70],
                    ['code' => 'RU_289FZ', 'name' => 'Федеральный закон №289-ФЗ', 'sort_order' => 80],
                    ['code' => 'RU_187FZ', 'name' => 'Федеральный закон №187-ФЗ', 'sort_order' => 90],
                    ['code' => 'RU_GOST_57580_1_2017', 'name' => 'ГОСТ Р 57580.1-2017', 'sort_order' => 100],
                    ['code' => 'RU_GOST_34_10_2018', 'name' => 'ГОСТ Р 34.10-2018', 'sort_order' => 105],
                    ['code' => 'RU_GOST_34_11_2018', 'name' => 'ГОСТ Р 34.11-2018', 'sort_order' => 106],
                    ['code' => 'RU_GOST_34_12_2018', 'name' => 'ГОСТ Р 34.12-2018', 'sort_order' => 107],
                    ['code' => 'EU_AML4_2015_849', 'name' => 'Директива (ЕС) 2015/849 (4AMLD)', 'sort_order' => 110],
                    ['code' => 'EU_AML5', 'name' => 'Пятая директива ЕС по AML (5AMLD)', 'sort_order' => 120],
                    ['code' => 'EU_AML6_6AMLD', 'name' => 'Шестая директива ЕС по AML (6AMLD)', 'sort_order' => 130],
                    ['code' => 'EU_AMLR', 'name' => 'Регламент ЕС по AML (AMLR)', 'sort_order' => 140],
                    ['code' => 'EU_GDPR_2016_679', 'name' => 'GDPR (Регламент (ЕС) 2016/679)', 'sort_order' => 150],
                    ['code' => 'INT_FATF_RECS', 'name' => 'Рекомендации FATF', 'sort_order' => 200],
                    ['code' => 'INT_SANCTIONS_LISTS', 'name' => 'Международные санкционные списки', 'sort_order' => 210],
                ],
            ],
        ];
    }
}
