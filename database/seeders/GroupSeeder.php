<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

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
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'LSMR',
            'specialization_id' => 1,
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Envisioners',
            'specialization_id' => 1,
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Twice',
            'specialization_id' => 2,
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Blackpink',
            'specialization_id' => 2,
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'Red Velvet',
            'specialization_id' => 2,
            'school_id' => 1,
            'ticap_id' => 1
        ]);
        // FEU DILIMAN
        // Group::create([
        //     'name' => 'Everglow',
        //     'specialization_id' => 1,
        //     'school_id' => 2,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'IZ*ONE',
        //     'specialization_id' => 1,
        //     'school_id' => 2,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'ITZY',
        //     'specialization_id' => 2,
        //     'school_id' => 2,
        //     'ticap_id' => 1
        // ]);
        // Group::create([
        //     'name' => 'MAMAMOO',
        //     'specialization_id' => 2,
        //     'school_id' => 2,
        //     'ticap_id' => 1
        // ]);
    }
}
