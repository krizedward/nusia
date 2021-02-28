<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialPublic;

class MaterialPublicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaterialPublic::create([
            'code' => 'MP-0000001',
            'course_package_id' => 1,
            'name' => 'Session 1 - CLASSROOM INSTRUCTIONS',
            'description' => null,
            'path' => '1_Session 1 - CLASSROOM INSTRUCTIONS.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000002',
            'course_package_id' => 1,
            'name' => 'Session 1 - ALPHABET',
            'description' => null,
            'path' => '2_Session 1 - ALPHABET.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000003',
            'course_package_id' => 1,
            'name' => 'Session 2 - VOCAB (2nd MEETING)',
            'description' => null,
            'path' => '3_Session 2 - VOCAB (2nd MEETING).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000004',
            'course_package_id' => 1,
            'name' => 'Session 3 - VOCAB (3rd MEETING)',
            'description' => null,
            'path' => '4_Session 3 - VOCAB (3rd MEETING).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000005',
            'course_package_id' => 2,
            'name' => 'Session 1 - MiraLesmana',
            'description' => null,
            'path' => '5_Session 1 - MiraLesmana.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000006',
            'course_package_id' => 2,
            'name' => 'Session 1 - WORKSHEET (1st meeting)',
            'description' => null,
            'path' => '6_Session 1 - WORKSHEET (1st meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000007',
            'course_package_id' => 2,
            'name' => 'Session 2 - WORKSHEET (2nd meeting)',
            'description' => null,
            'path' => '7_Session 2 - WORKSHEET (2nd meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000008',
            'course_package_id' => 2,
            'name' => 'Session 3 - Teks minggu 3',
            'description' => null,
            'path' => '8_Session 3 - Teks minggu 3.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000009',
            'course_package_id' => 2,
            'name' => 'Session 3 - WORKSHEET (3rd meeting)',
            'description' => null,
            'path' => '9_Session 3 - WORKSHEET (3rd meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000010',
            'course_package_id' => 3,
            'name' => 'Session 2 - WORKSHEET (2nd meeting)',
            'description' => null,
            'path' => '10_Session 2 - WORKSHEET (2nd meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000011',
            'course_package_id' => 3,
            'name' => 'Session 3 - WORKSHEET (3rd meeting)',
            'description' => null,
            'path' => '11_Session 3 - WORKSHEET (3rd meeting).pdf',
        ]);

        /*
        factory(App\Models\MaterialPublic::class, 243)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
