<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '1234567890';
        $payload = [];
        for ($i = 0; $i < $count; $i++) {
            $name = '';
            for ($j=0; $j < rand(1,5); $j++) { 
                $name .= mb_substr($alphabet, rand(0, 25), 1);
            }
            $name .= '-' . mb_substr($digits, rand(0, 9), 1) . mb_substr($digits, rand(0, 9), 1);

            $payload[] = [
                'name' => $name,
                'count_econom' => rand(10, 50),
                'count_business' => rand(10, 50),
                'count_first' => rand(10, 50),
            ];

        }
        
        DB::table('plane_models')->insert($payload);

        $payload = [];
        $count = 500;
        for ($i = 0; $i < $count; $i++) {
            $payload[] = [
                'plane_model_id' => rand(1, 9),
                'airline_id' => rand(1, 9),
            ];
        }
        DB::table('planes')->insert($payload);
        
    }
}
