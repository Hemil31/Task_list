<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flight::create([
            'name' => 'Flight 1',
            'destination' => 'Paris',
            'cancelled' => false,
        ]);

        Flight::create([
            'name' => 'Flight 2',
            'destination' => 'Paris',
            'cancelled' => true,
        ]);

        Flight::create([
            'name' => 'Flight 3',
            'destination' => 'New York',
            'cancelled' => false,
        ]);

        Flight::create([
            'name' => 'Flight 4',
            'destination' => 'Paris',
            'cancelled' => false,
        ]);

        Flight::create([
            'name' => 'Flight 5',
            'destination' => 'London',
            'cancelled' => true,
        ]);
    }
}
