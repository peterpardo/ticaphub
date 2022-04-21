<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResetUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if there are students in the system
        if(User::role('student')->count() > 1) {
            // Detech student and officer role to empty the model_has_roles table
            foreach(User::role('student')->get() as $student) {
                $student->removeRole('student');

                if ($student->hasRole('officer')) {
                    $student->removeRole('officer');
                }

                // Delete student
                $student->delete();
            }
        }

        // Check if there are panelists in the system
        if(User::role('panelist')->count() > 1) {
            // Detech student role to students to empty the model_has_roles table
            foreach(User::role('panelist')->get() as $panelist) {
                // Remove panelist
                $panelist->removeRole('panelist');
                $panelist->delete();
            }
        }

        // Delete groups
        foreach(Group::all() as $group) {
            $group->delete();
        }
    }
}
