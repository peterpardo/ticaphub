<?php

namespace Database\Seeders;

use App\Models\IndividualWinner;
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
        $panelists = User::role('panelist');
        foreach($panelists as $panelist) {
            $panelist->specializationPanelist->has_chosen_user = 1;
            $panelist->specializationPanelist->save();
        }

        $winners = IndividualWinner::all();
        // dd($winners);
        $arr = [
            'blue' => 1,
            'red' => 1,
            'green' => 1,
            'indigo' => 1,
        ];
        $key = array_rand($arr);
        dd($arr[$key]);
        foreach($winners as $winner) {
            foreach($winner->group->userGroups as $userGroup) {
                echo $userGroup->user->id . '<br>';
            }   
        }
    }
}
