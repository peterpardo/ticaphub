<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'name' => 'Chairman',

        ]);

        Position::create([
            'name' => 'Co-Chairman',
        ]);

        // Position::create([
        //     'name' => 'Committee Lead',
        // ]);
        
    }
}
