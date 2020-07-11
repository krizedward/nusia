<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Rating::class, 150)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
