<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLevelDetail;

class CourseLevelDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
