<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'first_name' => 'SuperAdmin',
            'middle_name' => '',
            'last_name' => '',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // password
            'ticap_id' => null,
            'email_verified' => 1,
        ]);

        $user2 = User::create([
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => '',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin123'), // password
            'ticap_id' => null,
            'email_verified' => 1,
        ]);

        // Roles
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'panelist']);
        // Role::create(['name' => 'officer']);

        // Permissions
        Permission::create(['name' => 'access user accounts']);
        Permission::create(['name' => 'access project assessment']);
        Permission::create(['name' => 'access documentation']);
        Permission::create(['name' => 'access committee heads']);
        Permission::create(['name' => 'access manage events']);

        $user1->assignRole($superadmin);
        $user2->assignRole($admin);
    }
}
