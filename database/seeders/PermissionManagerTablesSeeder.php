<?php

namespace Database\Seeders;

use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PermissionManagerTablesSeeder extends Seeder
{
    protected $roles = [
        'superadmin',
        'admin',
        'member',
    ];

    protected $permissionsRoles = [
        'manage news'        => [1, 2],
        'manage pages'       => [1, 2],
        'manage menu items'  => [1, 2],
        'manage users'       => [1, 2],
        'manage roles'       => [1],
        'manage permissions' => [1],
        'file manager'       => [1, 2],
        'logs'               => [1],
        'backups'            => [1],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table(Config::get('permission.table_names.model_has_roles'))->truncate();
        DB::table(Config::get('permission.table_names.role_has_permissions'))->truncate();
        Permission::truncate();
        Role::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($this->roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'web']);
        }

        foreach ($this->permissionsRoles as $permission => $roles) {
            Permission::create(['name' => $permission, 'guard_name' => 'web'])->roles()->sync($roles);
        }

        // Super admin on first user
        Role::find(1)->users()->sync([1]);
    }
}
