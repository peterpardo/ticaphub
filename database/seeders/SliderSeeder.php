<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'title' => 'TICaP HUB',
            'description' => 'An Event Management System for FEU Tech\'s Technology Innovation on Capstone Projects',
            'image' => 'assets/programflow.png'
        ]);
    }
}
