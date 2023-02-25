<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Sin categoría'

        ]);
        Category::create([
            'name' => 'Almacén'

        ]);
        Category::create([
            'name' => 'Aperitivos / Otros'

        ]);
        Category::create([
            'name' => 'Cervezas'

        ]);
        Category::create([
            'name' => 'Galletitas y merienda'

        ]);
        Category::create([
            'name' => 'Gaseosas y saborizadas'

        ]);
        Category::create([
            'name' => 'Limpieza'

        ]);
        Category::create([
            'name' => 'Perfumería'

        ]);

        Category::create([
            'name' => 'Vinos'

        ]);
    }
}
