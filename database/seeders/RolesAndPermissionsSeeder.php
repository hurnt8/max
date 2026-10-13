<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

        // Comptes par défaut. Adresses et mots de passe se règlent par variables
        // d'environnement (SEED_SUPER_ADMIN_EMAIL, SEED_SUPER_ADMIN_PASSWORD,
        // SEED_ADMIN_EMAIL, SEED_ADMIN_PASSWORD) ; à défaut, un mot de passe
        // aléatoire est généré et affiché une seule fois.
        $superEmail    = env('SEED_SUPER_ADMIN_EMAIL', 'support@mellenthinfoundation.de');
        $superPassword = env('SEED_SUPER_ADMIN_PASSWORD') ?: Str::random(16);
        $adminEmail    = env('SEED_ADMIN_EMAIL', 'noreply@mellenthinfoundation.de');
        $adminPassword = env('SEED_ADMIN_PASSWORD') ?: Str::random(16);

        $superAdmin = User::firstOrCreate(
            ['email' => $superEmail],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make($superPassword),
                'type'     => 'staff',
            ]
        );
        $superAdmin->syncRoles(['super-admin']);

        $admin = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name'     => 'Admin Mellenthin Foundation',
                'password' => Hash::make($adminPassword),
                'type'     => 'staff',
            ]
        );
        $admin->syncRoles(['admin']);

        $this->command->info('Roles, permissions and default accounts created.');
        $this->command->table(
            ['Role', 'Email', 'Password (shown once — change it after first login)'],
            [
                ['super-admin', $superEmail, $superAdmin->wasRecentlyCreated ? $superPassword : '(account already existed)'],
                ['admin',       $adminEmail, $admin->wasRecentlyCreated ? $adminPassword : '(account already existed)'],
            ]
        );
    }
}
