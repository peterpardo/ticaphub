<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // FEU TECH
        Group::create([
            'name' => 'Cyber Ace',
            'specialization_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'LSMR',
            'specialization_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Code Brewers',
            'specialization_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Twice',
            'specialization_id' => 2,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Blackpink',
            'specialization_id' => 2,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Everglow',
            'specialization_id' => 2,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'MAMAMOO',
            'specialization_id' => 3,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'IZONE',
            'specialization_id' => 3,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'ITZY',
            'specialization_id' => 3,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Technocrats',
            'specialization_id' => 4,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Sentinels',
            'specialization_id' => 4,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Dreamcatcher',
            'specialization_id' => 4,
            'ticap_id' => 1
        ]);
        // $x = 0;
        // while($x < 25) {
        //     Group::create([
        //         'name' => Str::random(6),
        //         'specialization_id' => rand(1,4),
        //         'ticap_id' => 1
        //     ]);
        // }
        // Group::create([
        //     'name' => 'Everglow',
        //     'specialization_id' => 2,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'Envisioners',
        //     'specialization_id' => 1,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'Twice',
        //     'specialization_id' => 3,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'Blackpink',
        //     'specialization_id' => 3,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'Red Velvet',
        //     'specialization_id' => 4,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'ITZY',
        //     'specialization_id' => 4,
        //     'ticap_id' => 1
        // ]);
        // FEU DILIMAN
        // Group::create([
        //     'name' => 'Blackpink',
        //     'specialization_id' => 5,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'Red Velvet',
        //     'specialization_id' => 5,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'ITZY',
        //     'specialization_id' => 6,
        //     'ticap_id' => 1
        // ]);
    }
}
