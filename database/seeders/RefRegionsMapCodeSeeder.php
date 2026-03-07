<?php

namespace Database\Seeders;

use App\Models\RefDictionary;
use App\Models\RefDictionaryItem;
use Illuminate\Database\Seeder;

/**
 * Заполнение map_code у элементов справочника «Регионы» для синхронизации с картой (RU-MOW, RU-SPE и т.д.).
 * Запускать после RefRegionsRuSeeder и миграции add_map_code_to_ref_dictionary_items.
 */
class RefRegionsMapCodeSeeder extends Seeder
{
    public function run(): void
    {
        $dict = RefDictionary::whereHas('group', fn ($q) => $q->where('code', 'territorial'))
            ->where('code', 'regions')
            ->first();

        if (! $dict) {
            return;
        }

        // map_code (на карте) => code (в справочнике)
        $mapCodeToCode = [
            'RU-MOW' => 'ru-mow',
            'RU-SPE' => 'ru-spb',
            'RU-NEN' => 'ru-nen',
            'RU-YAR' => 'ru-yar',
            'RU-CHE' => 'ru-che',
            'RU-ULY' => 'ru-uly',
            'RU-TYU' => 'ru-tyu',
            'RU-TUL' => 'ru-tul',
            'RU-SVE' => 'ru-sve',
            'RU-RYA' => 'ru-rya',
            'RU-ORL' => 'ru-orl',
            'RU-OMS' => 'ru-oms',
            'RU-NGR' => 'ru-ngr',
            'RU-LIP' => 'ru-lip',
            'RU-KRS' => 'ru-krs',
            'RU-KGN' => 'ru-kgn',
            'RU-KGD' => 'ru-kgd',
            'RU-IVA' => 'ru-iva',
            'RU-BRY' => 'ru-bry',
            'RU-AST' => 'ru-ast',
            'RU-KHA' => 'ru-kha',
            'RU-CE' => 'ru-ce',
            'RU-UD' => 'ru-ud',
            'RU-SE' => 'ru-se',
            'RU-MO' => 'ru-mo',
            'RU-KR' => 'ru-kr',
            'RU-KL' => 'ru-kl',
            'RU-IN' => 'ru-in',
            'RU-AL' => 'ru-alt',
            'RU-BA' => 'ru-ba',
            'RU-AD' => 'ru-ad',
            'RU-CR' => 'ru-cr',
            'RU-SEV' => 'ru-sev',
            'RU-KO' => 'ru-ko',
            'RU-KIR' => 'ru-kir',
            'RU-PNZ' => 'ru-pnz',
            'RU-TAM' => 'ru-tam',
            'RU-MUR' => 'ru-mur',
            'RU-LEN' => 'ru-len',
            'RU-VLG' => 'ru-vlg',
            'RU-KOS' => 'ru-kos',
            'RU-PSK' => 'ru-psk',
            'RU-ARK' => 'ru-ark',
            'RU-YAN' => 'ru-yan',
            'RU-CHU' => 'ru-chu',
            'RU-YEV' => 'ru-yev',
            'RU-TY' => 'ru-ty',
            'RU-SAK' => 'ru-sak',
            'RU-AMU' => 'ru-amu',
            'RU-BU' => 'ru-bu',
            'RU-KK' => 'ru-kk',
            'RU-KEM' => 'ru-kem',
            'RU-NVS' => 'ru-nvs',
            'RU-ALT' => 'ru-alt-krai',
            'RU-DA' => 'ru-da',
            'RU-STA' => 'ru-sta',
            'RU-KB' => 'ru-kb',
            'RU-KC' => 'ru-kc',
            'RU-KDA' => 'ru-kda',
            'RU-ROS' => 'ru-ros',
            'RU-SAM' => 'ru-sam',
            'RU-TA' => 'ru-ta',
            'RU-ME' => 'ru-me',
            'RU-CU' => 'ru-cu',
            'RU-NIZ' => 'ru-niz',
            'RU-VLA' => 'ru-vla',
            'RU-MOS' => 'ru-mos',
            'RU-KLU' => 'ru-klu',
            'RU-BEL' => 'ru-bel',
            'RU-ZAB' => 'ru-zab',
            'RU-PRI' => 'ru-pri',
            'RU-KAM' => 'ru-kam',
            'RU-MAG' => 'ru-mag',
            'RU-SA' => 'ru-sa',
            'RU-KYA' => 'ru-kya',
            'RU-ORE' => 'ru-ore',
            'RU-SAR' => 'ru-sar',
            'RU-VGG' => 'ru-vgg',
            'RU-VOR' => 'ru-vor',
            'RU-SMO' => 'ru-smo',
            'RU-TVE' => 'ru-tve',
            'RU-PER' => 'ru-per',
            'RU-KHM' => 'ru-khm',
            'RU-TOM' => 'ru-tom',
            'RU-IRK' => 'ru-irk',
            'RU-HR' => 'ru-kherson',
            'RU-ZP' => 'ru-zaporozhye',
            'RU-DON' => 'ru-dnr',
            'RU-LUG' => 'ru-lnr',
        ];

        foreach ($mapCodeToCode as $mapCode => $code) {
            RefDictionaryItem::where('ref_dictionary_id', $dict->id)
                ->where('code', $code)
                ->update(['map_code' => $mapCode]);
        }
    }
}
