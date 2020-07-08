<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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
| 'DeletedAt'         => Specify a value for created_at, updated_at, and deleted_at.
| 'DeletedAtNoUpdate' => Specify a value for created_at and deleted_at (excluding updated_at).
|
*/

$factory->define(App\Models\CoursePackage::class, function (Faker\Generator $faker) {
    return [
        'slug'                   => Str::random(255),
        'material_type_id'       => factory(App\Models\MaterialType::class)->states('Randomized'),
        'course_type_id'         => factory(App\Models\CourseType::class)->states('Randomized'),
        'course_level_id'        => factory(App\Models\CourseLevel::class)->states('Randomized'),
        'course_level_detail_id' => factory(App\Models\CourseLevelDetail::class)->states('Randomized'),
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
        'material_type_id'       => factory(App\Models\MaterialType::class)->states('Randomized'),
        'course_type_id'         => factory(App\Models\CourseType::class)->states('Randomized'),
        'course_level_id'        => factory(App\Models\CourseLevel::class)->states('Randomized'),
        'course_level_detail_id' => factory(App\Models\CourseLevelDetail::class)->states('Randomized'),
        'title'                  => 'Course Package '.$faker->randomLetter,
        'description'            => $faker->randomElement($array = $descriptions),
        'requirement'            => $faker->randomElement($array = $requirements),
        'count_session'          => $faker->numberBetween($min = 1, $max = 15),
        'price'                  => $faker->numberBetween($min = 20, $max = 30),
        'created_at'             => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'             => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

/////////////////////////////////////////////////EDIT DI BAGIAN INI///////////////////////////////////

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];

    $code = $faker->randomLetter;
    $description =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $descriptions) : null;

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
        'code'        => $code,
        'name'        => 'Course Level '.$code,
        'description' => $description,
        'created_at'  => $created_at,
        'updated_at'  => $updated_at,
        'deleted_at'  => $deleted_at
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

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'DeletedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePackage::class, 'DeletedAtNoUpdate', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});