<?php

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\Schedule;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Instructor::class, 50)
            ->states('Randomized')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        /*factory(App\Models\Instructor::class, 3)
            ->states('Full', 'CreatedAt')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 3)
            ->states('Full', 'UpdatedAt')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 2)
            ->states('Interest', 'WorkingExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 2)
            ->states('Interest', 'EducationalExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 2)
            ->states('WorkingExperience', 'EducationalExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 1)
            ->states('Interest')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 1)
            ->states('WorkingExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 1)
            ->states('EducationalExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();*/
    }
}
