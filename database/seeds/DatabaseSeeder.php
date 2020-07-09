<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InstructorsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class); 
        $this->call(MaterialTypesTableSeeder::class);
        $this->call(CourseTypesTableSeeder::class);
        $this->call(CourseLevelsTableSeeder::class);
        $this->call(CourseLevelDetailsTableSeeder::class);
        $this->call(CoursePackagesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(CourseRegistrationsTableSeeder::class); // Sedang dikerjakan.
        /*$this->call(CoursePaymentsTableSeeder::class);
        $this->call(CourseCertificatesTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(SessionRegistrationsTableSeeder::class);
        $this->call(MaterialPublicsTableSeeder::class);
        $this->call(MaterialSessionsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);*/
    }
}
