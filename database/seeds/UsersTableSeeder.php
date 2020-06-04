<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'		=> 'Edward',
        	'email'		=> 'edwardthemangare@gmail.com',
        	'password'	=>  bcrypt('12345678'),
        	'level'		=> 'instructor',
        ]);

        User::create([
        	'name'		=> 'awan',
        	'email'		=> 'awan@gmail.com',
        	'password'	=>  bcrypt('12345678'),
        	'level'		=> 'instructor',
        ]);

        User::create([
            'name'      => 'meli',
            'email'     => 'meli@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'student',
        ]);

        User::create([
            'name'      => 'hani',
            'email'     => 'hani@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'student',
        ]);
    }
}
