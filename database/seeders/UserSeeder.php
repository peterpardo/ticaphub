<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        ]);

        $user->userProgram()->create([
            'school_id' => 1,
            // 'specialization_id' => 1,
        ]);

        $mina = User::create([
            'first_name' => 'Mina',
            'middle_name' => 'Sharon',
            'last_name' => 'Myoui',
            'email' => 'stud@stud.com',
            'student_number' => 123456789,
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
        ]);

        $mina->userProgram()->create([
            'school_id' => 1,
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
        ]);

        $sana->userProgram()->create([
            'school_id' => 1,
            'specialization_id' => 2,
        ]);

        // CREATE PERMISSIONS
        Permission::create(['name' => 'can access users']);

        // CREATE ROLES AND ASSIGN PERMISSIONS
        $student = Role::create(['name' => 'student']);
        
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('can access users');


        // ASSIGN ROLE
        $user->assignRole($admin);
        $mina->assignRole($student);
        $sana->assignRole($student);

        // GENERATE USERS - FEU TECH
        for ($x = 0; $x <= 40; $x++) {
            $user = \App\Models\User::factory()->create();
            $user->userProgram()->create([
                'school_id' => 1,
                'specialization_id' => rand(1,2),
            ]);
            $user->assignRole($student);
        }   

        
        // // GENERATE USERS - FEU DILIMAN
        // for ($x = 0; $x <= 20; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 2,
        //         'specialization_id' => 1,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 2,
        //         'specialization_id' => 2,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 2,
        //         'specialization_id' => 3,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 2,
        //         'specialization_id' => 4,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // // GENERATE USERS - FEU ALABANG
        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 3,
        //         'specialization_id' => 1,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 3,
        //         'specialization_id' => 2,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 3,
        //         'specialization_id' => 3,
        //     ]);
        //     $user->assignRole($student);
        // }   

        // for ($x = 0; $x <= 10; $x++) {
        //     $user = \App\Models\User::factory()->create();
        //     $user->userProgram()->create([
        //         'school_id' => 3,
        //         'specialization_id' => 4,
        //     ]);
        //     $user->assignRole($student);
        // }   

    }
}
