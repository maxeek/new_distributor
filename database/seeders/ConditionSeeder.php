<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Condition::factory(2)->create();
        Condition::create([
            'name' => 'Monotributo',
            'aliquot' => 0
        ]);

        Condition::create([
            'name' => 'Responsable Inscripto',
            'aliquot' => 21
        ]);
    }
}
