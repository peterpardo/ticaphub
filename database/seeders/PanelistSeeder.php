<?php

namespace Database\Seeders;

use App\Models\Ticap;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PanelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PANELIST
        for($i = 0; $i < 12; $i++) {
            $user = User::create([
                'first_name' => Str::random(5),
                'middle_name' => Str::random(5),
                'last_name' => Str::random(5),
                'email' => Str::random(5) . "@" . Str::random(5) . ".com",
                'password' => Hash::make('123'), // password
                'remember_token' => Str::random(10),
                'ticap_id' => Ticap::latest()->pluck('id')->first(),
                'email_verified' => 1,
            ]);
            $user->assignRole('panelist');
        }
    }
}
