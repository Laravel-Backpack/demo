<?php

use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;

class PermissionManagerTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::all()->isEmpty()) {
            Role::create(['name' => 'superadmin', 'guard_name' => 'web'])->users()->sync([1]);
            Role::create(['name' => 'admin', 'guard_name' => 'web']);
            Role::create(['name' => 'member', 'guard_name' => 'web']);
        }

        if (Permission::all()->isEmpty()) {
            Permission::create(['name' => 'manage news', 'guard_name' => 'web'])->roles()->sync([1, 2]);
            Permission::create(['name' => 'manage pages', 'guard_name' => 'web'])->roles()->sync([1, 2]);
            Permission::create(['name' => 'manage menu items', 'guard_name' => 'web'])->roles()->sync([1, 2]);
            Permission::create(['name' => 'manage users', 'guard_name' => 'web'])->roles()->sync([1, 2]);
            Permission::create(['name' => 'manage roles', 'guard_name' => 'web'])->roles()->sync([1]);
            Permission::create(['name' => 'manage permissions', 'guard_name' => 'web'])->roles()->sync([1]);
            Permission::create(['name' => 'file manager', 'guard_name' => 'web'])->roles()->sync([1, 2]);
            Permission::create(['name' => 'logs', 'guard_name' => 'web'])->roles()->sync([1]);
            Permission::create(['name' => 'backups', 'guard_name' => 'web'])->roles()->sync([1]);
        }
    }
}
