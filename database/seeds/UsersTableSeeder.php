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
            ->states('GenderMale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('GenderMale', 'EmailVerifiedAt', 'ImageProfile', 'UpdatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('GenderMale', 'EmailVerifiedAt', 'Citizenship', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('GenderFemale', 'EmailVerifiedAt', 'CreatedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('GenderFemale', 'EmailVerifiedAt', 'Citizenship', 'UpdatedAt')
            ->create()->make();
        factory(App\User::class, 3)
            ->states('Full', 'RolesAdmin', 'GenderMale')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('Full', 'RolesAdmin', 'GenderFemale')
            ->create()->make();
        factory(App\User::class, 2)
            ->states('Full', 'RolesAdmin', 'GenderMale', 'DeletedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('Full', 'RolesAdmin', 'GenderFemale', 'DeletedAt')
            ->create()->make();
        factory(App\User::class, 1)
            ->states('Full', 'RolesAdmin', 'GenderMale', 'DeletedAtNoUpdate')
            ->create()->make();
    }
}
