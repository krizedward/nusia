<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialSession;

class MaterialSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MaterialSession::class, 1500)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
