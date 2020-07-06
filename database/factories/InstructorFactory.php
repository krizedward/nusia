<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Models\Instructor;
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
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    // referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    $param_full = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : null;
    $param_roles = function($faker) {
        if($faker->boolean($chanceOfGettingTrue = 30)) return 'RolesAdmin';
        else return ($faker->boolean($chanceOfGettingTrue = 40))? 'RolesInstructor' : 'RolesStudent';
    };
    $param_gender = ($faker->boolean($chanceOfGettingTrue = 50))? 'GenderMale' : 'GenderFemale';

    // Optional parameter(s).
    $param_email_verified_at = '';
    $param_citizenship = '';
    $param_birthdate = '';
    $param_phone = '';
    $param_image_profile = '';
    $param_created_at = '';
    if($param_full == null) {
        $param_email_verified_at = ($faker->boolean($chanceOfGettingTrue = 50))? 'EmailVerifiedAt' : null;
        $param_citizenship = ($faker->boolean($chanceOfGettingTrue = 50))? 'Citizenship' : null;
        $param_birthdate = ($faker->boolean($chanceOfGettingTrue = 50))? 'BirthDate' : null;
        $param_phone = ($faker->boolean($chanceOfGettingTrue = 50))? 'Phone' : null;
        $param_image_profile = ($faker->boolean($chanceOfGettingTrue = 50))? 'ImageProfile' : null;
        $param_created_at = ($faker->boolean($chanceOfGettingTrue = 50))? 'CreatedAt' : null;
    }

    /*$userable = [
        App\Models\Instructor::class,
        App\Models\Student::class
    ];
    $userable_type = $faker->randomElement($array = $userable);
    $userable = factory($userable_type)->create();*/

    return [
        'user_id'  => factory(App\User::class),
        'interest' => null,
        'working_experience' => null,
        'educational_experience' => null,
        'created_at' => now(),
        'updated_at' => null,
        'deleted_at' => null
    ];
});

/////////////////////////////////// EDIT SAMPAI DI BARIS INI ///////////////////////////////////

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'Full', function ($faker) {
    // referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    return [
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null),
        'citizenship' => $faker->country,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone' => $faker->e164PhoneNumber,

        // Image generation provided by LoremPixel (http://lorempixel.com/)
        'image_profile' => $faker->imageUrl($width = 200, $height = 200, 'people') // 'http://lorempixel.com/200/200/people/'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'EmailVerifiedAt', function ($faker) {
    return [
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null)
    ];
});

$factory->state(App\User::class, 'RolesAdmin', [
    'roles' => 'Admin'
]);

$factory->state(App\User::class, 'RolesInstructor', [
    'roles' => 'Instructor'
]);

$factory->state(App\User::class, 'RolesStudent', [
    'roles' => 'Student'
]);

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'Citizenship', function ($faker) {
    return [
        'citizenship' => $faker->country
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'GenderMale', function ($faker) {
    // referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    return [
        'first_name' => $faker->firstName($gender = 'male'),
        'last_name' => $faker->lastName,
        'gender' => 'Male'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'GenderFemale', function ($faker) {
    // referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    return [
        'first_name' => $faker->firstName($gender = 'female'),
        'last_name' => $faker->lastName,
        'gender' => 'Female'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'BirthDate', function ($faker) {
    return [
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'Phone', function ($faker) {
    return [
        'phone' => $faker->e164PhoneNumber
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'ImageProfile', function ($faker) {
    return [
        // Image generation provided by LoremPixel (http://lorempixel.com/)
        'image_profile' => $faker->imageUrl($width = 200, $height = 200, 'people') // 'http://lorempixel.com/200/200/people/'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)
    ];
});