<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $seller = Role::create(['name' => 'ventas']);
        $dispatcher = Role::create(['name' => 'despacho']);
        $stocker = Role::create(['name' => 'almacén']);


        Permission::create(['name' => 'dashboard'])->syncRoles([$admin, $seller, $dispatcher, $stocker]);
        Permission::create(['name' => 'categories'])->syncRoles([$admin]);
        Permission::create(['name' => 'conditions'])->syncRoles([$admin]);
        Permission::create(['name' => 'clients'])->syncRoles([$admin]);
        Permission::create(['name' => 'status'])->syncRoles([$admin]);
        Permission::create(['name' => 'orders'])->syncRoles([$admin, $dispatcher]);
        Permission::create(['name' => 'products'])->syncRoles([$admin, $stocker]);
        Permission::create(['name' => 'pos'])->syncRoles([$admin, $seller]);
        Permission::create(['name' => 'users '])->syncRoles([$admin]);
        Permission::create(['name' => 'cities '])->syncRoles([$admin]);
    }
}

// ########################################################################
// $roles = [
//     ['name' => 'admin'],
//     ['name' => 'seller'],
//     ['name' => 'tracking'],
// ];

// foreach ($roles as $role) {
//     $roleExist = Role::whereName($role)->first();
//     if (!$roleExist) {
//         Role::create(['name' => $role['name']]);
//     }
// }

// $adminRole = Role::whereName('admin')->first();

// $permissions = [
//     'view user',
//     'create user',
//     'edit user',
//     'delete user',

//     'view city',
//     'create city',
//     'edit city',
//     'delete city',

//     'view category',
//     'create category',
//     'edit category',
//     'delete category',

//     'view condition',
//     'create condition',
//     'edit condition',
//     'delete condition',

//     'view client',
//     'create client',
//     'edit client',
//     'delete client',

//     'view status',
//     'create status',
//     'edit status',
//     'delete status',

//     'view order',
//     'create order',
//     'edit order',
//     'delete order',

//     'view product',
//     'create product',
//     'edit product',
//     'delete product',

//     'view pos'
// ];

// foreach ($permissions as $permission) {
//     $permissionExist = Permission::whereName($permission)->first();
//     if (!$permissionExist) {
//         $permissionExist = Permission::create(['name' => $permission]);
//     }
//     $adminRole->givePermissionTo($permissionExist->name);
// }

// $adminUser = User::whereEmail('admin@mail.com')->first();
// $adminUser->assignRole('admin');


// $sellerPermissions = [
//     'view order',
//     'create order',
//     'edit order',
//     'delete order',
//     'view pos'
// ];

// $sellerRole = Role::whereName('seller')->first();

// foreach ($sellerPermissions as $permission) {
//     $permissionExist = Permission::whereName($permission)
//         ->first();
//     if (!$permissionExist) {
//         $permissionExist = Permission::create(['name' => $permission]);
//     }
//     $sellerRole->givePermissionTo($permissionExist->name);
// }

// $trackingPermissions = [
//     'view order',
//     'edit order'
// ];

// $trackingRole = Role::whereName('tracking')->first();

// foreach ($trackingPermissions as $permission) {
//     $permissionExist = Permission::whereName($permission)
//         ->first();
//     if (!$permissionExist) {
//         $permissionExist = Permission::create(['name' => $permission]);
//     }
//     $trackingRole->givePermissionTo($permissionExist->name);
// }
