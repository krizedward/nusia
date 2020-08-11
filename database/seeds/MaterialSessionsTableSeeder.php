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
        MaterialSession::create([
            'code' => 'MS-001',
            'session_id' => 1,
            'name' => 'test',
            'description' => 'test',
            'path' => 'test',
        ]);
        /*
        factory(App\Models\MaterialSession::class, 1500)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
