<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class oldStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Student::class, 200)
            ->states('Randomized')
            ->create()->make();
        /*factory(App\Models\Student::class, 3)
            ->states('Full', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 6)
            ->states('Full', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 6)
            ->states('Full', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 6)
            ->states('Full', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 6)
            ->states('Full', 'UpdatedAt')
            ->create()->make();*/
    }
}
