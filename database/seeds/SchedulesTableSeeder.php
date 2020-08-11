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
            'schedule_time' => '2020-08-11 06:19:41',
            'status' => 'Available',
        ]);
        /*factory(App\Models\Schedule::class, 50)
            ->states('Randomized')
            ->create()->make();*/
    }
}
