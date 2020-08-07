<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLevel;

class oldCourseLevelsTableSeeder extends Seeder
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
            'slug'        => Str::random(255),
            'code'        => '0',
            'name'        => 'Not Defined',
            'description' => 'This describes a course level that does not exist.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'slug'        => Str::random(255),
            'code'        => 'N',
            'name'        => 'Novice',
            'description' => 'This level consists of novice-low, novice-mid, and novice-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'slug'        => Str::random(255),
            'code'        => 'I',
            'name'        => 'Intermediate',
            'description' => 'This level consists of intermediate-low, intermediate-mid, and intermediate-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'slug'        => Str::random(255),
            'code'        => 'A',
            'name'        => 'Advanced',
            'description' => 'This level consists of advanced-low, advanced-mid, and advanced-high difficulties.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
