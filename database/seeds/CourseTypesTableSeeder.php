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
            'code'              => 'CT-001',
            'name'              => 'Private',
            'description'       => 'This is an one-on-one course.',
            'count_student_min' => 1,
            'count_student_max' => 1,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-002',
            'name'              => 'Group - Novice',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 3,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-003',
            'name'              => 'Group - Intermediate',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-004',
            'name'              => 'Group - Advanced',
            'description'       => 'This is a course consisting of more students than one.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-005',
            'name'              => 'Free Trial',
            'description'       => 'A group course limited to three days of learning.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
    }
}
