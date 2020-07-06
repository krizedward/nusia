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
        factory(App\User::class, 1)
            ->states('RolesAdmin', 'GenderMale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()
            ->each(function ($user) {
                $user->imageable()->save(factory(App\Models\Instructor::class)->make());
            })
            ->make();
        factory(App\User::class, 1)
            ->states('RolesAdmin', 'GenderMale', 'EmailVerifiedAt', 'ImageProfile')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('RolesAdmin', 'GenderMale', 'EmailVerifiedAt', 'Citizenship', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('RolesAdmin', 'GenderFemale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('RolesAdmin', 'GenderFemale', 'EmailVerifiedAt', 'Citizenship')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('RolesInstructor', 'GenderMale', 'EmailVerifiedAt', 'Phone', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('RolesInstructor', 'GenderMale', 'EmailVerifiedAt', 'ImageProfile')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('RolesInstructor', 'GenderMale', 'Citizenship', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('RolesInstructor', 'GenderFemale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('RolesInstructor', 'GenderFemale', 'Citizenship')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('RolesStudent', 'GenderMale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('RolesStudent', 'GenderMale', 'ImageProfile')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('RolesStudent', 'GenderMale', 'Phone', 'Citizenship', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('RolesStudent', 'GenderFemale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('RolesStudent', 'GenderFemale', 'Citizenship')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('Full', 'RolesAdmin', 'GenderMale')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('Full', 'RolesAdmin', 'GenderFemale')
            ->create()->make();
        factory(App\User::class, 4)
            ->states('Full', 'RolesInstructor', 'GenderMale')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('Full', 'RolesInstructor', 'GenderFemale')
            ->create()->make();
        factory(App\User::class, 5)
            ->states('Full', 'RolesStudent', 'GenderMale')
            ->create()->make();
        factory(App\User::class, 4)
            ->states('Full', 'RolesStudent', 'GenderFemale')
            ->create()->make();
    }
}
