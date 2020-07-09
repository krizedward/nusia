<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CourseRegistration;
use App\Models\Course;
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
| 'DeletedAt'         => Specify a value for created_at, updated_at, and deleted_at.
| 'DeletedAtNoUpdate' => Specify a value for created_at and deleted_at (excluding updated_at).
|
*/

$factory->define(App\Models\CourseRegistration::class, function (Faker\Generator $faker) {
    $courses = Course::all();
    $students = Student::all();

    $course_id = 0;
    $student_id = 0;

    // Possible infinite loop when all courses are full.
    while(1) {
        $course_id = $faker->numberBetween($min = 1, $max = $courses->count());
        $course_registration_count = CourseRegistration::where('course_id', $course_id)->count();

        $course = $courses->firstWhere('id', $course_id);
        $course_count_student_max = $course->course_package->course_type->count_student_max;

        if($course_registration_count + 1 > $course_count_student_max) continue;

        // Possible infinite loop when all students have been registered in a specific course.
        while(1) {
            $student_id = $faker->numberBetween($min = 1, $max = $students->count());

            $course_registrations = CourseRegistration::where('course_id', $course_id);
            $has_registered_before = ($course_registrations->firstWhere('student_id', $student_id) != null)? 1 : 0;

            if($has_registered_before) continue;
            else break;
        }
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
    $may_have_deleted_at = ($faker->boolean($chanceOfGettingTrue = 20))? 1 : 0;

    $created_at =
        ($may_have_created_at)? (
            ($may_have_updated_at && $may_have_deleted_at)? (
                $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null)
            ) : (
                    ($may_have_updated_at || $may_have_deleted_at)? (
                        $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null)
                    ) : $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
            )
        ) : null;
    $updated_at =
        ($may_have_updated_at)? (
            ($may_have_deleted_at)? (
                $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null)
            ) : $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        ) : null;
    $deleted_at =
        ($may_have_deleted_at)? (
            ($may_have_updated_at)? (
                $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null)
            ) : $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        ) : null;

    return [
        'created_at'    => $created_at,
        'updated_at'    => $updated_at,
        'deleted_at'    => $deleted_at
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

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'DeletedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseRegistration::class, 'DeletedAtNoUpdate', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});