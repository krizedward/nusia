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
            'code' => 'SNS-001',
            'course_id' => 1,
            'schedule_id' => 1,
            'title' => 'test',
            'description' => 'test',
            'requirement' => 'test',
            'link_zoom' => 'test',
        ]);
        /*
        factory(App\Models\Session::class, 750)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
