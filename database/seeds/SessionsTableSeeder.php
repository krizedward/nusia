<?php

use Illuminate\Database\Seeder;
use App\Models\Session;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::create([
            'code' => 'S-001',
            'course_id' => 1,
            'schedule_id' => 2,
            'title' => null,
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-002',
            'course_id' => 1,
            'schedule_id' => 1,
            'title' => null,
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-003',
            'course_id' => 2,
            'schedule_id' => 4,
            'title' => 'Sesi ini',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-004',
            'course_id' => 3,
            'schedule_id' => 3,
            'title' => null,
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-005',
            'course_id' => 4,
            'schedule_id' => 5,
            'title' => null,
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        /*Session::create([
            'code' => 'SNS-001',
            'course_id' => 1,
            'schedule_id' => 1,
            'title' => 'test',
            'description' => 'test',
            'requirement' => 'test',
            'link_zoom' => 'test',
        ]);*/
        /*
        factory(App\Models\Session::class, 750)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
