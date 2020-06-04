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
        $this->call(ClassroomsTableSeeder::class);
        $this->call(InstructorsTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
