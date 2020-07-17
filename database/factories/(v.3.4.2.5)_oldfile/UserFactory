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
| List of state(s):
| 'NULL'              => Giving no additional parameters (return an empty array).
| 'Full'              => Specify all nullable parameter(s) to be NOT NULL.
| 'EmailVerifiedAt'   => Specify a value for email_verified_at.
| 'RolesAdmin'        => Specify a role (DEFAULT).
| 'RolesInstructor'   => Specify a role.
| 'RolesStudent'      => Specify a role.
| 'Phone'             => Specify a value for phone.
| 'ImageProfile'      => Specify a value for image_profile.
| 'CreatedAt'         => Specify a value for created_at.
| 'UpdatedAt'         => Specify a value for created_at and updated_at.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    // $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    $gender_value = ($faker->boolean($chanceOfGettingTrue = 50))? 'male' : 'female';

    // Menambahkan jumlah kata dalam first_name.
    $add_first_name = ($faker->boolean($chanceOfGettingTrue = 70))? ' '.Faker\Factory::create('id_ID')->firstName($gender = $gender_value) : null;

    return [
        'slug'              => Str::random(255),
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'remember_token'    => Str::random(10),
        'password'          => bcrypt('password'), // Password (boleh menggunakan $faker->password, tetapi jangan menggunakan bcrypt()).
        'roles'             => 'Admin',
        'citizenship'       => $faker->country,
        'first_name'        => Faker\Factory::create('id_ID')->firstName($gender = $gender_value).$add_first_name,
        'last_name'         => Faker\Factory::create('id_ID')->lastName,
        'phone'             => null,
        'image_profile'     => null,
        'created_at'        => now(),
        'updated_at'        => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\User::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'Full', function ($faker) {
    return [
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-5 years', $timezone = null),
        'phone'             => $faker->e164PhoneNumber,

        // Image generation provided by LoremPixel (http://lorempixel.com/)
        'image_profile'     => $faker->imageUrl($width = 200, $height = 200, 'people'), // 'http://lorempixel.com/200/200/people/'

        'created_at'        => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'EmailVerifiedAt', function ($faker) {
    return [
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-5 years', $timezone = null)
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
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});