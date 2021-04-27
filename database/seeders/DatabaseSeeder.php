<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AirportSeeder::class);
        $this->call(AirlineSeeder::class);
        $this->call(PlaneSeeder::class);
        $this->call(StatusesSeeder::class);
        $this->call(FlightSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
