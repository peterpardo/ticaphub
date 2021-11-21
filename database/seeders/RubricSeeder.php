<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Criteria;
use App\Models\Rubric;
use Illuminate\Database\Seeder;

class RubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rubric = Rubric::create([
            'name' => 'Rubric 2'
        ]);

        Criteria::insert([
            ['name' => 'design', 'percentage' => 20, 'rubric_id' => $rubric->id],
            ['name' => 'visual', 'percentage' => 30, 'rubric_id' => $rubric->id],
            ['name' => 'presentation', 'percentage' => 20, 'rubric_id' => $rubric->id],
            ['name' => 'quality', 'percentage' => 30, 'rubric_id' => $rubric->id],
        ]);

        // INSERT RUBRIC TO EACH AWARDS
        $length = Rubric::all()->count();
        foreach(Award::all() as $award) {
            if($award->awardRubric == null) {
                $award->awardRubric()->create([
                    'rubric_id' => rand(1, $length),
                ]);
            }
        }
    }
}
