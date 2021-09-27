<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mina = User::create([
            'first_name' => 'Mina',
            'middle_name' => 'Sharon',
            'last_name' => 'Myoui',
            'email' => 'stud@stud.com',
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'email_verified' => 1,
        ]);
        $mina->userSpecialization()->create([
            'specialization_id' => 1,
            'id_number' => 20181234
        ]);
        // $mina->userGroup()->create([
        //     'group_id' => 1
        // ]);
        $sana = User::create([
            'first_name' => 'Sana',
            'middle_name' => 'Sana',
            'last_name' => 'Minatozaki',
            'email' => 'stud2@stud2.com',
            'password' => Hash::make('123'), // password
            'ticap_id' => 1,
            'email_verified' => 1,
        ]);
        $sana->userSpecialization()->create([
            'specialization_id' => 2,
            'id_number' => 20181234
        ]);
        // $sana->userGroup()->create([
        //     'group_id' => 2
        // ]);
        $mina->assignRole('student');
        $sana->assignRole('student');
        for ($x = 0; $x <= 200; $x++) {
            $user = \App\Models\User::create([
                'first_name' => Str::random(5),
                'middle_name' => Str::random(5),
                'last_name' => Str::random(5),
                'email' => Str::random(5) . "@" . Str::random(5) . ".com",
                'password' => Hash::make('123'), // password
                'remember_token' => Str::random(10),
                'ticap_id' => 1,
                'email_verified' => 1,
            ]);
            $user->userSpecialization()->create([
                'specialization_id' => rand(1,8),
                'id_number' => rand(1,999999999),
            ]);
            $user->assignRole('student');
        }
    }
}
