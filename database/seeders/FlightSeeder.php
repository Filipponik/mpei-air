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
        $count = 5000;
        $payload = [];
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '1234567890';
        for ($i = 0; $i < $count; $i++) {
            if (rand(1, 2) == 1) {
                $time_from = now()->subDays(rand(1,30));
                $status = 6;
            } else {
                $time_from = now()->addDays(rand(1,30));
                $status = rand(1, 5);
            }

            $time_to = $time_from->copy()->addMinutes(rand(120, 600));
            $code = rand(1,2) == 1
                ? mb_substr($alphabet, rand(0, 25), 1) . mb_substr($digits, rand(0, 9), 1)
                : mb_substr($alphabet, rand(0, 25), 1) . mb_substr($alphabet, rand(0, 25), 1);
            $code .= ' ' . ($i + 5000);
            $payload[] = [
                'code' => $code,
                'date_from' => $time_from->format('Y-m-d H:i:s'),
                'date_to' => $time_to->format('Y-m-d H:i:s'),
                'flight_status_id' => $status,
                'airport_from_id' => rand(1, 9),
                'airport_to_id' => rand(1, 9),
                'plane_id' => rand(1, 500),
            ];
        }
        
        DB::table('flights')->insert($payload);
    }
}
