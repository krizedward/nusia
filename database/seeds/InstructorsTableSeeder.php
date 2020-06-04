<?php

use Illuminate\Database\Seeder;
use App\Models\Instructors;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instructors::create([
        	'user_id'	=> 1,
			'location'	=> 'Indonesia',
			'gender'	=> 'male',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'user.jpg',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);

        Instructors::create([
        	'user_id'	=> 2,
			'location'	=> 'Indonesia',
			'gender'	=> 'male',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'user.jpg',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ]);
    }
}
