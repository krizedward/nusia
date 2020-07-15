<?php

use Illuminate\Database\Seeder;
use App\Models\Session;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Session::class, 750)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
