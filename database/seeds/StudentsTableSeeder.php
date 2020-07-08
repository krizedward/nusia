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
        factory(App\Models\Student::class, 50)
            ->states('Randomized')
            ->create()->make();
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
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoDetail', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoPlace', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoPlace', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoPlace', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoPlace', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoInfo', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoInfo', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoInfo', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobStudentNoInfo', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessional', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoDetail', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoPlace', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoPlace', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoPlace', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoPlace', 'DeletedAtNoUpdate')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoInfo', 'CreatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoInfo', 'UpdatedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoInfo', 'DeletedAt')
            ->create()->make();
        factory(App\Models\Student::class, 3)
            ->states('Full', 'StatusJobProfessionalNoInfo', 'DeletedAtNoUpdate')
            ->create()->make();
    }
}
