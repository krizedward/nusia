<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;

class oldRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Rating::class, 2000)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
