<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CoursePackage;
use App\Models\MaterialType;
use App\Models\CourseType;
use App\Models\CourseLevel;
use App\Models\CourseLevelDetail;
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

$factory->define(App\Models\CoursePackage::class, function (Faker\Generator $faker) {
    $material_types = MaterialType::all();
    $material_type_id = $faker->numberBetween($min = 1, $max = $material_types->count());
    $course_types = CourseType::all();
    $course_type_id = $faker->numberBetween($min = 1, $max = $course_types->count());
    $course_levels = CourseLevel::all();
    $course_level_id = $faker->numberBetween($min = 1, $max = $course_levels->count());
    $course_level_details = CourseLevelDetail::all();
    $course_level_detail_id = $faker->numberBetween($min = 1, $max = $course_level_details->count());

    return [
        'slug'                   => Str::random(255),
        'material_type_id'       => $material_type_id,
        'course_type_id'         => $course_type_id,
        'course_level_id'        => $course_level_id,
        'course_level_detail_id' => $course_level_detail_id,
        'title'                  => 'Course Package '.$faker->randomLetter,
        'description'            => null,
        'requirement'            => null,
        'count_session'          => null,
        'price'                  => null,
        'created_at'             => now(),
        'updated_at'             => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\CoursePackage::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'Full', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

    return [
        'title'         => 'Course Package '.$faker->randomLetter,
        'description'   => $faker->randomElement($array = $descriptions),
        'requirement'   => $faker->randomElement($array = $requirements),
        'count_session' => $faker->numberBetween($min = 1, $max = 15),
        'price'         => $faker->numberBetween($min = 20, $max = 30),
        'created_at'    => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'    => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

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
        'title'         => 'Course Package '.$faker->randomLetter,
        'description'   => $description,
        'requirement'   => $requirement,
        'count_session' => $count_session,
        'price'         => $price,
        'created_at'    => $created_at,
        'updated_at'    => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});