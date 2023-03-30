<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'user']);

        // Define permissions
        Permission::create(['name' => 'create club']);
        Permission::create(['name' => 'edit club']);
        Permission::create(['name' => 'delete club']);

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo(['create club', 'edit club', 'delete club']);
        Role::findByName('writer')->givePermissionTo(['create club', 'edit club']);
    }
}
