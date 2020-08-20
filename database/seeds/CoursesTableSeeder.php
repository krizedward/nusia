<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.
You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.
You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.

// BATCH 1 WEEK 1
        Course::create([
            'code' => 'C-001',
            'course_package_id' => 1,
            'title' => 'Class A',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-002',
            'course_package_id' => 1,
            'title' => 'Class B',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-003',
            'course_package_id' => 1,
            'title' => 'Class C',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-004',
            'course_package_id' => 1,
            'title' => 'Class D',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-005',
            'course_package_id' => 2,
            'title' => 'Class A',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-006',
            'course_package_id' => 2,
            'title' => 'Class B',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-007',
            'course_package_id' => 2,
            'title' => 'Class C',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-008',
            'course_package_id' => 2,
            'title' => 'Class D',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-009',
            'course_package_id' => 2,
            'title' => 'Class E',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-010',
            'course_package_id' => 3,
            'title' => 'Class A',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-011',
            'course_package_id' => 3,
            'title' => 'Class B',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-012',
            'course_package_id' => 3,
            'title' => 'Class C',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-013',
            'course_package_id' => 3,
            'title' => 'Class D',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-014',
            'course_package_id' => 3,
            'title' => 'Class E',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);

// BATCH 1 WEEK 2
        Course::create([
            'code' => 'C-015',
            'course_package_id' => 1,
            'title' => 'Class E',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-016',
            'course_package_id' => 1,
            'title' => 'Class F',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-017',
            'course_package_id' => 1,
            'title' => 'Class G',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-018',
            'course_package_id' => 1,
            'title' => 'Class H',
            'description' => 'You are categorized as a novice learner when you have no or limited prior Indonesian language knowledge. In free online classes, you are going to learn about greetings, how to introduce yourself and someone else, as well as how to ask someone’s information.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-019',
            'course_package_id' => 2,
            'title' => 'Class F',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-020',
            'course_package_id' => 2,
            'title' => 'Class G',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-021',
            'course_package_id' => 2,
            'title' => 'Class H',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-022',
            'course_package_id' => 2,
            'title' => 'Class I',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-023',
            'course_package_id' => 2,
            'title' => 'Class J',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-024',
            'course_package_id' => 2,
            'title' => 'Class K',
            'description' => 'You are identified as an intermediate learner when you can handle a simple situation or transaction in the Indonesian language. In free online classes, you will learn about introduction, diseases and its symptoms, as well as Indonesian traditional culinary.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-025',
            'course_package_id' => 3,
            'title' => 'Class F',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-026',
            'course_package_id' => 3,
            'title' => 'Class G',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-027',
            'course_package_id' => 3,
            'title' => 'Class H',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);
        Course::create([
            'code' => 'C-028',
            'course_package_id' => 3,
            'title' => 'Class I',
            'description' => 'You are categorized as an advanced learner when you are able to handle a complicated situation or transaction in the Indonesian language. You are going to learn about introduction and a general knowledge of Indonesia, Indonesian culinary, and the current world’s phenomenon in free online classes.',
            'requirement' => null,
        ]);

        /*
        factory(App\Models\Course::class, 150)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
