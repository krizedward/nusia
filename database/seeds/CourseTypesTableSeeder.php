<?php

use Illuminate\Database\Seeder;
use App\Models\CourseType;

class CourseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
