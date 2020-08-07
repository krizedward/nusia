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
        App\User::create([
            'code' => 'USR-001',
            'first_name' => 'Nusantara Indonesia',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Admin',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
        ]);

        App\User::create([
            'code' => 'USR-002',
            'first_name' => 'Instructor',
            'last_name' => '001',
            'email' => 'instructor001@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
        ]);

        App\User::create([
            'code' => 'USR-003',
            'first_name' => 'Instructor',
            'last_name' => '002',
            'email' => 'instructor002@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
        ]);

        App\User::create([
            'code' => 'USR-004',
            'first_name' => 'Student',
            'last_name' => '001',
            'email' => 'student001@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
        ]);

        App\User::create([
            'code' => 'USR-005',
            'first_name' => 'Student',
            'last_name' => '002',
            'email' => 'student002@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
        ]);

        /*factory(App\User::class, 3)
            ->states('EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('EmailVerifiedAt', 'ImageProfile', 'UpdatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('EmailVerifiedAt', 'UpdatedAt')
            ->create()->make();
        factory(App\User::class, 9)
            ->states('Full', 'RolesAdmin')
            ->create()->make();*/
    }
}
