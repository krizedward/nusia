<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Session;

class DemoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'code' => 'DEMO-SCH-001',
            'instructor_id' => 4,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-08-26 13:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'DEMO-SCH-002',
            'instructor_id' => 4,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-08-26 13:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'DEMO-SCH-003',
            'instructor_id' => 4,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-08-26 13:50:00',
            'status' => 'Busy',
        ]);
        Course::create([
            'code' => 'DEMO-C-001',
            'course_package_id' => 1,
            'title' => 'Demo Class 1',
            'description' => 'This is a demo class.',
            'requirement' => null,
        ]);
        Session::create([
            'code' => 'DEMO-S-001',
            'course_id' => 16,
            'schedule_id' => 46,
            'form_id' => 1,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'DEMO-S-002',
            'course_id' => 16,
            'schedule_id' => 47,
            'form_id' => 2,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'DEMO-S-003',
            'course_id' => 16,
            'schedule_id' => 48,
            'form_id' => 3,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
    }
}
