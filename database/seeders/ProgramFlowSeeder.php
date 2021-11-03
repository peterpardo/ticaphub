<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class ProgramFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::all();
        $programs = ['assets/program-flow-1.jpg', 'assets/program-flow-2.jpg', 'assets/program-flow-3.jpg'];
        $ctr = 0;
        foreach($events as $event) {
            $event->programFlows()->create([
                'name' => 'assets/program-flow-sample',
                'path' => $programs[$ctr],
            ]);
            $ctr++;
        }
    }
}
