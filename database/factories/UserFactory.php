<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

    return [
        'slug'  => Str::random(255),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'remember_token' => Str::random(10),
        'password' => bcrypt('password'), // Password (boleh menggunakan $faker->password, tetapi jangan menggunakan bcrypt()).
        'roles' => 'Admin',
        'citizenship' => null,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => 'Male',
        'birthdate' => null,
        'phone' => null,
        'image_profile' => null,
        'created_at' => now(),
        'updated_at' => null,
        'deleted_at' => null
    ];
});

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