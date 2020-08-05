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
            'slug'        => Str::random(255),
            'code'        => '0',
            'name'        => 'Not Defined',
            'description' => 'This describes a course level (detailed) that does not exist.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevelDetail::create ([
            'slug'        => Str::random(255),
            'code'        => 'L',
            'name'        => 'Low',
            'description' => 'This describes a difficulty that is lower than mid difficulty.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevelDetail::create ([
            'slug'        => Str::random(255),
            'code'        => 'M',
            'name'        => 'Mid',
            'description' => 'This describes a difficulty that is higher than low difficulty.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
        CourseLevelDetail::create ([
            'slug'        => Str::random(255),
            'code'        => 'H',
            'name'        => 'High',
            'description' => 'This describes a difficulty that is higher than mid difficulty.',
            'created_at'  => now(),
            'updated_at'  => null
        ]);
    }
}
