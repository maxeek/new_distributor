<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // City::factory(10)->create();


        City::create([
            'name' => 'Ameghino'

        ]);
        City::create([
            'name' => 'General Pinto'

        ]);
        City::create([
            'name' => 'General Villegas'

        ]);
    }
}
