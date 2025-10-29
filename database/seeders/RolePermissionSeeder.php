<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $viewUsers = Permission::firstOrCreate(['name' => 'view users']);
        $createUsers = Permission::firstOrCreate(['name' => 'create users']);
        $editUsers = Permission::firstOrCreate(['name' => 'edit users']);
        $deleteUsers = Permission::firstOrCreate(['name' => 'delete users']);
        $manageRoles = Permission::firstOrCreate(['name' => 'manage roles']);

        // Assign permissions to roles
        $adminRole->syncPermissions([$viewUsers, $createUsers, $editUsers, $deleteUsers, $manageRoles]);
        $userRole->syncPermissions([$viewUsers]);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password')
            ]
        );
        $admin->syncRoles(['admin']);

        // Create regular user
        $normalUser = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password')
            ]
        );
        $normalUser->syncRoles(['user']);
    }
}


