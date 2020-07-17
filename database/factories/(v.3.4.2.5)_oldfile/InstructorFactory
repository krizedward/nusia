<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Instructor;
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
| 'NULL'                  => Giving no additional parameters (return an empty array).
| 'Full'                  => Specify all nullable parameter(s) to be NOT NULL.
| 'Randomized'            => Specify random combination for all parameter(s).
| 'Interest'              => Specify a value for interest.
| 'WorkingExperience'     => Specify a value for working_experience.
| 'EducationalExperience' => Specify a value for educational_experience.
| 'CreatedAt'             => Specify a value for created_at.
| 'UpdatedAt'             => Specify a value for created_at and updated_at.
|
*/

$factory->define(App\Models\Instructor::class, function (Faker\Generator $faker) {
    $param_full   = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : 'NULL';
    $param_roles  = 'RolesInstructor';
    $param_gender = ($faker->boolean($chanceOfGettingTrue = 50))? 'GenderMale' : 'GenderFemale';

    // Optional parameter(s).
    $param_email_verified_at = 'NULL';
    $param_citizenship       = 'NULL';
    $param_birthdate         = 'NULL';
    $param_phone             = 'NULL';
    $param_image_profile     = 'NULL';
    $param_created_at        = 'NULL';
    $param_updated_at        = 'NULL';
    if($param_full == 'NULL') {
        $param_email_verified_at = ($faker->boolean($chanceOfGettingTrue = 50))? 'EmailVerifiedAt' : 'NULL';
        $param_citizenship       = ($faker->boolean($chanceOfGettingTrue = 50))? 'Citizenship' : 'NULL';
        $param_birthdate         = ($faker->boolean($chanceOfGettingTrue = 50))? 'BirthDate' : 'NULL';
        $param_phone             = ($faker->boolean($chanceOfGettingTrue = 50))? 'Phone' : 'NULL';
        $param_image_profile     = ($faker->boolean($chanceOfGettingTrue = 50))? 'ImageProfile' : 'NULL';
        $param_created_at        = ($faker->boolean($chanceOfGettingTrue = 50))? 'CreatedAt' : 'NULL';
        $param_updated_at        = ($faker->boolean($chanceOfGettingTrue = 40))? 'UpdatedAt' : 'NULL';
    }

    return [
        'user_id' => factory(App\User::class)
            ->states(
                $param_full,
                $param_roles,
                $param_gender,
                $param_email_verified_at,
                $param_citizenship,
                $param_birthdate,
                $param_phone,
                $param_image_profile,
                $param_created_at,
                $param_updated_at
            ),
        'interest'               => null,
        'working_experience'     => null,
        'educational_experience' => null,
        'created_at'             => now(),
        'updated_at'             => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\Instructor::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'Full', function ($faker) {
    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];
    $working_experiences = ['2009: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014-2016: Instructor, Student Exchange Program from Guangxi Normal University, Universitas Negeri Malang', '2014-2016: Instructor, Dharmasiswa Program, Universitas Negeri Malang', '2014-2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2015: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Language partner, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2016: Instructor, Indonesian Overseas Program (IOP), Universitas Negeri Malang', '2016-2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2017: Instructor, Teaching Practicum, Walailak University, Thailand', '2017: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Potharam Technical College (PTC), Thailand', '2017-2018: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2018: Language partner, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Language Assistant Program, the Department of Education WA, Australia', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Ateneo de Davao University (AdDU), University of Southeastern Philippines (USeP), Mindanao Kokusai Daigaku (Mindanao International College), University of Mindanao (UM), Philippine National Police (PNP), Naval Forces Eastern Mindanao (NFEM), and Consulate General of the Republic of Indonesia, Davao City, Philippines', '2018-2019: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2018-2019: Instructor, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2019: Administration Staff, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Private Tutoring Program, Universitas Negeri Malang', '2019: Instructor, Student Exchange Program from Saga University in Japan, Universitas Negeri Malang', '2019: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in KBRI Hanoi, Vietnam University (University of Social Science and Humanities), and Hanoi University (HANU)'];
    $educational_experiences = ['2008: Cambridge University', '2009: Cambridge University', '2010: Cambridge University', '2011: Cambridge University', '2012: Cambridge University', '2013: Cambridge University', '2014: Cambridge University', '2015: Cambridge University', '2016: Cambridge University', '2017: Cambridge University', '2018: Cambridge University', '2019: Cambridge University', '2020: Cambridge University', '2008: Oxford University', '2009: Oxford University', '2010: Oxford University', '2011: Oxford University', '2012: Oxford University', '2013: Oxford University', '2014: Oxford University', '2015: Oxford University', '2016: Oxford University', '2017: Oxford University', '2018: Oxford University', '2019: Oxford University', '2020: Oxford University'];

    return [
        'interest' => implode(", ", $faker->randomElements(
             $array = $interests,
             $count = $faker->numberBetween($min = 1, $max = 5)
        )),
        'working_experience' => implode(", ", $faker->randomElements(
             $array = $working_experiences,
             $count = $faker->numberBetween($min = 1, $max = 5)
        )),
        'educational_experience' => implode(", ", $faker->randomElements(
             $array = $educational_experiences,
             $count = $faker->numberBetween($min = 1, $max = 2)
        )),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'Randomized', function ($faker) {
    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];
    $working_experiences = ['2009: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014-2016: Instructor, Student Exchange Program from Guangxi Normal University, Universitas Negeri Malang', '2014-2016: Instructor, Dharmasiswa Program, Universitas Negeri Malang', '2014-2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2015: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Language partner, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2016: Instructor, Indonesian Overseas Program (IOP), Universitas Negeri Malang', '2016-2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2017: Instructor, Teaching Practicum, Walailak University, Thailand', '2017: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Potharam Technical College (PTC), Thailand', '2017-2018: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2018: Language partner, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Language Assistant Program, the Department of Education WA, Australia', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Ateneo de Davao University (AdDU), University of Southeastern Philippines (USeP), Mindanao Kokusai Daigaku (Mindanao International College), University of Mindanao (UM), Philippine National Police (PNP), Naval Forces Eastern Mindanao (NFEM), and Consulate General of the Republic of Indonesia, Davao City, Philippines', '2018-2019: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2018-2019: Instructor, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2019: Administration Staff, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Private Tutoring Program, Universitas Negeri Malang', '2019: Instructor, Student Exchange Program from Saga University in Japan, Universitas Negeri Malang', '2019: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in KBRI Hanoi, Vietnam University (University of Social Science and Humanities), and Hanoi University (HANU)'];
    $educational_experiences = ['2008: Cambridge University', '2009: Cambridge University', '2010: Cambridge University', '2011: Cambridge University', '2012: Cambridge University', '2013: Cambridge University', '2014: Cambridge University', '2015: Cambridge University', '2016: Cambridge University', '2017: Cambridge University', '2018: Cambridge University', '2019: Cambridge University', '2020: Cambridge University', '2008: Oxford University', '2009: Oxford University', '2010: Oxford University', '2011: Oxford University', '2012: Oxford University', '2013: Oxford University', '2014: Oxford University', '2015: Oxford University', '2016: Oxford University', '2017: Oxford University', '2018: Oxford University', '2019: Oxford University', '2020: Oxford University'];

    $interest =
        ($faker->boolean($chanceOfGettingTrue = 90))? (
            implode(", ", $faker->randomElements(
                $array = $interests,
                $count = $faker->numberBetween($min = 1, $max = 5)
            ))
        ) : null;
    $working_experience =
        ($faker->boolean($chanceOfGettingTrue = 90))? (
            implode(", ", $faker->randomElements(
                $array = $working_experiences,
                $count = $faker->numberBetween($min = 1, $max = 5)
            ))
        ) : null;
    $educational_experience =
        ($faker->boolean($chanceOfGettingTrue = 90))? (
            implode(", ", $faker->randomElements(
                $array = $educational_experiences,
                $count = $faker->numberBetween($min = 1, $max = 2)
            ))
        ) : null;

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
        'interest' => $interest,
        'working_experience' => $working_experience,
        'educational_experience' => $educational_experience,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'Interest', function ($faker) {
    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];

    return [
        'interest' => implode(", ", $faker->randomElements(
             $array = $interests,
             $count = $faker->numberBetween($min = 1, $max = 5)
        ))
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'WorkingExperience', function ($faker) {
    // Deklarasi array.
    $working_experiences = ['2009: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2014-2016: Instructor, Student Exchange Program from Guangxi Normal University, Universitas Negeri Malang', '2014-2016: Instructor, Dharmasiswa Program, Universitas Negeri Malang', '2014-2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2015: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Language partner, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2016: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2016: Instructor, Indonesian Overseas Program (IOP), Universitas Negeri Malang', '2016-2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2017: Instructor, Teaching Practicum, Walailak University, Thailand', '2017: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Potharam Technical College (PTC), Thailand', '2017-2018: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2018: Language partner, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang', '2018: Instructor, Language Assistant Program, the Department of Education WA, Australia', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Udonthani Vocational College, Thailand', '2018: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in Ateneo de Davao University (AdDU), University of Southeastern Philippines (USeP), Mindanao Kokusai Daigaku (Mindanao International College), University of Mindanao (UM), Philippine National Police (PNP), Naval Forces Eastern Mindanao (NFEM), and Consulate General of the Republic of Indonesia, Davao City, Philippines', '2018-2019: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang', '2018-2019: Instructor, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang', '2019: Administration Staff, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang', '2019: Instructor, Private Tutoring Program, Universitas Negeri Malang', '2019: Instructor, Student Exchange Program from Saga University in Japan, Universitas Negeri Malang', '2019: Instructor, Teaching of BIPA abroad assigned by the Ministry of Education and Culture in KBRI Hanoi, Vietnam University (University of Social Science and Humanities), and Hanoi University (HANU)'];

    return [
        'working_experience' => implode(", ", $faker->randomElements(
             $array = $working_experiences,
             $count = $faker->numberBetween($min = 1, $max = 5)
        ))
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'EducationalExperience', function ($faker) {
    // Deklarasi array.
    $educational_experiences = ['2008: Cambridge University', '2009: Cambridge University', '2010: Cambridge University', '2011: Cambridge University', '2012: Cambridge University', '2013: Cambridge University', '2014: Cambridge University', '2015: Cambridge University', '2016: Cambridge University', '2017: Cambridge University', '2018: Cambridge University', '2019: Cambridge University', '2020: Cambridge University', '2008: Oxford University', '2009: Oxford University', '2010: Oxford University', '2011: Oxford University', '2012: Oxford University', '2013: Oxford University', '2014: Oxford University', '2015: Oxford University', '2016: Oxford University', '2017: Oxford University', '2018: Oxford University', '2019: Oxford University', '2020: Oxford University'];

    return [
        'educational_experience' => implode(", ", $faker->randomElements(
             $array = $educational_experiences,
             $count = $faker->numberBetween($min = 1, $max = 2)
        ))
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Instructor::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});