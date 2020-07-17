<?php

use Illuminate\Database\Seeder;
use App\Models\CoursePayment;

class oldCoursePaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CoursePayment::class, 350)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
