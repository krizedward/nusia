<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialPublic;

class oldMaterialPublicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MaterialPublic::class, 243)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
