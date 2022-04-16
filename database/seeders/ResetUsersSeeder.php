<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResetUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Remove students
        User::role('student')->delete();

        // Remove panelists
        User::role('panelist')->delete();

        // Delete groups
        Group::truncate();
    }
}
