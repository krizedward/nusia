<?php

use Illuminate\Database\Seeder;
use App\Models\SessionRegistration;

class oldSessionRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SessionRegistration::class, 2500)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
