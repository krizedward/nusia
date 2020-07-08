<?php

use Illuminate\Database\Seeder;
use App\Models\CoursePackage;

class CoursePackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CoursePackage::class, 20)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
