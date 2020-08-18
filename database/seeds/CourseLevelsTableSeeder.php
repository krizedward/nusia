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
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'code'        => 'CL-002',
            'name'        => 'Intermediate',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevel::create ([
            'code'        => 'CL-003',
            'name'        => 'Advanced',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
