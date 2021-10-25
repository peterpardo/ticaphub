<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;

class DeleteScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scheds = Schedule::all();
        foreach($scheds as $sched) {
            if(\Carbon\Carbon::parse($sched->start_date)->timezone('Asia/Manila') < \Carbon\Carbon::today()->timezone('Asia/Manila')) {
                $sched->delete();
            }
        }

    }
}
