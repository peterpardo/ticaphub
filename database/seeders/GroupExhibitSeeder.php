<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupExhibitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::all();
        foreach($groups as $group) {
            if($group->groupExhibit->title == null) {
                $group->groupExhibit->title = $group->name . '\'s Exhibit';
                $group->groupExhibit->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, eveniet repudiandae incidunt nemo quo ipsam porro sapiente sint exercitationem magni numquam perferendis reprehenderit laborum quas, id veniam ut nisi molestiae provident odit facilis! Pariatur dolore quam exercitationem doloremque, numquam, sapiente illo nemo magnam repellat, ut veniam ipsam repellendus expedita eius corrupti. Dolores expedita architecto assumenda. Ipsa corrupti fugiat harum delectus nisi aliquid dolor explicabo, in eum expedita modi libero asperiores?';
                $group->groupExhibit->banner_name = 'banner';
                $group->groupExhibit->banner_path = 'assets/banner.png';
                $group->groupExhibit->video_name = 'sample-video';
                $group->groupExhibit->video_path = 'assets/sample-video.mp4';
                $group->groupExhibit->save();
            }
        }   
    }
}
