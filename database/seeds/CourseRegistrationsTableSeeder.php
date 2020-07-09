<?php

use Illuminate\Database\Seeder;
use App\Models\CourseRegistration;

class CourseRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseRegistration::class, 200)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
