<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'view loans',
            'manage loans',
            'view users',
            'manage users',
            'manage roles',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles
        $clientRole = Role::firstOrCreate(['name' => 'client']);
        $clientRole->syncPermissions(['view loans']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(['view loans', 'manage loans', 'view users']);

        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->syncPermissions($permissions);

        // Default super-admin account
        $superAdmin = User::firstOrCreate(
            ['email' => 'contact@aureliscapital.online'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('Credixa@2025!'),
                'type'     => 'staff',
            ]
        );
        $superAdmin->syncRoles(['super-admin']);

        // Default admin account
        $admin = User::firstOrCreate(
            ['email' => 'admin@aureliscapital.online'],
            [
                'name'     => 'AdminAURELIS CAPITAL GROUP',
                'password' => Hash::make('Admin@2025!'),
                'type'     => 'staff',
            ]
        );
        $admin->syncRoles(['admin']);

        $this->command->info('Roles, permissions and default accounts created.');
        $this->command->table(
            ['Role', 'Email', 'Password (change immediately)'],
            [
                ['super-admin', 'contact@aureliscapital.online', 'Credixa@2025!'],
                ['admin',       'admin@aureliscapital.online',   'Admin@2025!'],
            ]
        );
    }
}
