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
// BATCH 1 WEEK 1
        Session::create([
            'code' => 'S-001',
            'course_id' => 1,
            'schedule_id' => 1,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-002',
            'course_id' => 1,
            'schedule_id' => 2,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-003',
            'course_id' => 1,
            'schedule_id' => 3,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-004',
            'course_id' => 2,
            'schedule_id' => 7,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-005',
            'course_id' => 2,
            'schedule_id' => 8,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-006',
            'course_id' => 2,
            'schedule_id' => 9,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-007',
            'course_id' => 3,
            'schedule_id' => 13,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-008',
            'course_id' => 3,
            'schedule_id' => 14,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-009',
            'course_id' => 3,
            'schedule_id' => 15,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-010',
            'course_id' => 4,
            'schedule_id' => 19,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-011',
            'course_id' => 4,
            'schedule_id' => 20,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-012',
            'course_id' => 4,
            'schedule_id' => 21,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-013',
            'course_id' => 5,
            'schedule_id' => 25,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-014',
            'course_id' => 5,
            'schedule_id' => 26,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-015',
            'course_id' => 5,
            'schedule_id' => 27,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-016',
            'course_id' => 6,
            'schedule_id' => 31,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-017',
            'course_id' => 6,
            'schedule_id' => 32,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-018',
            'course_id' => 6,
            'schedule_id' => 33,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-019',
            'course_id' => 7,
            'schedule_id' => 37,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-020',
            'course_id' => 7,
            'schedule_id' => 38,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-021',
            'course_id' => 7,
            'schedule_id' => 39,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-022',
            'course_id' => 8,
            'schedule_id' => 43,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-023',
            'course_id' => 8,
            'schedule_id' => 44,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-024',
            'course_id' => 8,
            'schedule_id' => 45,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-025',
            'course_id' => 9,
            'schedule_id' => 49,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-026',
            'course_id' => 9,
            'schedule_id' => 50,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-027',
            'course_id' => 9,
            'schedule_id' => 51,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-028',
            'course_id' => 10,
            'schedule_id' => 55,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-029',
            'course_id' => 10,
            'schedule_id' => 56,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-030',
            'course_id' => 10,
            'schedule_id' => 57,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-031',
            'course_id' => 11,
            'schedule_id' => 61,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-032',
            'course_id' => 11,
            'schedule_id' => 62,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-033',
            'course_id' => 11,
            'schedule_id' => 63,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-034',
            'course_id' => 12,
            'schedule_id' => 67,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-035',
            'course_id' => 12,
            'schedule_id' => 68,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-036',
            'course_id' => 12,
            'schedule_id' => 69,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-037',
            'course_id' => 13,
            'schedule_id' => 73,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-038',
            'course_id' => 13,
            'schedule_id' => 74,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-039',
            'course_id' => 13,
            'schedule_id' => 75,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-040',
            'course_id' => 14,
            'schedule_id' => 79,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-041',
            'course_id' => 14,
            'schedule_id' => 80,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-042',
            'course_id' => 14,
            'schedule_id' => 81,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
// BATCH 1 WEEK 2
        Session::create([
            'code' => 'S-043',
            'course_id' => 15,
            'schedule_id' => 85,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-044',
            'course_id' => 15,
            'schedule_id' => 86,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-045',
            'course_id' => 15,
            'schedule_id' => 87,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-046',
            'course_id' => 16,
            'schedule_id' => 91,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-047',
            'course_id' => 16,
            'schedule_id' => 92,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-048',
            'course_id' => 16,
            'schedule_id' => 93,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-049',
            'course_id' => 17,
            'schedule_id' => 97,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-050',
            'course_id' => 17,
            'schedule_id' => 98,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-051',
            'course_id' => 17,
            'schedule_id' => 99,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-052',
            'course_id' => 18,
            'schedule_id' => 103,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-053',
            'course_id' => 18,
            'schedule_id' => 104,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-054',
            'course_id' => 18,
            'schedule_id' => 105,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-055',
            'course_id' => 19,
            'schedule_id' => 109,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-056',
            'course_id' => 19,
            'schedule_id' => 110,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-057',
            'course_id' => 19,
            'schedule_id' => 111,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-058',
            'course_id' => 20,
            'schedule_id' => 115,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-059',
            'course_id' => 20,
            'schedule_id' => 116,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-060',
            'course_id' => 20,
            'schedule_id' => 117,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-061',
            'course_id' => 21,
            'schedule_id' => 121,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-062',
            'course_id' => 21,
            'schedule_id' => 122,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-063',
            'course_id' => 21,
            'schedule_id' => 123,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-064',
            'course_id' => 22,
            'schedule_id' => 127,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-065',
            'course_id' => 22,
            'schedule_id' => 128,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-066',
            'course_id' => 22,
            'schedule_id' => 129,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-067',
            'course_id' => 23,
            'schedule_id' => 133,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-068',
            'course_id' => 23,
            'schedule_id' => 134,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-069',
            'course_id' => 23,
            'schedule_id' => 135,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-070',
            'course_id' => 24,
            'schedule_id' => 139,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-071',
            'course_id' => 24,
            'schedule_id' => 140,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-072',
            'course_id' => 24,
            'schedule_id' => 141,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-073',
            'course_id' => 25,
            'schedule_id' => 145,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-074',
            'course_id' => 25,
            'schedule_id' => 146,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-075',
            'course_id' => 25,
            'schedule_id' => 147,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-076',
            'course_id' => 26,
            'schedule_id' => 151,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-077',
            'course_id' => 26,
            'schedule_id' => 152,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-078',
            'course_id' => 26,
            'schedule_id' => 153,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-079',
            'course_id' => 27,
            'schedule_id' => 157,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-080',
            'course_id' => 27,
            'schedule_id' => 158,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-081',
            'course_id' => 27,
            'schedule_id' => 159,
            'title' => 'Session 3',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-082',
            'course_id' => 28,
            'schedule_id' => 163,
            'title' => 'Session 1',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-083',
            'course_id' => 28,
            'schedule_id' => 164,
            'title' => 'Session 2',
            'description' => null,
            'requirement' => null,
            'link_zoom' => null,
        ]);
        Session::create([
            'code' => 'S-084',
            'course_id' => 28,
            'schedule_id' => 165,
            'title' => 'Session 3',
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
