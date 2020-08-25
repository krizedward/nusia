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
            'instructor_id' => 7,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-002',
            'instructor_id' => 7,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-003',
            'instructor_id' => 7,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-004',
            'instructor_id' => 3,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-08-31 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-005',
            'instructor_id' => 3,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-09-02 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-006',
            'instructor_id' => 3,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-09-04 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-007',
            'instructor_id' => 6,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-008',
            'instructor_id' => 6,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-009',
            'instructor_id' => 6,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-010',
            'instructor_id' => 2,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-09-01 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-011',
            'instructor_id' => 2,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-09-03 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-012',
            'instructor_id' => 2,
            'instructor_id_2' => 6,
            'schedule_time' => '2020-09-05 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-013',
            'instructor_id' => 4,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-014',
            'instructor_id' => 4,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-015',
            'instructor_id' => 4,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-016',
            'instructor_id' => 15,
            'instructor_id_2' => 9,
            'schedule_time' => '2020-08-31 17:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-017',
            'instructor_id' => 15,
            'instructor_id_2' => 9,
            'schedule_time' => '2020-09-02 17:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-018',
            'instructor_id' => 15,
            'instructor_id_2' => 9,
            'schedule_time' => '2020-09-04 17:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-019',
            'instructor_id' => 12,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-08-31 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-020',
            'instructor_id' => 12,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-09-02 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-021',
            'instructor_id' => 12,
            'instructor_id_2' => 13,
            'schedule_time' => '2020-09-04 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-022',
            'instructor_id' => 11,
            'instructor_id_2' => 8,
            'schedule_time' => '2020-09-01 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-023',
            'instructor_id' => 11,
            'instructor_id_2' => 8,
            'schedule_time' => '2020-09-03 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-024',
            'instructor_id' => 11,
            'instructor_id_2' => 8,
            'schedule_time' => '2020-09-05 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-025',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-026',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-027',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-028',
            'instructor_id' => 12,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-01 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-029',
            'instructor_id' => 12,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-03 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-030',
            'instructor_id' => 12,
            'instructor_id_2' => 2,
            'schedule_time' => '2020-09-05 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-031',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-032',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-033',
            'instructor_id' => 10,
            'instructor_id_2' => 11,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-034',
            'instructor_id' => 9,
            'instructor_id_2' => 10,
            'schedule_time' => '2020-08-31 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-035',
            'instructor_id' => 9,
            'instructor_id_2' => 10,
            'schedule_time' => '2020-09-02 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-036',
            'instructor_id' => 9,
            'instructor_id_2' => 10,
            'schedule_time' => '2020-09-04 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-037',
            'instructor_id' => 15,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-09-01 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-038',
            'instructor_id' => 15,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-09-03 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-039',
            'instructor_id' => 15,
            'instructor_id_2' => 5,
            'schedule_time' => '2020-09-05 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-040',
            'instructor_id' => 8,
            'instructor_id_2' => 15,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-041',
            'instructor_id' => 8,
            'instructor_id_2' => 15,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-042',
            'instructor_id' => 8,
            'instructor_id_2' => 15,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-043',
            'instructor_id' => 16,
            'instructor_id_2' => 3,
            'schedule_time' => '2020-09-01 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-044',
            'instructor_id' => 16,
            'instructor_id_2' => 3,
            'schedule_time' => '2020-09-03 19:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-045',
            'instructor_id' => 16,
            'instructor_id_2' => 3,
            'schedule_time' => '2020-09-05 19:30:00',
            'status' => 'Busy',
        ]);

        /*factory(App\Models\Schedule::class, 50)
            ->states('Randomized')
            ->create()->make();*/
    }
}
