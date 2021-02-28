<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Session;
use App\Models\Course;
use App\Models\Schedule;
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

$factory->define(App\Models\Session::class, function (Faker\Generator $faker) {
    $sessions = Session::all();

    $courses = Course::all();
    $course_id = 0;

    // Possible infinite loop where all schedules have been assigned.
    while(1) {
        $course_id = $faker->numberBetween($min = 1, $max = $courses->count());

        $session = $sessions->firstWhere('course_id', $course_id);
        if($session == null) break;
    }

    $schedules = Schedule::all()->where('status', 'Busy');
    $schedule_id = 0;

    // Possible infinite loop where all schedules are 'Busy'.
    while(1) {
        $schedule_id = $faker->numberBetween($min = 1, $max = $schedules->count());

        $session = $sessions->firstWhere('schedule_id', $schedule_id);
        if($session == null) break;
    }

    return [
        'slug'        => Str::random(255),
        'course_id'   => $course_id,
        'schedule_id' => $schedule_id,
        'title'       => null,
        'description' => null,
        'requirement' => null,
        'link_zoom'   => null,
        'created_at'  => now(),
        'updated_at'  => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\Session::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Session::class, 'Full', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

    return [
        'title'       => 'Session '.$faker->randomLetter,
        'description' => $faker->randomElement($array = $descriptions),
        'requirement' => $faker->randomElement($array = $requirements),
        'link_zoom'   => $faker->imageUrl($width = 200, $height = 200, 'people'), // 'http://lorempixel.com/200/200/people/'
        'created_at'  => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'  => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Session::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $descriptions = ['This is a description.', 'Hi. This describes something.', 'Description...', 'Description here.'];
    $requirements = ['This is a requirement.', 'Hi. This requires something.', 'Requirement...', 'Requirement here.'];

    $title =
        ($faker->boolean($chanceOfGettingTrue = 70))?
            'Session '.$faker->randomLetter : null;
    $description =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $descriptions) : null;
    $requirement =
        ($faker->boolean($chanceOfGettingTrue = 50))?
            $faker->randomElement($array = $requirements) : null;
    $link_zoom =
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
        'title'       => $title,
        'description' => $description,
        'requirement' => $requirement,
        'link_zoom'   => $link_zoom,
        'created_at'  => $created_at,
        'updated_at'  => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Session::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Session::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});