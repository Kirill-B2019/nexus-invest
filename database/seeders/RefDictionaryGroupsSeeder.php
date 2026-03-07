<?php

namespace Database\Seeders;

use App\Models\RefDictionaryGroup;
use Illuminate\Database\Seeder;

/**
 * Начальные группы справочников: территориальные, экономические и др.
 */
class RefDictionaryGroupsSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['code' => 'territorial', 'name' => 'Территориальные', 'description' => 'География и юрисдикции: регионы, страны, регуляторные режимы.', 'sort_order' => 10],
            ['code' => 'economic', 'name' => 'Экономические', 'description' => 'Финансирование, инвестирование, доходы, валюты.', 'sort_order' => 20],
            ['code' => 'sectors', 'name' => 'Сектора и отрасли', 'description' => 'Направления деятельности и отрасли клиентов.', 'sort_order' => 30],
            ['code' => 'projects', 'name' => 'Классификация проектов', 'description' => 'Категории, типы и статусы проектов.', 'sort_order' => 40],
            ['code' => 'regulation_risk', 'name' => 'Регуляторика и риск', 'description' => 'Регуляторные документы, уровни и категории рисков.', 'sort_order' => 50],
            ['code' => 'clients_channels', 'name' => 'Клиенты и каналы', 'description' => 'Сегменты клиентов, каналы обслуживания, типы продуктов.', 'sort_order' => 60],
            ['code' => 'tech', 'name' => 'Технологии', 'description' => 'Технологический стек, типы токенов и цифровых активов.', 'sort_order' => 70],
        ];

        foreach ($groups as $item) {
            RefDictionaryGroup::firstOrCreate(
                ['code' => $item['code']],
                $item
            );
        }
    }
}
