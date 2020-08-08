<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLevel;

class CourseLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\CourseLevel::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevel::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevel::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevel::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevel::class, 1)
            ->states('Randomized')
            ->create()
            ->make();*/

        CourseLevel::create ([
            'code'        => 'CL-001',
            'name'        => 'Novice',
            'description' => 'This level consists of novice-low, novice-mid, and novice-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'code'        => 'CL-002',
            'name'        => 'Intermediate',
            'description' => 'This level consists of intermediate-low, intermediate-mid, and intermediate-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'code'        => 'CL-003',
            'name'        => 'Advanced',
            'description' => 'This level consists of advanced-low, advanced-mid, and advanced-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
