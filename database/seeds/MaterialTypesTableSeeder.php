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
        factory(App\Models\MaterialType::class, 5)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
