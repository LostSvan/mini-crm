<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'view tickets']);
        //По мере разработки возможно будут прибавляться

        $roleAdmin = Role::findOrCreate('admin');
        $roleAdmin->givePermissionTo(Permission::all());
        $roleManager = Role::findOrCreate('manager');
        $roleManager->givePermissionTo(['view customers', 'view tickets']);

        $user = User::create([
            'name' => 'User Admin',
            'email' => 'lostsvan@gmail.com',
            'password' => bcrypt('vlad28')
        ]);
        $user->assignRole($roleAdmin);

        User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('manager');
        });

    }
}
