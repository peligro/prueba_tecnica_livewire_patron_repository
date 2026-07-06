<?php
//database/seeders/PermissionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $createNote = Permission::create(['name' => 'create player note']);
        $viewNotes = Permission::create(['name' => 'view player notes']);

        // Create roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $support = Role::create(['name' => 'support_agent']);
        $support->givePermissionTo(['create player note', 'view player notes']);

        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo(['view player notes']);

        // Create test users
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);
        $adminUser->assignRole('admin');

        $supportUser = User::create([
            'name' => 'Support Agent',
            'email' => 'support@test.com',
            'password' => bcrypt('password')
        ]);
        $supportUser->assignRole('support_agent');

        $viewerUser = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@test.com',
            'password' => bcrypt('password')
        ]);
        $viewerUser->assignRole('viewer');
    }
}