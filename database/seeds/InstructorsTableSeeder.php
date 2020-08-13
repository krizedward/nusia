<?php

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\Schedule;

class InstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instructor::create([
            'code'               => 'INS-001',
            'user_id'            => 2,
            'interest'           => 'Interest 1',
            'working_experience' => '2016-2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang',
            'created_at'         => '2020-08-07 05:12:10',
            'updated_at'         => null
        ]);

        Instructor::create([
            'code'               => 'INS-002',
            'user_id'            => 3,
            'interest'           => 'Interest 1, Interest 3, Interest 4, Interest 5',
            'working_experience' => '2016-2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang|| 2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Ateneo de Davao University (AdDU), University of Southeastern Philippines (USeP), Mindanao Kokusai Daigaku (Mindanao International College), University of Mindanao (UM), Philippine National Police (PNP), Naval Forces Eastern Mindanao (NFEM), and Consulate General of the Republic of Indonesia, Davao City, Philippines',
            'created_at'         => '2020-08-07 05:12:10',
            'updated_at'         => null
        ]);

        /*factory(App\Models\Instructor::class, 50)
            ->states('Randomized')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();*/
        /*factory(App\Models\Instructor::class, 3)
            ->states('Full', 'CreatedAt')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 3)
            ->states('Full', 'UpdatedAt')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 2)
            ->states('Interest', 'WorkingExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 1)
            ->states('Interest')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();
        factory(App\Models\Instructor::class, 1)
            ->states('WorkingExperience')
            ->create()
            ->each(function($instructor) {
                factory(App\Models\Schedule::class, 50)
                    ->states('Randomized')
                    ->create(['instructor_id' => $instructor->id])
                    ->make();
            })
            ->make();*/
    }
}
