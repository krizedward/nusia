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
            'timezone' => 'Asia/Jakarta',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-002',
            'first_name' => 'Shinta',
            'last_name' => 'Instructor',
            'email' => 'shinlad3@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-002.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-003',
            'first_name' => 'Iril',
            'last_name' => 'Instructor',
            'email' => 'irilauliya22@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-003.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-004',
            'first_name' => 'Yesaya',
            'last_name' => 'Instructor',
            'email' => 'karyayesayaagan@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-004.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-005',
            'first_name' => 'Nina',
            'last_name' => 'Instructor',
            'email' => 'nina.nurichsania@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-005.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-006',
            'first_name' => 'Gaga',
            'last_name' => 'Instructor',
            'email' => 'gayuh.gm@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-006.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-007',
            'first_name' => 'Vania',
            'last_name' => 'Instructor',
            'email' => 'vaniamaherani@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-007.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-008',
            'first_name' => 'Athif',
            'last_name' => 'Instructor',
            'email' => 'athifhaidar23@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-008.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-009',
            'first_name' => 'Fourdina',
            'last_name' => 'Instructor',
            'email' => '4fdinaa@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-009.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-010',
            'first_name' => 'Judita',
            'last_name' => 'Instructor',
            'email' => 'prajna.pramudita@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-010.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-011',
            'first_name' => 'Fariz',
            'last_name' => 'Instructor',
            'email' => 'alfarizi2807@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-011.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-012',
            'first_name' => 'Asyah',
            'last_name' => 'Instructor',
            'email' => 'asyahjamiatul@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-012.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-013',
            'first_name' => 'Raisha',
            'last_name' => 'Instructor',
            'email' => 'anggraini.raisha49@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-013.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-014',
            'first_name' => 'Adel',
            'last_name' => 'Instructor',
            'email' => 'alledaadella23@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-014.png',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-015',
            'first_name' => 'Galuh',
            'last_name' => 'Instructor',
            'email' => 'diahgaluh.sarimbit@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-015.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-016',
            'first_name' => 'Bella',
            'last_name' => 'Instructor',
            'email' => 'gavrilabela@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-016.jpg',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-017',
            'first_name' => 'Mustika',
            'last_name' => 'Instructor',
            'email' => 'mustikanuramalia@gmail.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'timezone' => 'Asia/Jakarta',
            'image_profile' => 'usr-017.jpg',
            'created_at' => now(),
            'updated_at' => null,
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
