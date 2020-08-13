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
            'code' => 'C-001',
            'course_package_id' => 4,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-002',
            'course_package_id' => 77,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-003',
            'course_package_id' => 15,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-004',
            'course_package_id' => 10,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-005',
            'course_package_id' => 70,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-006',
            'course_package_id' => 20,
            'title' => null,
            'description' => null,
            'requirement' => null,
        ]);
        /*
        factory(App\Models\Course::class, 150)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
