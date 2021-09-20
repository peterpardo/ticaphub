<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Peter Carl',
            'middle_name' => 'Munoz',
            'last_name' => 'Pardo',
            'email' => 'admin@admin.com',
            'student_number' => 201811780,
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'school_id' => 1,
        ]);


        $mina = User::create([
            'first_name' => 'Mina',
            'middle_name' => 'Sharon',
            'last_name' => 'Myoui',
            'email' => 'stud@stud.com',
            'student_number' => 123456789,
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'school_id' => 1,
        ]);

        $mina->userSpecialization()->create([
            'specialization_id' => 1,
        ]);

        $sana = User::create([
            'first_name' => 'Sana',
            'middle_name' => 'Sana',
            'last_name' => 'Minatozaki',
            'email' => 'stud2@stud2.com',
            'student_number' => 35345345,
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'school_id' => 1,
        ]);

        $sana->userSpecialization()->create([
            'specialization_id' => 1,
        ]);


        // CREATE PERMISSIONS
        // ADMIN
        Permission::create(['name' => 'access users']);
        Permission::create(['name' => 'access events']);
        Permission::create(['name' => 'add events']);
        Permission::create(['name' => 'delete events']);
        Permission::create(['name' => 'add lists']);
        Permission::create(['name' => 'add tasks']);

        // PANELIST
        Permission::create(['name' => 'evaluate']);

        // CREATE ROLES AND ASSIGN PERMISSIONS
        // ADMIN
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('access users');
        $admin->givePermissionTo('access events');
        $admin->givePermissionTo('add events');
        $admin->givePermissionTo('delete events');
        $admin->givePermissionTo('add lists');
        $admin->givePermissionTo('add tasks');
        
        // STUDENT
        $student = Role::create(['name' => 'student']);
        
        // CHAIRMAN
        $chairman = Role::create(['name' => 'chairman']);
        $chairman->givePermissionTo('access events');
        $chairman->givePermissionTo('add lists');
        $chairman->givePermissionTo('add tasks');

        // OFFICER
        $officer = Role::create(['name' => 'officer']);
        $officer->givePermissionTo('access events');

        // PANELIST
        $panelist = Role::create(['name' => 'panelist']);
        $panelist->givePermissionTo('evaluate');


        // ASSIGN ROLE
        $user->assignRole($admin);
        $mina->assignRole($student);
        $sana->assignRole($student);

        // GENERATE USERS - FEU TECH ONLY
        for ($x = 0; $x <= 40; $x++) {
            
            $user = \App\Models\User::create([
                'first_name' => Str::random(5),
                'middle_name' => Str::random(5),
                'last_name' => Str::random(5),
                'email' => Str::random(5) . "@" . Str::random(5) . ".com",
                'student_number' => rand(1,999999999),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'ticap_id' => 1,
                'school_id' => 1,
            ]);

            $user->userSpecialization()->create([
                'specialization_id' => rand(1,2),
            ]);

            $user->assignRole($student);
        }    

    }
}
