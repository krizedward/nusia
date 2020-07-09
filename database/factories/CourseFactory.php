<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Course;
use App\Models\CoursePackage;
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

$factory->define(App\Models\Course::class, function (Faker\Generator $faker) {
    $course_packages = CoursePackage::all();
    $course_package_id = $faker->numberBetween($min = 1, $max = $course_packages->count());

    return [
        'slug'                   => Str::random(255),
        'course_package_id'      => $course_package_id,
        'title'                  => null,
        'description'            => null,
        'requirement'            => null,
        'created_at'             => now(),
        'updated_at'             => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\Course::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Course::class, 'Full', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

    return [
        'title'         => 'Course '.$faker->randomLetter,
        'description'   => $faker->randomElement($array = $descriptions),
        'requirement'   => $faker->randomElement($array = $requirements),
        'created_at'    => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'    => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Course::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

    $title =
        ($faker->boolean($chanceOfGettingTrue = 70))?
            'Course '.$faker->randomLetter : null;
    $description =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $descriptions) : null;
    $requirement =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $requirements) : null;
    $count_session =
        ($faker->boolean($chanceOfGettingTrue = 70))?
            $faker->numberBetween($min = 1, $max = 15) : null;
    $price =
        ($faker->boolean($chanceOfGettingTrue = 70))?
            $faker->numberBetween($min = 20, $max = 30) : null;

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
        'title'         => $title,
        'description'   => $description,
        'requirement'   => $requirement,
        'created_at'    => $created_at,
        'updated_at'    => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Course::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Course::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});