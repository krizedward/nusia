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
        factory(App\User::class, 3)
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
            ->create()->make();
    }
}
