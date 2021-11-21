<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\SpecializationPanelist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetPanelistGroupAdviserSeeder extends Seeder
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
        $spec = 2;
        foreach($panelists as $p) {
            // ASSIGN PANELIST THAT IS NOT YET ASSIGNED TO A SPECIALIZATION
            if(!SpecializationPanelist::where('user_id', $p->id)->exists()) {
                // MAX OF 3 PANELIST PER SPECIALIZATION
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

        // SET ADVISER NAMES AND EMAILS FOR CERTIFICATIONS
        $groups = Group::all();
        $fname = [
            'Joshua', 'John Paul', 'Christian', 'Justine', 'John Mark', ' John Lloyd', 'Jerome', 'Adrian', 'John Michael', 'Angelo',
            'Angel', 'Angelica', 'Nicole', 'Angela', 'Mary Joy', 'Mariel', 'Jasmine', 'Mary Grace', 'Kimberly', 'Stephanie'
        ];
        $lname = [
            'Garcia', 'Reyes', 'Ramos', 'Mendoza', 'Santos', 'Flores', 'dela Cruz', 'Gonzales', 'Bautista', 'Villanueva', 'Fernandez', 'Cruz',
            'de Guzman', 'Lopez', 'Perez', 'Castillo', 'Francisco', 'Rivera', 'Aquino', 'Castro'
        ];
        foreach($groups as $group) {
            $randFname = array_rand($fname);
            $randLname = array_rand($lname);
            // SET GROUP ADVISER IF IT'S STILL NULL
            if($group->adviser == null) {
                $email = str_replace(' ', '', $fname[$randFname] . $lname[$randLname]) . rand(111, 999);
                $group->adviser = $fname[$randFname] . ' ' . $lname[$randLname];
                $group->adviser_email = strtolower($email) . '@gmail.com';
                $group->save();
            }
        }
    }
}
