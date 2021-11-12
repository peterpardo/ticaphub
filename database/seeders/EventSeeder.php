<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticap;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => 'Project Exhibit',
            'ticap_id' => null
        ]);
        Event::create([
            'name' => 'Awardings',
            'ticap_id' => null
        ]);
        Event::create([
            'name' => 'Webinar',
            'ticap_id' => null
        ]);
    }
}
