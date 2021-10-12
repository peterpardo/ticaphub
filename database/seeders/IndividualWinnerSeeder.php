<?php

namespace Database\Seeders;

use App\Models\IndividualWinner;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;

class IndividualWinnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specs = Specialization::all();
        foreach($specs as $spec) {
            foreach($spec->panelists as $panelist) {
                $panelist->has_chosen_user = 1;
                $panelist->save();
            }
            foreach($spec->awards->where('name', '!=', 'Best Project Adviser') as $award) {
                if($award->type == 'individual') {
                    foreach($award->individualWinners as $winner) {
                        if($winner->name == null) {
                            $users = [];
                            foreach($winner->group->userGroups as $userGroup) {
                                array_push($users, $userGroup->user->id);
                            }
                            for($i = 0; $i < $spec->panelists->count(); $i++) {
                                $key = array_rand($users);
                                $winner->group->individualCandidates()->create([
                                    'user_id' => $users[$key]
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
