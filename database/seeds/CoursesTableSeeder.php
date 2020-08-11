<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'code' => 'CR-001',
            'course_package_id' => 1,
            'title' => 'Fixed Material',
            'description' => 'test',
            'requirement' => 'test',
        ]);
        /*
        factory(App\Models\Course::class, 150)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
