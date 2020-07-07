<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class oldSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
        	'student_id'	=> 1,
        	'instructor_id'	=> 1,
        	'class_id'		=> 1,
        	'time_meet'		=> '01:01:01',
        	'date_meet'		=> '2020-02-02',
        	'zoom_link'		=> 'link',
        ]);

        Schedule::create([
        	'student_id'	=> 2,
        	'instructor_id'	=> 2,
        	'class_id'		=> 1,
        	'time_meet'		=> '01:01:01',
        	'date_meet'		=> '2020-02-02',
        	'zoom_link'		=> 'link',
        ]);
    }
}
