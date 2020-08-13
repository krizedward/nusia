<?php

use Illuminate\Database\Seeder;
use App\Models\CourseLevelDetail;

class CourseLevelDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();
        factory(App\Models\CourseLevelDetail::class, 1)
            ->states('Randomized')
            ->create()
            ->make();*/

        CourseLevelDetail::create ([
            'code'        => 'CLD-001',
            'name'        => 'Low',
            'description' => 'This describes a difficulty that is lower than mid difficulty.',
            'created_at'  => '2020-08-07 05:12:10',
            'updated_at'  => null
        ]);
        CourseLevelDetail::create ([
            'code'        => 'CLD-002',
            'name'        => 'Mid',
            'description' => 'This describes a difficulty that is higher than low difficulty.',
            'created_at'  => '2020-08-07 05:12:10',
            'updated_at'  => null
        ]);
        CourseLevelDetail::create ([
            'code'        => 'CLD-003',
            'name'        => 'High',
            'description' => 'This describes a difficulty that is higher than mid difficulty.',
            'created_at'  => '2020-08-07 05:12:10',
            'updated_at'  => null
        ]);
    }
}
