<?php

use Illuminate\Database\Seeder;
use App\Models\SessionRegistration;

class SessionRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*SessionRegistration::create([
            'code' => 'SR-001',
            'session_id' => 1,
            'course_registration_id' => 1,
            'registration_time' => null,
            'status' => 'Not Present',
        ]);
        SessionRegistration::create([
            'code' => 'SR-002',
            'session_id' => 2,
            'course_registration_id' => 1,
            'registration_time' => null,
            'status' => 'Present',
        ]);
        SessionRegistration::create([
            'code' => 'SR-003',
            'session_id' => 3,
            'course_registration_id' => 2,
            'registration_time' => '2020-08-12 00:00:00', // may have bug (?)
            'status' => 'Not Present',
        ]);
        SessionRegistration::create([
            'code' => 'SR-004',
            'session_id' => 4,
            'course_registration_id' => 3,
            'registration_time' => null,
            'status' => 'Not Present',
        ]);*/
        /*SessionRegistration::create([
            'code' => 'SRG-001',
            'session_id' => 1,
            'course_registration_id' => 1,
            'registration_time' => '2020-08-11 06:26:35',
            'status' => 'Present',
        ]);*/
        /*
        factory(App\Models\SessionRegistration::class, 2500)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
