<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\MaterialType;
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

$factory->define(App\Models\MaterialType::class, function (Faker\Generator $faker) {
    // Deklarasi array.
    $codes = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '+', '-', '*', '/', '!', '#', '_', '=', '?', ',', '.'];

    $code = $faker->randomElement($array = $codes);

    return [
        'slug'        => Str::random(255),
        'code'        => $code,
        'name'        => 'Material Type '.$code,
        'description' => null,
        'created_at'  => now(),
        'updated_at'  => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\MaterialType::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'Full', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];

    return [
        'description' => $faker->randomElement($array = $descriptions),
        'created_at'  => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'  => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];

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
        'description' => $description,
        'created_at'  => $created_at,
        'updated_at'  => $updated_at,
        'deleted_at'  => $deleted_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'DeletedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\MaterialType::class, 'DeletedAtNoUpdate', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});