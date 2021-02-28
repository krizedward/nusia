<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialType;

class MaterialTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\MaterialType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\MaterialType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\MaterialType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\MaterialType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\MaterialType::class, 1)
            ->states('Randomized')
            ->create()
            ->make();*/

        MaterialType::create ([
            'code'        => 'MT-001',
            'name'        => 'General Indonesian Language',
            'description' => 'We offer a set of learning materials to boost your Indonesian language proficiency. The materials are developed based on a NUSIA curriculum which refers to American Council on the Teaching of Foreign Language (ACTFL) proficiency guidelines. This course covers all four language skills: reading, listening, writing, and speaking.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        MaterialType::create ([
            'code'        => 'MT-002',
            'name'        => 'Basic Conversation (for travelers)',
            'description' => 'Are you going to visit Indonesia for several days or weeks and need to get familiar and be able to speak in daily conversation context? We offer you learning materials that cover day-to-day contexts and boost your speaking skills in no time!',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        MaterialType::create ([
            'code'        => 'MT-003',
            'name'        => 'Conversation for Kids & Teenagers',
            'description' => 'We offer a set of learning materials to improve your Indonesian language proficiency. The curriculum for this course is specially made based on curricula to teach the Indonesian language for kids and teenagers in Australia and Germany. The learning materials and the teaching method are designed to suit learners’ age and needs.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        MaterialType::create ([
            'code'        => 'MT-004',
            'name'        => 'Indonesian Language for Specific Purposes',
            'description' => 'Are you a professional who needs to learn the Indonesian language? (or) Are you a learner who has already joined an Indonesian class at your school but needs help to enhance your competence? (or) Do you want to learn a specific topic in the Indonesian language? This is the best option for you! We will provide you customized materials that match with your needs.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
