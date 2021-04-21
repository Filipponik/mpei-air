<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        $payload = [];
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '1234567890';
        for ($i = 0; $i < $count; $i++) {
            $time_from = (rand(1, 2) == 1)
                ? now()->subDays(rand(1,30))
                : now()->addDays(rand(1,30));
            $time_to = $time_from->copy()->addMinutes(rand(120, 600));
            $code = rand(1,2) == 1
                ? mb_substr($alphabet, rand(0, 25), 1) . mb_substr($digits, rand(0, 9), 1)
                : mb_substr($alphabet, rand(0, 25), 1) . mb_substr($alphabet, rand(0, 25), 1);
            $payload[] = [
                'code' => $code . ' ' . (string)rand(100, 9999),
                'date_from' => $time_from->format('Y-m-d H:i:s'),
                'date_to' => $time_to->format('Y-m-d H:i:s'),
                'flight_status_id' => rand(1, 5),
                'airport_from_id' => rand(1, 9),
                'airport_to_id' => rand(1, 9),
            ];
        }
        // $payload = [
        //     [
        //         'name_ISO' => 'Russia',
        //         'name' => 'Россия',
        //     ],
        //     [
        //         'name_ISO' => 'USA',
        //         'name' => 'США',
        //     ],
        //     [
        //         'name_ISO' => 'Japan',
        //         'name' => 'Япония',
        //     ],
        //     [
        //         'name_ISO' => 'Ukraine',
        //         'name' => 'Украина',
        //     ]
        // ];
        DB::table('flights')->insert($payload);
    }
}
