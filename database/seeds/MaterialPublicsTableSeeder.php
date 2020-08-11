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
            'code' => 'MP-001',
            'course_package_id' => 1,
            'name' => 'test',
            'description' => 'test',
            'path' => 'test',
        ]);
        /*
        factory(App\Models\MaterialPublic::class, 243)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
