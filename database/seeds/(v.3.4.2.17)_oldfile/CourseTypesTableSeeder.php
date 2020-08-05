<?php

use Illuminate\Database\Seeder;
use App\Models\CourseType;

class CourseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();*/

        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => '0',
            'name'              => 'Not Defined',
            'description'       => 'This describes a course type that does not exist.',
            'count_student_min' => null,
            'count_student_max' => null,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'P',
            'name'              => 'Private',
            'description'       => 'This is an one-on-one course.',
            'count_student_min' => 1,
            'count_student_max' => 1,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'G',
            'name'              => 'Group (General)',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'N',
            'name'              => 'Group (Novice)',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 3,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'I',
            'name'              => 'Group (Intermediate)',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'A',
            'name'              => 'Group (Advanced)',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'slug'              => Str::random(255),
            'code'              => 'T',
            'name'              => 'Trial',
            'description'       => 'A group course limited to three days of learning.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
    }
}
