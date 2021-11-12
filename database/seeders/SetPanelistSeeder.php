<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Specialization;
use App\Models\SpecializationPanelist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetPanelistSeeder extends Seeder
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

        $groups = Group::all();
        foreach($groups as $group) {
            $group->adviser = Str::random(5) . ' ' . Str::random(5);
            $group->adviser_email = Str::random(5) . '@' . Str::random(5) . '.com';
            $group->save();
        }
    }
}
