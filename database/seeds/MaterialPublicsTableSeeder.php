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
            'name' => 'CLASSROOM INSTRUCTIONS',
            'description' => null,
            'path' => '1_CLASSROOM INSTRUCTIONS.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000002',
            'course_package_id' => 1,
            'name' => 'ALPHABET',
            'description' => null,
            'path' => '2_ALPHABET.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000003',
            'course_package_id' => 1,
            'name' => 'VOCAB (2nd MEETING)',
            'description' => null,
            'path' => '3_VOCAB (2nd MEETING).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000004',
            'course_package_id' => 1,
            'name' => 'VOCAB (3rd MEETING)',
            'description' => null,
            'path' => '4_VOCAB (3rd MEETING).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000005',
            'course_package_id' => 2,
            'name' => 'MiraLesmana',
            'description' => null,
            'path' => '5_MiraLesmana.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000006',
            'course_package_id' => 2,
            'name' => 'WORKSHEET (1st meeting)',
            'description' => null,
            'path' => '6_WORKSHEET (1st meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000007',
            'course_package_id' => 2,
            'name' => 'WORKSHEET (2nd meeting)',
            'description' => null,
            'path' => '7_WORKSHEET (2nd meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000008',
            'course_package_id' => 2,
            'name' => 'Teks minggu 3',
            'description' => null,
            'path' => '8_Teks minggu 3.pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000009',
            'course_package_id' => 2,
            'name' => 'WORKSHEET (3rd meeting)',
            'description' => null,
            'path' => '9_WORKSHEET (3rd meeting).pdf',
        ]);
        MaterialPublic::create([
            'code' => 'MP-0000010',
            'course_package_id' => 3,
            'name' => 'WORKSHEET (2nd meeting)',
            'description' => null,
            'path' => '10_WORKSHEET (2nd meeting).pdf',
        ]);

        /*
        factory(App\Models\MaterialPublic::class, 243)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
