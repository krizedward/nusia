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
        	'name'		=> 'Asyah Jamiatul',
        	'email'		=> 'asyahjamiatul@gmail.com',
        	'password'	=>  bcrypt('12345678'),
        	'level'		=> 'instructor',
        ]);

        User::create([
        	'name'		=> 'Zephaniah Gavrila Bela Puspita',
        	'email'		=> 'bela@gmail.com',
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

        User::create([
            'name'      => 'Diah Galuh Sarimbit',
            'email'     => 'diah@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'instructor',
        ]);

        User::create([
            'name'      => 'Gayuh Restuku Mukti',
            'email'     => 'mukti@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'instructor',
        ]);

        User::create([
            'name'      => 'Maria Resi Prajna Pramudita',
            'email'     => 'maria@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'instructor',
        ]);

        User::create([
            'name'      => 'Nur Khoiril Auliya',
            'email'     => 'nur@gmail.com',
            'password'  =>  bcrypt('12345678'),
            'level'     => 'instructor',
        ]);

    }
}
