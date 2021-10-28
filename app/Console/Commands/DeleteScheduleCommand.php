<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use DateTime;

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
    protected $description = 'Delete expired events';

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
            if($sched->start_date < \Carbon\Carbon::now('Asia/Manila') && $sched->end_date < \Carbon\Carbon::now('Asia/Manila')) {
                $sched->delete();
            }
        }
        
    }
}
