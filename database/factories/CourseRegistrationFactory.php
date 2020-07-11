<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CourseRegistration;
use App\Models\Course;
use App\Models\CoursePackage;
use App\Models\CourseType;
use App\Models\Student;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use Faker\Generator;
use Faker\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
| List of state(s):
| 'NULL'              => Giving no additional parameters (return an empty array).
| 'Full'              => Specify all nullable parameter(s) to be NOT NULL.
| 'Randomized'        => Specify random combination for all parameter(s).
| 'CreatedAt'         => Specify a value for created_at.
| 'UpdatedAt'         => Specify a value for created_at and updated_at.
|
*/

$factory->define(App\Models\CourseRegistration::class, function (Faker\Generator $faker) {
    $course_types = CourseType::all();
    $course_packages = CoursePackage::all();
    $courses = Course::all();
    $students = Student::all();

    $course_types_count = $course_types->count();
    $course_packages_count = $course_packages->count();
    $courses_count = $courses->count();
    $students_count = $students->count();

    $course_type = null;
    $course_package = null;
    $course = null;

    $course_id = 0;
    $student_id = 0;

    // Possible infinite loop when all courses are full.
    while(1) {
        $id = $faker->numberBetween($min = 1, $max = $course_types_count);
        $course_type = $course_types->firstWhere('id', $id);
        $course_count_student_max = $course_type->count_student_max;
        if($course_count_student_max == null) continue;

        $id = $faker->numberBetween($min = 1, $max = $course_packages_count);
        $course_packages_temp = $course_packages->where('course_type_id', $id);
        if($course_packages_temp == null) continue;

        $id = $faker->numberBetween($min = 1, $max = $course_packages_count);
        $course_package = $course_packages_temp->firstWhere('id', $id);
        if($course_package == null) continue;

        $courses_temp = $courses->where('course_package_id', $id);
        if($courses_temp == null) continue;

        $id = $faker->numberBetween($min = 1, $max = $courses_count);
        $course = $courses_temp->firstWhere('id', $id);
        if($course == null) continue;

        $course_id = $id;
        $course_registrations_count = CourseRegistration::where('course_id', $course_id)->count();

        if($course_registrations_count + 1 > $course_count_student_max) continue;

        // Possible infinite loop when all students have been registered in a specific course.
        while(1) {
            $student_id = $faker->numberBetween($min = 1, $max = $students->count());

            $course_registration = CourseRegistration
                ::where('course_id', $course_id)
                ->where('student_id', $student_id)
                ->count();
            $has_registered_before = ($course_registration)? 1 : 0;

            if($has_registered_before) continue;
            break;
        }
        break;
    }

    return [
        'course_id'  => $course_id,
        'student_id' => $student_id,
        'created_at' => now(),
        'updated_at' => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\CourseRegistration::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'Full', function ($faker) {
    return [
        'created_at'    => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'    => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'Randomized', function ($faker) {
    $may_have_created_at = ($faker->boolean($chanceOfGettingTrue = 90))? 1 : 0;
    $may_have_updated_at = ($faker->boolean($chanceOfGettingTrue = 50))? 1 : 0;

    $created_at =
        ($may_have_created_at)? (
            ($may_have_updated_at)? (
                $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null)
            ) : $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        ) : null;
    $updated_at =
        ($may_have_updated_at)? (
            $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        ) : null;

    return [
        'created_at'    => $created_at,
        'updated_at'    => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});