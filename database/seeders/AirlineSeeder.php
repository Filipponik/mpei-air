<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload = [
            [
                'code' => 'S7',
                'name' => 'S7 Airlines',
            ],
            [
                'code' => 'SU',
                'name' => 'Аэрофлот',
            ],
            [
                'code' => 'KC',
                'name' => 'Эйр Астана',
            ],
            [
                'code' => 'TK',
                'name' => 'Turkish Airlines',
            ],
            [
                'code' => 'EK',
                'name' => 'Emirates',
            ],
            [
                'code' => 'QR',
                'name' => 'Qatar Airways',
            ],
            [
                'code' => 'ATW',
                'name' => 'Air Antwerp',
            ],
            [
                'code' => 'PVG',
                'name' => 'Privilege Style',
            ],
            [
                'code' => 'JL',
                'name' => 'Japan Airlines International',
            ],
        ];
        DB::table('airlines')->insert($payload);
    }
}
