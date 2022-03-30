<?php

namespace Darius\RolePermissions\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Darius\RolePermissions\Models\Permission::$permissions as $permission) {
            Permission::findOrCreate( $permission);
        }

        foreach (\Darius\RolePermissions\Models\Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }
    }
}
