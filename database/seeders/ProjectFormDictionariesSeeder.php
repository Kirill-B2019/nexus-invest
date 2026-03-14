<?php

namespace Database\Seeders;

use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Database\Seeder;

/**
 * Элементы справочников для формы проекта (шаг 1).
 * Запускать после RefDictionaryGroupsSeeder и RefDictionariesSeeder.
 */
class ProjectFormDictionariesSeeder extends Seeder
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
            RefDictionaryItem::firstOrCreate(
                ['ref_dictionary_id' => $dict->id, 'code' => $code],
                ['name' => $name, 'sort_order' => $sortOrder, 'is_active' => true]
            );
        }
    }

    public function run(): void
    {
        $this->add('sectors', 'sector_directions', [
            ['code' => 'fintech', 'name' => 'Финтех', 'sort_order' => 10],
            ['code' => 'defi', 'name' => 'DeFi', 'sort_order' => 20],
            ['code' => 'digital_assets', 'name' => 'Цифровые активы', 'sort_order' => 30],
            ['code' => 'rwa', 'name' => 'RWA', 'sort_order' => 40],
            ['code' => 'infrastructure', 'name' => 'Инфраструктура', 'sort_order' => 50],
            ['code' => 'kyc_aml', 'name' => 'KYC/AML', 'sort_order' => 60],
            ['code' => 'iot', 'name' => 'IoT', 'sort_order' => 70],
            ['code' => 'other', 'name' => 'Другое', 'sort_order' => 100],
        ]);

        $this->add('sectors', 'industries', [
            ['code' => 'banking', 'name' => 'Банковские услуги', 'sort_order' => 10],
            ['code' => 'asset_management', 'name' => 'Управление активами', 'sort_order' => 20],
            ['code' => 'sme_lending', 'name' => 'МСП-кредитование', 'sort_order' => 30],
            ['code' => 'insurance', 'name' => 'Страхование', 'sort_order' => 40],
            ['code' => 'real_estate', 'name' => 'Недвижимость', 'sort_order' => 50],
            ['code' => 'production', 'name' => 'Производство', 'sort_order' => 60],
            ['code' => 'it', 'name' => 'IT', 'sort_order' => 70],
            ['code' => 'agriculture', 'name' => 'Сельское хозяйство', 'sort_order' => 80],
            ['code' => 'energy', 'name' => 'Энергетика', 'sort_order' => 90],
            ['code' => 'logistics', 'name' => 'Логистика', 'sort_order' => 100],
            ['code' => 'other', 'name' => 'Другое', 'sort_order' => 200],
        ]);

        $this->add('projects', 'project_types', [
            ['code' => 'blockchain_platform', 'name' => 'Блокчейн-платформа', 'sort_order' => 10],
            ['code' => 'dex', 'name' => 'DEX', 'sort_order' => 20],
            ['code' => 'kyc_service', 'name' => 'KYC-сервис', 'sort_order' => 30],
            ['code' => 'mobile_app', 'name' => 'Мобильное приложение', 'sort_order' => 40],
            ['code' => 'api_gateway', 'name' => 'API-шлюз', 'sort_order' => 50],
            ['code' => 'tokenization', 'name' => 'Токенизация активов', 'sort_order' => 60],
            ['code' => 'lending', 'name' => 'Кредитование / займы', 'sort_order' => 70],
            ['code' => 'other', 'name' => 'Другое', 'sort_order' => 100],
        ]);

        $this->add('projects', 'project_categories', [
            ['code' => 'base_platform', 'name' => 'Базовая платформа', 'sort_order' => 10],
            ['code' => 'client_product', 'name' => 'Клиентский продукт', 'sort_order' => 20],
            ['code' => 'internal_service', 'name' => 'Внутренний сервис', 'sort_order' => 30],
            ['code' => 'research', 'name' => 'Исследовательский проект', 'sort_order' => 40],
            ['code' => 'other', 'name' => 'Другое', 'sort_order' => 100],
        ]);
    }
}
