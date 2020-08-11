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
        SessionRegistration::create([
            'code' => 'SRG-001',
            'session_id' => 1,
            'course_registration_id' => 1,
            'registration_time' => '2020-08-11 06:26:35',
            'status' => 'Present',
        ]);
        /*
        factory(App\Models\SessionRegistration::class, 2500)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
