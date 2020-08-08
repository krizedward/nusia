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
            'name'        => 'Fixed Materials',
            'description' => 'We offer you a set of learning materials based on your Indonesian language proficiency: novice, intermediate, advanced based on NUSIA curriculum that is in line with American Council on the Teaching of Foreign Language (ACTFL) proficiency guidelines.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        MaterialType::create ([
            'code'        => 'MT-002',
            'name'        => 'Customized Materials',
            'description' => 'Are you a professional who needs to learn Indonesian language? (or) Are you a learner who has already joined Indonesian class at your school but needs a help to enhance your competence? (or) Do you want to learn a specific topic in Indonesian language? This is the best option for you! We will provide you customized materials that match with your needs.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        MaterialType::create ([
            'code'        => 'MT-003',
            'name'        => 'Basic Conversation',
            'description' => 'Are you going to visit Indonesia for several days or weeks and need to get familiar and able to speak in daily conversation context? We offer you learning materials that cover all-you-have-to-know and boost your speaking skills in no time!',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
