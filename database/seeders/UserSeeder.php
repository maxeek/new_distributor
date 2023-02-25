<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('admin');

        User::create([
            'name' => 'Maxeek',
            'email' => 'maxi@intertecno.com.ar',
            'password' => bcrypt('12345678')
            // ]);
        ])->assignRole('admin');

        User::create([
            'name' => 'Natalia',
            'email' => 'ventas@ventas.com',
            'password' => bcrypt('12345678')
            // ]);
        ])->assignRole('ventas');

        User::create([
            'name' => 'Jose',
            'email' => 'despacho@despacho.com',
            'password' => bcrypt('12345678')
            // ]);
        ])->assignRole('despacho');

        User::create([
            'name' => 'Juan',
            'email' => 'almacen@almacen.com',
            'password' => bcrypt('12345678')
            // ]);
        ])->assignRole('almacén');
    }
}
