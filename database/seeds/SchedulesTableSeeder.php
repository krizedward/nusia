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
            'schedule_time' => '2020-08-24 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-002',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-26 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-003',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-28 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-004',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-24 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-005',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-26 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-006',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-28 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-007',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-24 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-008',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-26 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-009',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-28 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-010',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-24 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-011',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-26 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-012',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-28 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-013',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-014',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-015',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-016',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-017',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-018',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-019',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-25 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-020',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-27 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-021',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-29 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-022',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-25 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-023',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-27 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-024',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-29 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-025',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-24 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-026',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-26 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-027',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-28 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-028',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-24 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-029',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-26 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-030',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-28 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-031',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-24 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-032',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-26 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-033',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-28 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-034',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-24 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-035',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-26 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-036',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-28 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-037',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-24 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-038',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-26 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-039',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-28 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-040',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-24 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-041',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-26 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-042',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-28 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-043',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-24 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-044',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-26 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-045',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-28 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-046',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-24 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-047',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-26 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-048',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-28 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-049',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-050',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-051',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-052',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-053',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-054',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-055',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-25 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-056',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-27 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-057',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-29 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-058',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-25 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-059',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-27 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-060',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-29 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-061',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-24 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-062',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-26 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-063',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-28 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-064',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-24 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-065',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-26 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-066',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-28 06:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-067',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-068',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-069',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-070',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-25 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-071',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-27 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-072',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-29 02:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-073',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-25 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-074',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-27 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-075',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-29 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-076',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-25 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-077',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-27 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-078',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-29 09:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-079',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-25 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-080',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-27 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-081',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-29 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-082',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-25 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-083',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-27 12:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-084',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-29 12:30:00',
            'status' => 'Busy',
        ]);

        /*factory(App\Models\Schedule::class, 50)
            ->states('Randomized')
            ->create()->make();*/
    }
}
