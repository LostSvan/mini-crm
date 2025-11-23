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
        Permission::firstOrCreate(['name' => 'delete tickets']);

        $roleAdmin = Role::findOrCreate('admin');
        $roleAdmin->givePermissionTo(Permission::all());
        $roleManager = Role::findOrCreate('manager');
        $roleManager->givePermissionTo(['view customers', 'view tickets']);

        $user = User::create([
            'name' => 'User Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin')
        ]);
        $user->assignRole($roleAdmin);

        $manager1 = User::create(
            ['email' => 'manager1@test.com',
            'name' => 'Manager 1',
            'password' => bcrypt('manager1'),
            ]
        );
        $manager1->assignRole('manager');

        $manager2 = User::create(
            ['email' => 'manager2@test.com',
                'name' => 'Manager 2',
                'password' => bcrypt('manager2'),
            ]
        );
        $manager2->assignRole('manager');

        $manager3 = User::create(
            ['email' => 'manager3@test.com',
                'name' => 'Manager 3',
                'password' => bcrypt('manager3'),
            ]
        );
        $manager3->assignRole('manager');
//        User::factory()->count(3)->create()->each(function ($user) {
//            $user->assignRole('manager');
//        });

    }
}
