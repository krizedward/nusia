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
// BATCH 1 WEEK 1
        Schedule::create([
            'code' => 'SCH-001',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-24 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-002',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-26 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-003',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-28 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-004',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-24 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-005',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-26 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-006',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-28 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-007',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-25 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-008',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-27 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-009',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-29 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-010',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-25 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-011',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-27 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-012',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-29 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-013',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-014',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-015',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-016',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-017',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-018',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-019',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-25 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-020',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-27 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-021',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-29 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-022',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-25 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-023',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-27 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-024',
            'instructor_id' => 4,
            'schedule_time' => '2020-08-29 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-025',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-24 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-026',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-26 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-027',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-28 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-028',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-24 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-029',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-26 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-030',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-28 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-031',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-24 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-032',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-26 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-033',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-28 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-034',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-24 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-035',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-26 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-036',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-28 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-037',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-24 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-038',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-26 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-039',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-28 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-040',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-24 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-041',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-26 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-042',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-28 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-043',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-25 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-044',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-27 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-045',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-29 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-046',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-25 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-047',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-27 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-048',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-29 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-049',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-050',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-051',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-052',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-053',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-054',
            'instructor_id' => 14,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-055',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-26 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-056',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-28 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-057',
            'instructor_id' => 12,
            'schedule_time' => '2020-08-30 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-058',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-26 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-059',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-28 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-060',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-30 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-061',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-24 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-062',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-26 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-063',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-28 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-064',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-24 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-065',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-26 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-066',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-28 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-067',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-068',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-069',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-070',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-25 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-071',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-27 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-072',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-29 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-073',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-25 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-074',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-27 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-075',
            'instructor_id' => 13,
            'schedule_time' => '2020-08-29 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-076',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-25 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-077',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-27 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-078',
            'instructor_id' => 15,
            'schedule_time' => '2020-08-29 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-079',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-26 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-080',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-28 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-081',
            'instructor_id' => 3,
            'schedule_time' => '2020-08-30 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-082',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-26 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-083',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-28 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-084',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-30 02:30:00',
            'status' => 'Busy',
        ]);
// BATCH 1 WEEK 2
        Schedule::create([
            'code' => 'SCH-085',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-086',
            'instructor_id' => 1,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-087',
            'instructor_id' => 1,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-088',
            'instructor_id' => 2,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-089',
            'instructor_id' => 2,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-090',
            'instructor_id' => 2,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-091',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-01 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-092',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-03 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-093',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-05 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-094',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-01 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-095',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-03 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-096',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-05 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-097',
            'instructor_id' => 5,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-098',
            'instructor_id' => 5,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-099',
            'instructor_id' => 5,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-100',
            'instructor_id' => 6,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-101',
            'instructor_id' => 6,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-102',
            'instructor_id' => 6,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-103',
            'instructor_id' => 7,
            'schedule_time' => '2020-09-01 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-104',
            'instructor_id' => 7,
            'schedule_time' => '2020-09-03 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-105',
            'instructor_id' => 7,
            'schedule_time' => '2020-09-05 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-106',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-01 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-107',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-03 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-108',
            'instructor_id' => 4,
            'schedule_time' => '2020-09-05 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-109',
            'instructor_id' => 6,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-110',
            'instructor_id' => 6,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-111',
            'instructor_id' => 6,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-112',
            'instructor_id' => 8,
            'schedule_time' => '2020-08-31 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-113',
            'instructor_id' => 8,
            'schedule_time' => '2020-09-02 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-114',
            'instructor_id' => 8,
            'schedule_time' => '2020-09-04 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-115',
            'instructor_id' => 7,
            'schedule_time' => '2020-08-31 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-116',
            'instructor_id' => 7,
            'schedule_time' => '2020-09-02 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-117',
            'instructor_id' => 7,
            'schedule_time' => '2020-09-04 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-118',
            'instructor_id' => 9,
            'schedule_time' => '2020-08-31 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-119',
            'instructor_id' => 9,
            'schedule_time' => '2020-09-02 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-120',
            'instructor_id' => 9,
            'schedule_time' => '2020-09-04 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-121',
            'instructor_id' => 10,
            'schedule_time' => '2020-08-31 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-122',
            'instructor_id' => 10,
            'schedule_time' => '2020-09-02 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-123',
            'instructor_id' => 10,
            'schedule_time' => '2020-09-04 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-124',
            'instructor_id' => 11,
            'schedule_time' => '2020-08-31 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-125',
            'instructor_id' => 11,
            'schedule_time' => '2020-09-02 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-126',
            'instructor_id' => 11,
            'schedule_time' => '2020-09-04 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-127',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-01 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-128',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-03 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-129',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-05 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-130',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-01 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-131',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-03 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-132',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-05 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-133',
            'instructor_id' => 9,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-134',
            'instructor_id' => 9,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-135',
            'instructor_id' => 9,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-136',
            'instructor_id' => 14,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-137',
            'instructor_id' => 14,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-138',
            'instructor_id' => 14,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-139',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-02 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-140',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-04 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-141',
            'instructor_id' => 12,
            'schedule_time' => '2020-09-06 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-142',
            'instructor_id' => 2,
            'schedule_time' => '2020-09-02 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-143',
            'instructor_id' => 2,
            'schedule_time' => '2020-09-04 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-144',
            'instructor_id' => 2,
            'schedule_time' => '2020-09-06 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-145',
            'instructor_id' => 1,
            'schedule_time' => '2020-08-31 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-146',
            'instructor_id' => 1,
            'schedule_time' => '2020-09-02 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-147',
            'instructor_id' => 1,
            'schedule_time' => '2020-09-04 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-148',
            'instructor_id' => 5,
            'schedule_time' => '2020-08-31 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-149',
            'instructor_id' => 5,
            'schedule_time' => '2020-09-02 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-150',
            'instructor_id' => 5,
            'schedule_time' => '2020-09-04 20:40:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-151',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-152',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-153',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-154',
            'instructor_id' => 8,
            'schedule_time' => '2020-09-01 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-155',
            'instructor_id' => 8,
            'schedule_time' => '2020-09-03 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-156',
            'instructor_id' => 8,
            'schedule_time' => '2020-09-05 16:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-157',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-01 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-158',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-03 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-159',
            'instructor_id' => 13,
            'schedule_time' => '2020-09-05 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-160',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-01 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-161',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-03 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-162',
            'instructor_id' => 15,
            'schedule_time' => '2020-09-05 23:00:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-163',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-02 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-164',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-04 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-165',
            'instructor_id' => 3,
            'schedule_time' => '2020-09-06 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-166',
            'instructor_id' => 11,
            'schedule_time' => '2020-09-02 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-167',
            'instructor_id' => 11,
            'schedule_time' => '2020-09-04 02:30:00',
            'status' => 'Busy',
        ]);
        Schedule::create([
            'code' => 'SCH-168',
            'instructor_id' => 11,
            'schedule_time' => '2020-09-06 02:30:00',
            'status' => 'Busy',
        ]);

        /*factory(App\Models\Schedule::class, 50)
            ->states('Randomized')
            ->create()->make();*/
    }
}
