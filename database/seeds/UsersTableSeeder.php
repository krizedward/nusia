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
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-002',
            'first_name' => 'Shinta',
            'last_name' => 'Instructor',
            'email' => 'instructor001@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-003',
            'first_name' => 'Iril',
            'last_name' => 'Instructor',
            'email' => 'instructor002@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-004',
            'first_name' => 'Yesaya',
            'last_name' => 'Instructor',
            'email' => 'instructor003@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-005',
            'first_name' => 'Nina',
            'last_name' => 'Instructor',
            'email' => 'instructor004@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-006',
            'first_name' => 'Gaga',
            'last_name' => 'Instructor',
            'email' => 'instructor005@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-007',
            'first_name' => 'Vania',
            'last_name' => 'Instructor',
            'email' => 'instructor006@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-008',
            'first_name' => 'Athif',
            'last_name' => 'Instructor',
            'email' => 'instructor007@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-009',
            'first_name' => 'Fourdina',
            'last_name' => 'Instructor',
            'email' => 'instructor008@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-010',
            'first_name' => 'Judita',
            'last_name' => 'Instructor',
            'email' => 'instructor009@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-011',
            'first_name' => 'Fariz',
            'last_name' => 'Instructor',
            'email' => 'instructor010@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-012',
            'first_name' => 'Asyah',
            'last_name' => 'Instructor',
            'email' => 'instructor011@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-013',
            'first_name' => 'Raisha',
            'last_name' => 'Instructor',
            'email' => 'instructor012@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-014',
            'first_name' => 'Adel',
            'last_name' => 'Instructor',
            'email' => 'instructor013@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-015',
            'first_name' => 'Galuh',
            'last_name' => 'Instructor',
            'email' => 'instructor014@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-016',
            'first_name' => 'Bella',
            'last_name' => 'Instructor',
            'email' => 'instructor015@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);

        User::create([
            'code' => 'USR-017',
            'first_name' => 'Mustika',
            'last_name' => 'Instructor',
            'email' => 'instructor016@instructor.com',
            'password' => Hash::make('12345678'),
            'roles' => 'Instructor',
            'citizenship' => 'Indonesia',
            'image_profile' => null,
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
