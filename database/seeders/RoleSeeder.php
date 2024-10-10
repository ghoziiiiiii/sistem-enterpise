<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $operator = Role::updateOrCreate(['name' => 'operator']);
        
        // Assign all permissions to admin role
        $admin->givePermissionTo(Permission::all());

        // Assign specific permissions to operator role
        $operator->givePermissionTo([
            'show users',
            'add users',
            'edit users',
            'show department',
            'add department',
            'edit department',
        ]);
    }
}