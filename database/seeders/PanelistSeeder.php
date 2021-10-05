<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PanelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panelists = User::role('panelist')->get();
        $count = 0;
        $spec = 1;
        foreach($panelists as $p) {
            if($count < 3) {
                SpecializationPanelist::create([
                    'specialization_id' => $spec,
                    'user_id' => $p->id,
                ]);
                $count++;
            } else {
                $spec++;
                SpecializationPanelist::create([
                    'specialization_id' => $spec,
                    'user_id' => $p->id,
                ]);
                $count = 1;
            }    
        }
    }
}
