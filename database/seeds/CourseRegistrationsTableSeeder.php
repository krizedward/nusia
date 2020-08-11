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
        CourseRegistration::create([
            'code' => 'CRG-001',
            'course_id' => 1,
            'student_id' => 1,
        ]);
        /*
        factory(App\Models\CourseRegistration::class, 450)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
