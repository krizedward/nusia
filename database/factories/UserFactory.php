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
| 'Citizenship'       => Specify a value for citizenship.
| 'GenderMale'        => Specify a gender (DEFAULT).
| 'GenderFemale'      => Specify a gender.
| 'BirthDate'         => Specify a value for birthdate.
| 'Phone'             => Specify a value for phone.
| 'ImageProfile'      => Specify a value for image_profile.
| 'CreatedAt'         => Specify a value for created_at.
| 'UpdatedAt'         => Specify a value for created_at and updated_at.
| 'DeletedAt'         => Specify a value for created_at, updated_at, and deleted_at.
| 'DeletedAtNoUpdate' => Specify a value for created_at and deleted_at (excluding updated_at).
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    // $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    // Menambahkan jumlah kata dalam first_name.
    $add_first_name = ($faker->boolean($chanceOfGettingTrue = 70))? ' '.Faker\Factory::create('id_ID')->firstName($gender = 'male') : null;

    return [
        'slug'              => Str::random(255),
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'remember_token'    => Str::random(10),
        'password'          => bcrypt('password'), // Password (boleh menggunakan $faker->password, tetapi jangan menggunakan bcrypt()).
        'roles'             => 'Admin',
        'citizenship'       => null,
        'first_name'        => Faker\Factory::create('id_ID')->firstName($gender = 'male').$add_first_name,
        'last_name'         => Faker\Factory::create('id_ID')->lastName,
        'gender'            => 'Male',
        'birthdate'         => null,
        'phone'             => null,
        'image_profile'     => null,
        'created_at'        => now(),
        'updated_at'        => null,
        'deleted_at'        => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\User::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'Full', function ($faker) {
    return [
        'email_verified_at' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-5 years', $timezone = null),
        'citizenship'       => $faker->country,
        'birthdate'         => $faker->date($format = 'Y-m-d', $max = '-10 years'),
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
$factory->state(App\User::class, 'Citizenship', function ($faker) {
    return [
        'citizenship' => $faker->country
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'GenderMale', function ($faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    // $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    // Menambahkan jumlah kata dalam first_name.
    $add_first_name = ($faker->boolean($chanceOfGettingTrue = 70))? ' '.Faker\Factory::create('id_ID')->firstName($gender = 'male') : null;

    return [
        'first_name' => Faker\Factory::create('id_ID')->firstName($gender = 'male').$add_first_name,
        'last_name' => Faker\Factory::create('id_ID')->lastName,
        'gender' => 'Male'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'GenderFemale', function ($faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    // $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    // Menambahkan jumlah kata dalam first_name.
    $add_first_name = ($faker->boolean($chanceOfGettingTrue = 70))? ' '.Faker\Factory::create('id_ID')->firstName($gender = 'female') : null;

    return [
        'first_name' => Faker\Factory::create('id_ID')->firstName($gender = 'female').$add_first_name,
        'last_name' => Faker\Factory::create('id_ID')->lastName,
        'gender' => 'Female'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'BirthDate', function ($faker) {
    return [
        'birthdate' => $faker->date($format = 'Y-m-d', $max = '-10 years')
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

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'DeletedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-3 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\User::class, 'DeletedAtNoUpdate', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '-2 years', $timezone = null),
        'deleted_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});