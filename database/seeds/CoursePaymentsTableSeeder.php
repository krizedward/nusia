<?php

use Illuminate\Database\Seeder;
use App\Models\CoursePayment;

class CoursePaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CoursePayment::class, 20)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
