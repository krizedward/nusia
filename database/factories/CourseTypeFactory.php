<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CourseType;
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

$factory->define(App\Models\CourseType::class, function (Faker\Generator $faker) {
    $code = $faker->randomLetter;

    return [
        'slug'              => Str::random(255),
        'code'              => $faker->randomLetter,
        'name'              => 'Course Type '.$code,
        'description'       => null,
        'count_student_min' => null,
        'count_student_max' => null,
        'created_at'        => now(),
        'updated_at'        => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\CourseType::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'Full', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];

    $code = $faker->randomLetter;
    $count_student_min = $faker->numberBetween($min = 1, $max = 10);
    $count_student_max = $faker->numberBetween($min = $count_student_min, $max = 10);

    return [
        'code'              => $code,
        'name'              => 'Course Type '.$code,
        'description'       => $faker->randomElement($array = $descriptions),
        'count_student_min' => $count_student_min,
        'count_student_max' => $count_student_max,
        'created_at'        => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];

    $code = $faker->randomLetter;
    $description =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $descriptions) : null;
    $count_student_min =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->numberBetween($min = 1, $max = 10) : null;
    $count_student_max =
        ($faker->boolean($chanceOfGettingTrue = 50 && ($count_student_min != null)))?
            $faker->numberBetween($min = $count_student_min, $max = 10) : null;

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
        'code'              => $code,
        'name'              => 'Course Type '.$code,
        'description'       => $description,
        'count_student_min' => $count_student_min,
        'count_student_max' => $count_student_max,
        'created_at'        => $created_at,
        'updated_at'        => $updated_at,
        'deleted_at'        => $deleted_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'DeletedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CourseType::class, 'DeletedAtNoUpdate', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});