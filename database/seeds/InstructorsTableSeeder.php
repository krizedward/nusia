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
        Instructor::create([
            'code'               => 'INS-001',
            'user_id'            => 2,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-002',
            'user_id'            => 3,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-003',
            'user_id'            => 4,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-004',
            'user_id'            => 5,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-005',
            'user_id'            => 6,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-006',
            'user_id'            => 7,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-007',
            'user_id'            => 8,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-008',
            'user_id'            => 9,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-009',
            'user_id'            => 10,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-010',
            'user_id'            => 11,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-011',
            'user_id'            => 12,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-012',
            'user_id'            => 13,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-013',
            'user_id'            => 14,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-014',
            'user_id'            => 15,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-015',
            'user_id'            => 16,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-016',
            'user_id'            => 17,
            'interest'           => null,
            'working_experience' => null,
            'created_at'         => now(),
            'updated_at'         => null
        ]);

        /*factory(App\Models\Instructor::class, 50)
            ->states('Randomized')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();*/
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
            ->make();*/
    }
}
