<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\SessionRegistration;
use App\Models\Session;
use App\Models\CourseRegistration;
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

$factory->define(App\Models\SessionRegistration::class, function (Faker\Generator $faker) {
    $session_registrations = SessionRegistration::all();
    $course_registrations_count = CourseRegistration::all()->count();
    $course_registration_id = 0;
    while(1) {
        $course_registration_id =
            $faker->numberBetween($min = 1, $max = $course_registrations_count);

        $has_registered_before =
            $session_registrations->firstWhere('course_registration_id', $course_registration_id);
        if($has_registered_before == null) break;
    }

    $session_id = $faker->numberBetween($min = 1, $max = Session::all()->count());

    return [
        'session_id'             => $session_id,
        'course_registration_id' => $course_registration_id,
        'registration_time'      => null,
        'status'                 => 'Not Present',
        'created_at'             => now(),
        'updated_at'             => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\SessionRegistration::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\SessionRegistration::class, 'Full', function ($faker) {
    $status =
        ($faker->boolean($chanceOfGettingTrue = 70))? 'Present' : 'Not Present';

    return [
        'registration_time' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
        'status'            => $status,
        'created_at'        => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\SessionRegistration::class, 'Randomized', function ($faker) {
    $registration_time =
        ($faker->boolean($chanceOfGettingTrue = 90))?
            $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        : null;
    $status =
        ($faker->boolean($chanceOfGettingTrue = 70))? 'Present' : 'Not Present';

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
        'registration_time' => $registration_time,
        'status'            => $status,
        'created_at'        => $created_at,
        'updated_at'        => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\SessionRegistration::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\SessionRegistration::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});