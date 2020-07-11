<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CoursePayment;
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

$factory->define(App\Models\CoursePayment::class, function (Faker\Generator $faker) {
    $course_payments = CoursePayment::all();
    $course_registrations_count = CourseRegistration::all()->count();
    $course_registration_id = 0;
    while(1) {
        $course_registration_id =
            $faker->numberBetween($min = 1, $max = $course_registrations_count);

        $has_payment_information_before =
            $course_payments->firstWhere('course_registration_id', $course_registration_id);
        if($has_payment_information_before == null) break;
    }

    return [
        'course_registration_id' => $course_registration_id,
        'method'                 => $faker->creditCardType,
        'payment_time'           => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
        'amount'                 => null,
        'status'                 => 'Not Confirmed',
        'path'                   => null,
        'created_at'             => now(),
        'updated_at'             => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\CoursePayment::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePayment::class, 'Full', function ($faker) {
    $status =
        ($faker->boolean($chanceOfGettingTrue = 50))? 'Confirmed' : 'Not Confirmed';

    return [
        'amount'        => $faker->numberBetween($min = 1, $max = 30),
        'status'        => $status,
        'path'          => $faker->imageUrl($width = 200, $height = 200, 'people'), // 'http://lorempixel.com/200/200/people/'
        'created_at'    => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'    => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePayment::class, 'Randomized', function ($faker) {
    $amount =
        ($faker->boolean($chanceOfGettingTrue = 70))?
            $faker->numberBetween($min = 1, $max = 30) : null;
    $status =
        ($faker->boolean($chanceOfGettingTrue = 50))? 'Confirmed' : 'Not Confirmed';
    $path =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->imageUrl($width = 200, $height = 200, 'people') // 'http://lorempixel.com/200/200/people/'
        : null;

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
        'amount'        => $amount,
        'status'        => $status,
        'path'          => $path,
        'created_at'    => $created_at,
        'updated_at'    => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePayment::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\CoursePayment::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});