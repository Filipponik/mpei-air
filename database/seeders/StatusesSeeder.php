<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
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
                'name' => 'Запланирован',
            ],
            [
                'name' => 'Идет посадка',
            ],
            [
                'name' => 'Отменен',
            ],
            [
                'name' => 'Регистрация начата',
            ],
            [
                'name' => 'Регистрация завершена',
            ],
            [
                'name' => 'Завершен',
            ],
        ];
        DB::table('flight_statuses')->insert($payload);

        $payload = [
            [
                'name' => 'Свободен',
            ],
            [
                'name' => 'Забронирован',
            ],
            [
                'name' => 'Занят',
            ],
        ];
        DB::table('ticket_statuses')->insert($payload);
    }
}
