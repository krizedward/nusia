<?php

use Illuminate\Database\Seeder;
use App\Models\VerficationSchedule;

class VerficationScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VerficationSchedule::create([
        	'schedule_id'	=> 1,
	    	'done'			=> 'NO',
	    	'status'		=> 'Request',
        ]);

        VerficationSchedule::create([
        	'schedule_id'	=> 2,
	    	'done'			=> 'NO',
	    	'status'		=> 'Aggree',
        ]);
    }
}
