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
        $this->call(MaterialTypesTableSeeder::class);
        $this->call(CourseTypesTableSeeder::class);
        $this->call(CourseLevelsTableSeeder::class);
        $this->call(CourseLevelDetailsTableSeeder::class);
        $this->call(CoursePackagesTableSeeder::class);
        //create by edward
        $this->call(CoursesTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(CourseRegistrationsTableSeeder::class);
        $this->call(CourseCertificatesTableSeeder::class);
        $this->call(CoursePaymentsTableSeeder::class);
        $this->call(MaterialPublicsTableSeeder::class);
        $this->call(MaterialSessionsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(SessionRegistrationsTableSeeder::class);

        // add FORMS
        $this->call(FormsTableSeeder::class);


        /*
        $this->call(UsersTableSeeder::class);
        $this->call(InstructorsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(MaterialTypesTableSeeder::class);
        $this->call(CourseTypesTableSeeder::class);
        $this->call(CourseLevelsTableSeeder::class);
        $this->call(CourseLevelDetailsTableSeeder::class);
        $this->call(CoursePackagesTableSeeder::class);
        */
    }
}
