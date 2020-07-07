<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class oldStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
        	'user_id'	=> 3,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'user.jpg',
			'interest'	=> 'read, eat, travel',
        ]);

        Student::create([
        	'user_id'	=> 4,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'user.jpg',
			'interest'	=> 'read, eat, travel',
        ]);
    }
}
