<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Student::class, 3)
            ->states('Full', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'DeletedAtNoUpdate')
            ->create()->make();
        /*factory(App\Models\Student::class, 2)
            ->states('Interest', 'WorkingExperience')
            ->create()->make();
        factory(App\Models\Student::class, 2)
            ->states('Interest', 'EducationalExperience')
            ->create()->make();
        factory(App\Models\Student::class, 2)
            ->states('WorkingExperience', 'EducationalExperience')
            ->create()->make();
        factory(App\Models\Student::class, 1)
            ->states('Interest')
            ->create()->make();
        factory(App\Models\Student::class, 1)
            ->states('WorkingExperience')
            ->create()->make();
        factory(App\Models\Student::class, 1)
            ->states('EducationalExperience')
            ->create()->make();*/
    }
}
