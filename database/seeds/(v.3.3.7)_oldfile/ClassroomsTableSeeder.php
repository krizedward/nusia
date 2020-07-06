<?php

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::create([
            'name'      =>'Trial',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'low',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
        	'name'		=>'Novice',
        	'session'	=>10,
        	'price'		=>100,
        	'level'		=>'low',
        	'detail'	=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Novice',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'mid',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Novice',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'high',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
        	'name'		=>'Intermediate',
        	'session'	=>10,
        	'price'		=>100,
        	'level'		=>'low',
        	'detail'	=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Intermediate',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'mid',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Intermediate',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'high',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
        	'name'		=>'Advanced',
        	'session'	=>10,
        	'price'		=>100,
        	'level'		=>'low',
        	'detail'	=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Advanced',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'mid',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        Classroom::create([
            'name'      =>'Advanced',
            'session'   =>10,
            'price'     =>100,
            'level'     =>'high',
            'detail'    =>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    }
}
