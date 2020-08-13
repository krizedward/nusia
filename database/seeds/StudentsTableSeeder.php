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
        Student::create([
            'code'                             => 'STD-001',
            'user_id'                          => 4,
            'age'                              => 20,
            'status_job'                       => 'Student',
            'status_description'               => 'Universitas Ini',
            'interest'                         => 'Interest 1, Interest 2, Interest 3',
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => 'Deskripsi.',
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'Learning objective.',
        ]);

        Student::create([
            'code'                             => 'STD-002',
            'user_id'                          => 5,
            'age'                              => 30,
            'status_job'                       => 'Professional',
            'status_description'               => 'Tempat Kerja Ini',
            'interest'                         => 'Interest 1, Interest 2',
            'target_language_experience'       => '< 6 months',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => 'Deskripsi.',
            'indonesian_language_proficiency'  => 'Intermediate',
            'learning_objective'               => 'Learning objective.',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 6,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => '< 6 months',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 7,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 8,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 9,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 10,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 11,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 12,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 13,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 14,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 15,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        Student::create([
            'code'                             => null,
            'user_id'                          => 16,
            'age'                              => 0,
            'status_job'                       => 'Student',
            'status_description'               => null,
            'interest'                         => null,
            'target_language_experience'       => 'Never (no experience)',
            'target_language_experience_value' => null,
            'description_of_course_taken'      => null,
            'indonesian_language_proficiency'  => 'Novice',
            'learning_objective'               => 'null',
        ]);

        /*factory(App\Models\Student::class, 200)
            ->states('Randomized')
            ->create()->make();*/
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
