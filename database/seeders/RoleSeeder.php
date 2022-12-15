<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role admin jika ada
        $role = Role::findOrCreate('admin');
        //create permission form category jika ada
        $permissionCategory  = Permission::findOrCreate('form category', 'web');
        //create permission form product jika ada
        $permissionProduct = Permission::findOrCreate('form product', 'web');
        //role admin diberikan hask akses form category dan form product
        $role->givePermissionTo($permissionCategory, $permissionProduct);
    }
}