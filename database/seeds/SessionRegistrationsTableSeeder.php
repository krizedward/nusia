<?php

use Illuminate\Database\Seeder;
use App\Models\SessionRegistration;

class SessionRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SessionRegistration::class, 150)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
