<?php

namespace Database\Seeders;

use App\Models\Ticap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticap::create([
            'name' => 'TICaP 9.0',
            'invitation_is_set' => 1,
            'election_has_started' => 1,
        ]);
    }
}
