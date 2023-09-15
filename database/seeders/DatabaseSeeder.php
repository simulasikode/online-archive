<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //\App\Models\User::factory()->create([
        //    'name' => 'keppittalis',
        //    'email' => 'admin@example.com',
        //]);

        $this->call([AdminRoleSeeder::class]);
        $this->call([AdminSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([UserRoleSeeder::class]);

        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Create roles
        $roles = [
            'user',
            'admin',
            // Add more roles as needed
        ];

        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }

        // Assign permissions to roles
        $role = Role::findByName('admin');
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
    }
}
