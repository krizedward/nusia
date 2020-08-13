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
            'code' => 'USR-001',
            'first_name' => 'Nusantara Indonesia',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Admin',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-07 05:12:10',
            'updated_at' => '2020-08-07 05:12:10',
        ]);

        User::create([
            'code' => 'USR-002',
            'first_name' => 'Instructor',
            'last_name' => '001',
            'email' => 'instructor001@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-07 05:12:10',
            'updated_at' => '2020-08-07 05:12:10',
        ]);

        User::create([
            'code' => 'USR-003',
            'first_name' => 'Instructor',
            'last_name' => '002',
            'email' => 'instructor002@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-07 05:12:10',
            'updated_at' => '2020-08-07 05:12:10',
        ]);

        User::create([
            'code' => 'USR-004',
            'first_name' => 'Student',
            'last_name' => '001',
            'email' => 'student001@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-07 05:12:10',
            'updated_at' => '2020-08-07 05:12:10',
        ]);

        User::create([
            'code' => 'USR-005',
            'first_name' => 'Student',
            'last_name' => '002',
            'email' => 'student002@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-07 05:12:10',
            'updated_at' => '2020-08-07 05:12:10',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Tanto Daud',
            'last_name' => 'Imanuel',
            'email' => 'imanuel.tanto.daud@gmail.com',
            'password' => Hash::make('12345678'), // diganti untuk menjaga kerahasiaan password :D
            'roles' => 'Student',
            'citizenship' => 'Not Available', // penunjuk bahwa Student belum melakukan pengisian form survei
            'image_profile' => null,
            'created_at' => '2020-08-12 08:03:29',
            'updated_at' => '2020-08-12 08:03:29',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '003',
            'email' => 'student003@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:12:29',
            'updated_at' => '2020-08-12 08:12:29',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '004',
            'email' => 'student004@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:13:46',
            'updated_at' => '2020-08-12 08:13:46',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '005',
            'email' => 'student005@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:28:32',
            'updated_at' => '2020-08-12 08:28:32',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '006',
            'email' => 'student006@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:32:58',
            'updated_at' => '2020-08-12 08:32:58',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '007',
            'email' => 'student007@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:34:07',
            'updated_at' => '2020-08-12 08:34:07',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '008',
            'email' => 'student008@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:36:07',
            'updated_at' => '2020-08-12 08:36:07',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '009',
            'email' => 'student009@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:40:15',
            'updated_at' => '2020-08-12 08:40:15',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '010',
            'email' => 'student010@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:46:59',
            'updated_at' => '2020-08-12 08:46:59',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '011',
            'email' => 'student011@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 08:48:01',
            'updated_at' => '2020-08-12 08:48:01',
        ]);

        User::create([
            'code' => null,
            'first_name' => 'Student',
            'last_name' => '012',
            'email' => 'student012@student.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Student',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => '2020-08-12 09:24:48',
            'updated_at' => '2020-08-12 09:24:48',
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
