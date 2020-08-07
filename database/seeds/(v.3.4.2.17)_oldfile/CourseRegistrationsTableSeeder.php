<?php

use Illuminate\Database\Seeder;
use App\Models\CourseRegistration;

class oldCourseRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseRegistration::class, 450)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
