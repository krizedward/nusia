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
            'description'       => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'count_student_min' => 2,
            'count_student_max' => 3,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-003',
            'name'              => 'Group - Intermediate',
            'description'       => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'count_student_min' => 2,
            'count_student_max' => 4,
            'created_at'        => now(),
            'updated_at'        => null
        ]);
        CourseType::create ([
            'code'              => 'CT-004',
            'name'              => 'Group - Advanced',
            'description'       => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
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
