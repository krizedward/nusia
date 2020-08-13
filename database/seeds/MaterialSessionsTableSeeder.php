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
            'name' => 'Material Session 001',
            'description' => null,
            'path' => null,
        ]);
        MaterialSession::create([
            'code' => 'MS-002',
            'session_id' => 2,
            'name' => 'Material Session 002',
            'description' => null,
            'path' => null,
        ]);
        MaterialSession::create([
            'code' => 'MS-003',
            'session_id' => 3,
            'name' => 'Material Session 003',
            'description' => null,
            'path' => null,
        ]);
        MaterialSession::create([
            'code' => 'MS-004',
            'session_id' => 4,
            'name' => 'Material Session 004',
            'description' => null,
            'path' => null,
        ]);
        MaterialSession::create([
            'code' => 'MS-005',
            'session_id' => 5,
            'name' => 'Material Session 005',
            'description' => null,
            'path' => null,
        ]);
        /*MaterialSession::create([
            'code' => 'MS-001',
            'session_id' => 1,
            'name' => 'test',
            'description' => 'test',
            'path' => 'test',
        ]);*/
        /*
        factory(App\Models\MaterialSession::class, 1500)
            ->states('Randomized')
            ->create()
            ->make();
        */
    }
}
