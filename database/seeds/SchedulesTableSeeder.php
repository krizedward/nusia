<?php

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'code' => 'SCH-001',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-07 17:11:37',
            'status' => 'Available',
        ]);
        Schedule::create([
            'code' => 'SCH-002',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-07 17:11:37',
            'status' => 'Available',
        ]);
        Schedule::create([
            'code' => 'SCH-003',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-07 17:12:41',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-004',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-17 17:12:57',
            'status' => 'Available',
        ]);
        Schedule::create([
            'code' => 'SCH-005',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-07 17:13:10',
            'status' => 'Available',
        ]);
        /*Schedule::create([
            'code' => 'SCH-001',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-11 06:19:41',
            'status' => 'Available',
        ]);*/
        /*factory(App\Models\Schedule::class, 50)
            ->states('Randomized')
            ->create()->make();*/
    }
}
