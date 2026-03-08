<?php

namespace Database\Seeders;

use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Database\Seeder;

/**
 * Заполнение справочников стандартными значениями (где они однозначны).
 * Запускать после RefDictionaryGroupsSeeder и RefDictionariesSeeder.
 */
class RefDictionaryItemsSeeder extends Seeder
{
    private function dict(string $groupCode, string $dictCode): ?RefDictionary
    {
        return RefDictionary::whereHas('group', fn ($q) => $q->where('code', $groupCode))
            ->where('code', $dictCode)
            ->first();
    }

    private function add(string $groupCode, string $dictCode, array $items): void
    {
        $dict = $this->dict($groupCode, $dictCode);
        if (! $dict) {
            return;
        }
        foreach ($items as $idx => $row) {
            $sortOrder = $row['sort_order'] ?? (is_int($idx) ? ($idx + 1) * 10 : 0);
            $code = $row['code'] ?? $row[0];
            $name = $row['name'] ?? $row[1];
            $description = $row['description'] ?? $row[2] ?? null;
            RefDictionaryItem::firstOrCreate(
                ['ref_dictionary_id' => $dict->id, 'code' => $code],
                ['name' => $name, 'description' => $description, 'sort_order' => $sortOrder, 'is_active' => true]
            );
        }
    }

    public function run(): void
    {
        $this->add('economic', 'investment_stages', [
            ['code' => 'pre_seed', 'name' => 'Предпосев', 'description' => 'Идея, прототип, поиск продукта.', 'sort_order' => 10],
            ['code' => 'seed', 'name' => 'Seed', 'description' => 'Посевное финансирование.', 'sort_order' => 20],
            ['code' => 'series_a', 'name' => 'Series A', 'description' => 'Ранняя стадия роста.', 'sort_order' => 30],
            ['code' => 'series_b', 'name' => 'Series B', 'description' => 'Масштабирование.', 'sort_order' => 40],
            ['code' => 'series_c', 'name' => 'Series C', 'description' => 'Поздняя стадия роста.', 'sort_order' => 50],
            ['code' => 'pre_ipo', 'name' => 'Пре-IPO', 'description' => 'Подготовка к выходу на биржу.', 'sort_order' => 60],
            ['code' => 'ipo', 'name' => 'IPO', 'description' => 'Публичное размещение.', 'sort_order' => 70],
            ['code' => 'post_ipo', 'name' => 'Пост-IPO', 'description' => 'После публичного размещения.', 'sort_order' => 80],
        ]);

        $this->add('economic', 'deal_statuses', [
            ['code' => 'draft', 'name' => 'Черновик', 'description' => 'Сделка в подготовке.', 'sort_order' => 10],
            ['code' => 'under_review', 'name' => 'На рассмотрении', 'description' => 'На проверке/согласовании.', 'sort_order' => 20],
            ['code' => 'approved', 'name' => 'Одобрена', 'description' => 'Сделка одобрена.', 'sort_order' => 30],
            ['code' => 'in_progress', 'name' => 'В исполнении', 'description' => 'Средства переведены, обязательства исполняются.', 'sort_order' => 40],
            ['code' => 'partially_completed', 'name' => 'Частично исполнена', 'description' => 'Часть обязательств выполнена.', 'sort_order' => 50],
            ['code' => 'completed', 'name' => 'Завершена', 'description' => 'Сделка полностью исполнена.', 'sort_order' => 60],
            ['code' => 'rejected', 'name' => 'Отклонена', 'description' => 'Отказ в сделке.', 'sort_order' => 70],
            ['code' => 'cancelled', 'name' => 'Отменена', 'description' => 'Сделка отменена.', 'sort_order' => 80],
        ]);

        $this->add('economic', 'funding_types', [
            ['code' => 'equity', 'name' => 'Долевое финансирование', 'description' => 'Вложение в капитал (доли, акции).', 'sort_order' => 10],
            ['code' => 'debt', 'name' => 'Долговое финансирование', 'description' => 'Займы, кредиты.', 'sort_order' => 20],
            ['code' => 'convertible', 'name' => 'Конвертируемый займ', 'description' => 'Займ с правом конвертации в долю.', 'sort_order' => 30],
            ['code' => 'grant', 'name' => 'Грант', 'description' => 'Безвозмездное финансирование.', 'sort_order' => 40],
            ['code' => 'rwa', 'name' => 'RWA-структуры', 'description' => 'Токенизация реальных активов.', 'sort_order' => 50],
            ['code' => 'revenue_share', 'name' => 'Ревеню-шеринг', 'description' => 'Разделение выручки.', 'sort_order' => 60],
        ]);

        $this->add('economic', 'funding_sources', [
            ['code' => 'venture_fund', 'name' => 'Венчурный фонд', 'description' => null, 'sort_order' => 10],
            ['code' => 'angel', 'name' => 'Частный инвестор (ангел)', 'description' => null, 'sort_order' => 20],
            ['code' => 'bank', 'name' => 'Банк', 'description' => null, 'sort_order' => 30],
            ['code' => 'corporate', 'name' => 'Корпоративный инвестор', 'description' => null, 'sort_order' => 40],
            ['code' => 'government', 'name' => 'Государственная программа', 'description' => null, 'sort_order' => 50],
            ['code' => 'crowdfunding', 'name' => 'Краудфандинг', 'description' => null, 'sort_order' => 60],
        ]);

        $this->add('economic', 'investment_types', [
            ['code' => 'direct_equity', 'name' => 'Прямое вложение в капитал', 'description' => null, 'sort_order' => 10],
            ['code' => 'convertible_instrument', 'name' => 'Конвертируемый инструмент', 'description' => null, 'sort_order' => 20],
            ['code' => 'project_finance', 'name' => 'Проектное финансирование', 'description' => null, 'sort_order' => 30],
            ['code' => 'syndicated_loan', 'name' => 'Синдицированное кредитование', 'description' => null, 'sort_order' => 40],
            ['code' => 'tokens', 'name' => 'Покупка токенов / цифровых активов', 'description' => null, 'sort_order' => 50],
            ['code' => 'secondary', 'name' => 'Вторичная сделка', 'description' => 'Покупка доли/инструмента у существующего владельца.', 'sort_order' => 60],
        ]);

        $this->add('economic', 'currencies', [
            ['code' => 'RUB', 'name' => 'Российский рубль', 'description' => null, 'sort_order' => 10],
            ['code' => 'USD', 'name' => 'Доллар США', 'description' => null, 'sort_order' => 20],
            ['code' => 'EUR', 'name' => 'Евро', 'description' => null, 'sort_order' => 30],
            ['code' => 'KZT', 'name' => 'Казахстанский тенге', 'description' => null, 'sort_order' => 40],
            ['code' => 'BYN', 'name' => 'Белорусский рубль', 'description' => null, 'sort_order' => 50],
            ['code' => 'USDT', 'name' => 'USDT (стейблкоин)', 'description' => null, 'sort_order' => 60],
            ['code' => 'USDC', 'name' => 'USDC (стейблкоин)', 'description' => null, 'sort_order' => 70],
        ]);

        $this->add('projects', 'project_statuses', [
            ['code' => 'idea', 'name' => 'Идея', 'description' => 'Формулировка концепции.', 'sort_order' => 10],
            ['code' => 'analysis', 'name' => 'Предварительный анализ', 'description' => 'Исследование целесообразности.', 'sort_order' => 20],
            ['code' => 'backlog', 'name' => 'Воронка / бэклог', 'description' => 'В планах, в очереди.', 'sort_order' => 30],
            ['code' => 'in_development', 'name' => 'В разработке', 'description' => 'Активная разработка.', 'sort_order' => 40],
            ['code' => 'pilot', 'name' => 'Пилот', 'description' => 'Пилотная эксплуатация.', 'sort_order' => 50],
            ['code' => 'production', 'name' => 'Промышленная эксплуатация', 'description' => 'Продакшен.', 'sort_order' => 60],
            ['code' => 'scaling', 'name' => 'Масштабирование', 'description' => 'Рост и расширение.', 'sort_order' => 70],
            ['code' => 'suspended', 'name' => 'Приостановлен', 'description' => 'Временно приостановлен.', 'sort_order' => 80],
            ['code' => 'completed', 'name' => 'Завершён', 'description' => 'Проект закрыт.', 'sort_order' => 90],
        ]);

        $this->add('regulation_risk', 'risk_levels', [
            ['code' => 'low', 'name' => 'Низкий', 'description' => null, 'sort_order' => 10],
            ['code' => 'moderate', 'name' => 'Умеренный', 'description' => null, 'sort_order' => 20],
            ['code' => 'elevated', 'name' => 'Повышенный', 'description' => null, 'sort_order' => 30],
            ['code' => 'high', 'name' => 'Высокий', 'description' => null, 'sort_order' => 40],
            ['code' => 'critical', 'name' => 'Критический', 'description' => null, 'sort_order' => 50],
        ]);

        $this->add('regulation_risk', 'reporting_frequency', [
            ['code' => 'monthly', 'name' => 'Ежемесячно', 'description' => null, 'sort_order' => 10],
            ['code' => 'quarterly', 'name' => 'Ежеквартально', 'description' => null, 'sort_order' => 20],
            ['code' => 'annually', 'name' => 'Ежегодно', 'description' => null, 'sort_order' => 30],
        ]);

        $this->add('regulation_risk', 'measurement_units', [
            ['code' => 'pct', 'name' => 'Проценты (%)', 'description' => null, 'sort_order' => 10],
            ['code' => 'RUB', 'name' => 'Рубли (RUB)', 'description' => null, 'sort_order' => 20],
            ['code' => 'USD', 'name' => 'Доллары (USD)', 'description' => null, 'sort_order' => 30],
            ['code' => 'EUR', 'name' => 'Евро (EUR)', 'description' => null, 'sort_order' => 40],
            ['code' => 'tokens', 'name' => 'Токены', 'description' => null, 'sort_order' => 50],
            ['code' => 'units', 'name' => 'Штуки / единицы', 'description' => null, 'sort_order' => 60],
        ]);

        $this->add('clients_channels', 'client_segments', [
            ['code' => 'b2b', 'name' => 'B2B', 'description' => 'Бизнес для бизнеса.', 'sort_order' => 10],
            ['code' => 'b2c', 'name' => 'B2C', 'description' => 'Бизнес для потребителей.', 'sort_order' => 20],
            ['code' => 'b2g', 'name' => 'B2G', 'description' => 'Бизнес для государства.', 'sort_order' => 30],
            ['code' => 'sme', 'name' => 'МСП', 'description' => 'Малый и средний бизнес.', 'sort_order' => 40],
            ['code' => 'corporate', 'name' => 'Крупный корпоративный бизнес', 'description' => null, 'sort_order' => 50],
            ['code' => 'wealth', 'name' => 'Состоятельные клиенты', 'description' => null, 'sort_order' => 60],
            ['code' => 'fi', 'name' => 'Финансовые организации', 'description' => null, 'sort_order' => 70],
            ['code' => 'exchange', 'name' => 'Фин-хабы / биржи', 'description' => null, 'sort_order' => 80],
        ]);

        $this->add('clients_channels', 'service_channels', [
            ['code' => 'web', 'name' => 'Веб-кабинеты', 'description' => null, 'sort_order' => 10],
            ['code' => 'mobile', 'name' => 'Мобильные приложения', 'description' => null, 'sort_order' => 20],
            ['code' => 'api', 'name' => 'API-доступ', 'description' => null, 'sort_order' => 30],
            ['code' => 'white_label', 'name' => 'White-label витрины', 'description' => null, 'sort_order' => 40],
            ['code' => 'partner', 'name' => 'Партнёрские интеграции', 'description' => null, 'sort_order' => 50],
        ]);

        $this->add('clients_channels', 'product_types', [
            ['code' => 'saas', 'name' => 'SaaS-сервис', 'description' => null, 'sort_order' => 10],
            ['code' => 'on_premise', 'name' => 'On-premise решение', 'description' => null, 'sort_order' => 20],
            ['code' => 'white_label', 'name' => 'White-label платформа', 'description' => null, 'sort_order' => 30],
            ['code' => 'custom', 'name' => 'Кастомное внедрение', 'description' => null, 'sort_order' => 40],
            ['code' => 'api_product', 'name' => 'API-продукт', 'description' => null, 'sort_order' => 50],
            ['code' => 'consulting', 'name' => 'Консалтинг / поддержка', 'description' => null, 'sort_order' => 60],
        ]);

        $this->add('clients_channels', 'counterparty_types', [
            ['code' => 'issuer', 'name' => 'Эмитент', 'description' => null, 'sort_order' => 10],
            ['code' => 'borrower', 'name' => 'Заёмщик', 'description' => null, 'sort_order' => 20],
            ['code' => 'investor', 'name' => 'Инвестор', 'description' => null, 'sort_order' => 30],
            ['code' => 'platform', 'name' => 'Платформа', 'description' => null, 'sort_order' => 40],
            ['code' => 'regulator', 'name' => 'Регулятор', 'description' => null, 'sort_order' => 50],
            ['code' => 'partner', 'name' => 'Партнёр', 'description' => null, 'sort_order' => 60],
            ['code' => 'provider', 'name' => 'Провайдер сервиса', 'description' => null, 'sort_order' => 70],
        ]);

        // Регуляторные документы (AML/KYC, ГОСТ, директивы ЕС и т.д.)
        $this->add('territorial', 'regulatory_documents', [
            ['code' => 'RU_115FZ', 'name' => 'Федеральный закон №115-ФЗ', 'description' => '«О противодействии легализации (отмыванию) доходов, полученных преступным путем, и финансированию терроризма» – базовый закон AML/KYC в РФ, определяющий меры контроля, перечень поднадзорных организаций и обязанности по идентификации клиентов.', 'sort_order' => 10],
            ['code' => 'RU_134FZ', 'name' => 'Федеральный закон №134-ФЗ', 'description' => 'Закон, усиливающий требования к идентификации клиентов и контролю операций, внесший изменения в 115-ФЗ и смежные акты (усиление финансового мониторинга, расширение перечня контролируемых операций).', 'sort_order' => 20],
            ['code' => 'RU_230FZ', 'name' => 'Федеральный закон №230-ФЗ', 'description' => 'Регулирует дополнительные аспекты контроля за должниками и информационные обязанности кредитных организаций, дополняя AML/KYC-режим через расширенный обмен данными и требования к кредиторам.', 'sort_order' => 30],
            ['code' => 'RU_CB_IDENT', 'name' => 'Положение ЦБ РФ об идентификации клиентов', 'description' => 'Положение Банка России об идентификации клиентов, представителей, выгодоприобретателей и бенефициарных владельцев в целях 115-ФЗ, устанавливающее порядок KYC для кредитных организаций и НФО.', 'sort_order' => 40],
            ['code' => 'RU_ROSFINMON_GUIDES', 'name' => 'Методические рекомендации Росфинмониторинга', 'description' => 'Разъяснения и методики по применению 115-ФЗ, оценке риска клиентов, ведению внутреннего контроля и формированию сообщений в Росфинмониторинг.', 'sort_order' => 50],
            ['code' => 'RU_152FZ', 'name' => 'Федеральный закон №152-ФЗ', 'description' => '«О персональных данных» – базовый закон РФ о ПДн, регулирующий сбор, хранение, обработку и трансграничную передачу персональных данных клиентов и бенефициаров.', 'sort_order' => 60],
            ['code' => 'RU_259FZ', 'name' => 'Федеральный закон №259-ФЗ', 'description' => 'Закон о цифровых финансовых активах и цифровой валюте, задающий правовой режим для токенов, операторов информационных систем и операторов обмена, в том числе требования по KYC/AML для участников оборота ЦФА.', 'sort_order' => 70],
            ['code' => 'RU_289FZ', 'name' => 'Федеральный закон №289-ФЗ', 'description' => 'Закон о таможенном регулировании, влияющий на идентификацию участников внешнеэкономической деятельности и контроль операций с точки зрения AML/CFT при перемещении товаров и платежей через границу.', 'sort_order' => 80],
            ['code' => 'RU_187FZ', 'name' => 'Федеральный закон №187-ФЗ', 'description' => '«О безопасности критической информационной инфраструктуры РФ» – устанавливает требования к защите ИС и сервисов, отнесённых к КИИ, что затрагивает архитектуру финтех/DeFi-платформ и их комплаенс-контуры.', 'sort_order' => 90],
            ['code' => 'RU_GOST_57580_1_2017', 'name' => 'ГОСТ Р 57580.1-2017', 'description' => 'Стандарт по защите финансовых организаций от киберугроз, определяющий требования к ИБ, сегментации, журналированию и контролю доступа в финтех-системах.', 'sort_order' => 100],
            ['code' => 'RU_GOST_34_10_2018', 'name' => 'ГОСТ Р 34.10-2018', 'description' => 'Национальный стандарт РФ по алгоритмам электронной подписи на эллиптических кривых, используется для реализации квалифицированной и неквалифицированной электронной подписи.', 'sort_order' => 105],
            ['code' => 'RU_GOST_34_11_2018', 'name' => 'ГОСТ Р 34.11-2018', 'description' => 'Национальный стандарт РФ по криптографической хэш-функции, применяемый в системах электронной подписи и защите информации.', 'sort_order' => 106],
            ['code' => 'RU_GOST_34_12_2018', 'name' => 'ГОСТ Р 34.12-2018', 'description' => 'Национальный стандарт РФ по блочным шифрам (Кузнечик, Магма), определяющий алгоритмы симметричного шифрования для защиты данных.', 'sort_order' => 107],
            ['code' => 'EU_AML4_2015_849', 'name' => 'Директива (ЕС) 2015/849 (4AMLD)', 'description' => 'Четвёртая директива ЕС по AML, направленная на предотвращение использования финансовой системы для отмывания денег и финансирования терроризма, установила риск-ориентированный подход и единые минимальные стандарты KYC.', 'sort_order' => 110],
            ['code' => 'EU_AML5', 'name' => 'Пятая директива ЕС по AML (5AMLD)', 'description' => 'Расширила сферу регулирования, включая крипто-провайдеров, усилила требования к бенефициарным реестрам и дистанционной идентификации клиентов.', 'sort_order' => 120],
            ['code' => 'EU_AML6_6AMLD', 'name' => 'Шестая директива ЕС по AML (6AMLD)', 'description' => 'Уточнила состав предикатных преступлений, усилила ответственность за AML-нарушения и гармонизировала санкции в странах ЕС.', 'sort_order' => 130],
            ['code' => 'EU_AMLR', 'name' => 'Регламент ЕС по AML (AMLR)', 'description' => 'Общеевропейский регламент, вводящий унифицированные требования AML/KYC и централизованный надзор через создаваемый орган AMLA.', 'sort_order' => 140],
            ['code' => 'EU_GDPR_2016_679', 'name' => 'GDPR (Регламент (ЕС) 2016/679)', 'description' => 'Общий регламент ЕС по защите данных, устанавливающий требования к обработке персональных данных резидентов ЕС и влияющий на KYC/AML-процессы при работе с европейскими клиентами.', 'sort_order' => 150],
            ['code' => 'INT_FATF_RECS', 'name' => 'Рекомендации FATF', 'description' => 'Международный стандарт AML/CFT, определяющий 40 рекомендаций по KYC, мониторингу транзакций, санкционным спискам и обмену информацией для юрисдикций.', 'sort_order' => 200],
            ['code' => 'INT_SANCTIONS_LISTS', 'name' => 'Международные санкционные списки', 'description' => 'Режимы проверки клиентов по санкционным и террористическим спискам (ООН, ЕС, США и др.), обязательные в составе процедур AML/KYC и мониторинга операций.', 'sort_order' => 210],
        ]);

        // Страны — базовый набор (ЕАЭС + основные)
        $countries = $this->dict('territorial', 'countries');
        if ($countries) {
            $list = [
                ['code' => 'RU', 'name' => 'Россия', 'description' => 'ЕАЭС. ISO 3166-1 alpha-2: RU.', 'sort_order' => 10],
                ['code' => 'KZ', 'name' => 'Казахстан', 'description' => 'ЕАЭС.', 'sort_order' => 20],
                ['code' => 'BY', 'name' => 'Беларусь', 'description' => 'ЕАЭС.', 'sort_order' => 30],
                ['code' => 'AM', 'name' => 'Армения', 'description' => 'ЕАЭС.', 'sort_order' => 40],
                ['code' => 'KG', 'name' => 'Киргизия', 'description' => 'ЕАЭС.', 'sort_order' => 50],
                ['code' => 'US', 'name' => 'США', 'description' => null, 'sort_order' => 60],
                ['code' => 'DE', 'name' => 'Германия', 'description' => 'ЕС.', 'sort_order' => 70],
                ['code' => 'FR', 'name' => 'Франция', 'description' => 'ЕС.', 'sort_order' => 80],
                ['code' => 'GB', 'name' => 'Великобритания', 'description' => null, 'sort_order' => 90],
                ['code' => 'CH', 'name' => 'Швейцария', 'description' => null, 'sort_order' => 100],
                ['code' => 'AE', 'name' => 'ОАЭ', 'description' => null, 'sort_order' => 110],
                ['code' => 'SG', 'name' => 'Сингапур', 'description' => null, 'sort_order' => 120],
            ];
            foreach ($list as $row) {
                RefDictionaryItem::firstOrCreate(
                    ['ref_dictionary_id' => $countries->id, 'code' => $row['code']],
                    ['name' => $row['name'], 'description' => $row['description'], 'sort_order' => $row['sort_order'], 'is_active' => true]
                );
            }
        }

        // Категории рисков
        $this->add('regulation_risk', 'risk_categories', [
            ['code' => 'market', 'name' => 'Рыночный', 'description' => null, 'sort_order' => 10],
            ['code' => 'credit', 'name' => 'Кредитный', 'description' => null, 'sort_order' => 20],
            ['code' => 'operational', 'name' => 'Операционный', 'description' => null, 'sort_order' => 30],
            ['code' => 'technology', 'name' => 'Технологический', 'description' => null, 'sort_order' => 40],
            ['code' => 'legal', 'name' => 'Юридический / регуляторный', 'description' => null, 'sort_order' => 50],
            ['code' => 'cyber', 'name' => 'Кибер-риск', 'description' => null, 'sort_order' => 60],
            ['code' => 'reputation', 'name' => 'Репутационный', 'description' => null, 'sort_order' => 70],
            ['code' => 'sanctions', 'name' => 'Санкционный', 'description' => null, 'sort_order' => 80],
        ]);

        // Инвестиционный рейтинг (шкала A–E)
        $rating = $this->dict('regulation_risk', 'investment_rating');
        if ($rating) {
            foreach (['A' => 'Высокий', 'B' => 'Выше среднего', 'C' => 'Средний', 'D' => 'Ниже среднего', 'E' => 'Низкий'] as $code => $name) {
                RefDictionaryItem::firstOrCreate(
                    ['ref_dictionary_id' => $rating->id, 'code' => $code],
                    ['name' => "Рейтинг {$code} ({$name})", 'description' => null, 'sort_order' => ord($code) * 10, 'is_active' => true]
                );
            }
        }
    }
}
