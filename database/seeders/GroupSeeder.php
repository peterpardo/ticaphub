<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Ticap;
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
            'name' => 'Envisioners',
            'specialization_id' => 2,
            'ticap_id' => 1
        ]);
        Group::create([
            'name' => 'BLANK',
            'specialization_id' => 2,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'JARS',
            'specialization_id' => 2,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ALPHA',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ASTRATECH',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'ETERNALS',
            'specialization_id' => 3,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Technocrats',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'QUATROSYS',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'TEAMWARE',
            'specialization_id' => 4,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        // FEU DILIMAN
        Group::create([
            'name' => 'CHAPO',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Innovatech',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'CodeGent',
            'specialization_id' => 5,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'InnTech',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'Bro Code',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
        Group::create([
            'name' => 'TECHLANCE',
            'specialization_id' => 6,
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
        ]);
    }
}
