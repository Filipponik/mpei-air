<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // filling countries
        $payload = [
            [
                'name_ISO' => 'Russia',
                'name' => 'Россия',
            ],
            [
                'name_ISO' => 'USA',
                'name' => 'США',
            ],
            [
                'name_ISO' => 'Japan',
                'name' => 'Япония',
            ],
            [
                'name_ISO' => 'Ukraine',
                'name' => 'Украина',
            ]
        ];
        DB::table('countries')->insert($payload);

        // filling cities
        $payload = [
            [
                'country_id' => 1,
                'name' => 'Москва',
            ],
            [
                'country_id' => 1,
                'name' => 'Санкт-Петербург',
            ],
            [
                'country_id' => 2,
                'name' => 'Вашингтон',
            ],
            [
                'country_id' => 2,
                'name' => 'Нью-Йорк',
            ],
            [
                'country_id' => 3,
                'name' => 'Токио',
            ],
            [
                'country_id' => 3,
                'name' => 'Осака',
            ],
            [
                'country_id' => 4,
                'name' => 'Львов',
            ],
            [
                'country_id' => 4,
                'name' => 'Киев',
            ],
        ];
        DB::table('cities')->insert($payload);
        
        // filling airports
        $payload = [
            [
                'code' => 'DME',
                'name' => 'Домодедово',
                'city_id' => 1,
            ],
            [
                'code' => 'SVO',
                'name' => 'Шереметьево',
                'city_id' => 1,
            ],
            [
                'code' => 'LED',
                'name' => 'Пулково',
                'city_id' => 2,
            ],
            [
                'code' => 'IAD',
                'name' => 'Даллес',
                'city_id' => 3,
            ],
            [
                'code' => 'JFK',
                'name' => 'Имени Джона Кеннеди',
                'city_id' => 4,
            ],
            [
                'code' => 'HND',
                'name' => 'Токио',
                'city_id' => 5,
            ],
            [
                'code' => 'ITM',
                'name' => 'Осака',
                'city_id' => 6,
            ],
            [
                'code' => 'LWO',
                'name' => 'Львов',
                'city_id' => 7,
            ],
            [
                'code' => 'KBP',
                'name' => 'Борисполь',
                'city_id' => 8,
            ],
        ];
        DB::table('airports')->insert($payload);

    }
}
