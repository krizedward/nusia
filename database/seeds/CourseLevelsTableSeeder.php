<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLevel;

class CourseLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseLevel::class, 5)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
