<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class EmailVerifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::role('student')->get();
        foreach($users as $user) {
            // VERIFY ALL EMAILS OF STUDENTS
            if(!$user->email_verified) {
                $user->email_verified = true;
                $user->save();
            }
        } 
    }
}
