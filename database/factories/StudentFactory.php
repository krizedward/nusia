<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Student;
use App\User;
use Illuminate\Support\Str;
//use Faker\Generator as Faker;
use Faker\Generator;
use Faker\Factory;

use Carbon\Carbon;

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
| 'NULL'                              => Giving no additional parameters (return an empty array).
| 'Full'                              => Specify all nullable parameter(s) to be NOT NULL.
| 'Randomized'                        => Specify random combination for all parameter(s).
| 'Age'                               => Specify a value for age.
| 'StatusJobStudent'                  => Specify status_job as "Student".
| 'StatusJobStudentNoDetail'          => Specify status_job as "Student", without status_description.
| 'StatusJobStudentNoPlace'           => Specify status_job as "Student", without status_value.
| 'StatusJobStudentNoInfo'            => Specify status_job as "Student", without status_description and status_value.
| 'StatusJobProfessional'             => Specify status_job as "Professional".
| 'StatusJobProfessionalNoDetail'     => Specify status_job as "Professional", without status_description.
| 'StatusJobProfessionalNoPlace'      => Specify status_job as "Professional", without status_value.
| 'StatusJobProfessionalNoInfo'       => Specify status_job as "Professional", without status_description and status_value.
| 'Interest'                          => Specify a value for interest.
| 'TargetLanguageExperienceOpt1'      => Specify a value for target_language_experience.
| 'TargetLanguageExperienceOpt2'      => Specify a value for target_language_experience.
| 'TargetLanguageExperienceOpt3'      => Specify a value for target_language_experience.
| 'TargetLanguageExperienceOpt4'      => Specify a value for target_language_experience and target_language_experience_value.
| 'DescriptionOfCourseTaken'          => Specify a value for description_of_course_taken.
| 'IndonesianLanguageProficiencyOpt1' => Specify a value for indonesian_language_proficiency.
| 'IndonesianLanguageProficiencyOpt2' => Specify a value for indonesian_language_proficiency.
| 'IndonesianLanguageProficiencyOpt3' => Specify a value for indonesian_language_proficiency.
| 'LearningObjective'                 => Specify a value for learning_objective.
| 'CreatedAt'                         => Specify a value for created_at.
| 'UpdatedAt'                         => Specify a value for created_at and updated_at.
|
*/

$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
    $param_full   = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : 'NULL';
    $param_roles  = 'RolesStudent';
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
        'user_id'  => factory(App\User::class)
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
        'age'                              => null,
        'status_job'                       => 'Student',
        'status_description'               => null,
        'status_value'                     => null,
        'interest'                         => null,
        'target_language_experience'       => 'Never (no experience)',
        'target_language_experience_value' => null,
        'description_of_course_taken'      => null,
        'indonesian_language_proficiency'  => 'Novice',
        'learning_objective'               => null,
        'created_at'                       => now(),
        'updated_at'                       => null
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
// STATE INI DIGUNAKAN UNTUK MENGGANTIKAN NILAI null PADA STATE PARAMETER.
$factory->state(App\Models\Student::class, 'NULL', function ($faker) { return []; });

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'Full', function ($faker) {
    $param_full   = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : 'NULL';
    $param_roles  = 'RolesStudent';
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

    $user = factory(App\User::class)
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
        )->create();

    // Deklarasi array (sebagai nilai status_value).
    // Data diperoleh dari situs berikut (diakses pada tanggal 7 Juli 2020).
    // 1. http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/
    // 2. https://web.snmptn.ac.id/ptn
    // 3. https://www.lldikti4.or.id/wp-content/uploads/2019/11/Daftar-Perguruan-Tinggi-undangan.pdf
    $status_values = ['SMP MODERN AL- ALAWIYAH', 'SMPN 3 SEPATAN', 'SMPN 4 ABAB', 'SMPS IT MIFTAHURROHMAH', 'SMP - GLOBAL', 'SMP IT AL-FALAH BANYURESMI', 'SMPN 23 AKO', 'SMPS KOPISAN', 'SMP BINA DAKWAH ISLAM TERPADU YAPISA', 'SMP ISLAM TERPADU AL USWAH', 'SMPN 5 CIRINTEN', 'SMPS ANANDA', 'SMP ISLAM AS-SALAM', 'SMP IT ARMANIYAH', 'SMPN MUGI HITUGI', 'SMPS PUTERI ATTANWIR', 'SMP IT PESANTREN AL-ZAUHAR', 'SMP NEGERI 26 KOTA TANGERANG', 'SMP PLUS NURUL IKHLASH IBTIDAI', 'SMPN SATAP SERADALA', 'SMP KIMIA TIRTA UTAMA', 'SMP KRISTEN KANAAN', 'SMP Negeri 4 Simpang Empat', 'SMPS ISLAM AL BAROKAH', 'SMP EVERGREEN', 'SMP IT BANI ROSYIDIN', 'SMP NEGERI 5 FATULEU BARAT SATU ATAP', 'UPT SMP SATU ATAP KALIGAMBIR', 'SMA NEGERI 1 WULANDONI', 'SMA NU HASYIM ASY ARI', 'SMAN 1 PLOSOKLATEN', 'SMAS GALUH HANDAYANI', 'SMA EDUCATION', 'SMAN 1 SIAU BARAT', 'SMAS PASUNDAN 1 CIANJUR', 'SMAS THERESIANA WELERI', 'SMAN 1 SIEMPAT NEMPU', 'SMAN 1 TOULUAAN', 'SMAN 16 Mukomuko', 'SMAS TAMAN SISWA BEKASI', 'SMAN 1 BUKIK BARISAN', 'SMAN 1 KUPANG', 'SMAN 1 PARENGAN', 'SMAN 10 HALMAHERA UTARA', 'SMA Negeri 1 Napan', 'SMA SWASTA KATOLIK FRATERAN PODOR', 'SMAS ISLAM SHOHIBURRAHMAN BELEKA', 'SMAS MUHAMMADIYAH (PLUS) SALATIGA', 'SMA SANTO MICHAEL', 'SMAN 10 MERANGIN', 'SMAN 4 KOTA KOMBA', 'SMAS DARMA PERTIWI', 'SMA NEGERI 1 MUARA BADAK', 'SMAS ELPIDA', 'SMAS MUHAMMADIYAH', 'SMAS MUHAMMADIYAH T PINANG', 'ISBI ACEH', 'UNIVERSITAS ISLAM NEGERI AR-RANIRY', 'UNIVERSITAS MALIKUSSALEH', 'UNIVERSITAS SAMUDRA', 'UNIVERSITAS SYIAH KUALA', 'UNIVERSITAS TEUKU UMAR', 'UNIVERSITAS ISLAM NEGERI SUMATERA UTARA', 'UNIVERSITAS NEGERI MEDAN', 'UNIVERSITAS SUMATERA UTARA', 'ISI PADANG PANJANG', 'UNIVERSITAS ANDALAS', 'UNIVERSITAS NEGERI PADANG', 'UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM', 'UNIVERSITAS RIAU', 'UNIVERSITAS MARITIM RAJA ALI HAJI', 'UNIVERSITAS JAMBI', 'UNIVERSITAS BENGKULU', 'UNIVERSITAS ISLAM NEGERI RADEN FATAH', 'UNIVERSITAS SRIWIJAYA', 'UNIVERSITAS BANGKA BELITUNG', 'INSTITUT TEKNOLOGI SUMATERA', 'UNIVERSITAS LAMPUNG', 'UNIVERSITAS INDONESIA', 'UNIVERSITAS ISLAM NEGERI JAKARTA', 'UNIVERSITAS NEGERI JAKARTA', 'UNIVERSITAS TERBUKA', 'Universitas Telkom', 'Universitas Katolik Parahyangan', 'Universitas Presiden', 'Universitas Islam Nusantara', 'Universitas Jenderal Achmad Yani', 'Universitas Pakuan', 'Universitas Komputer Indonesia', 'Universitas Pamulang', 'Universitas Swadaya Gunung Djati', 'Universitas Muhammadiyah Sukabumi', 'Universitas Pembangunan Jaya Tangerang', 'Universitas Galuh', 'Universitas Ibn Khaldun', 'Universitas Suryakancana', 'Universitas Muhammadiyah Tasikmalaya'];

    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];

    $status_value = $faker->randomElement($array = $status_values);

    return [
        'user_id'            => $user,
        'age'                => ($user->birthdate == 0)? ($faker->numberBetween($min = 10, $max = 80)) : (Carbon::parse($user->birthdate)->age),
        'status_job'         => 'Student',
        'status_description' => ($faker->boolean($chanceOfGettingTrue = 50))? 'Hi. I am currently studying at '.$status_value : 'Currently studying.',
        'status_value'       => $status_value,
        'interest'           => implode(", ", $faker->randomElements(
             $array = $interests,
             $count = $faker->numberBetween($min = 1, $max = 5)
        )),
        'target_language_experience'       => 'Others',
        'target_language_experience_value' => $faker->numberBetween($min = 2, $max = 10), // Menggunakan satuan "tahun".
        'description_of_course_taken'      => 'This is a description of course taken.',
        'indonesian_language_proficiency'  => 'Novice',
        'learning_objective' => 'This is a text for learning_objective.',
        'created_at'         => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at'         => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'Randomized', function ($faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    // $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    $param_full   = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : 'NULL';
    $param_roles  = 'RolesStudent';
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

    $user = factory(App\User::class)
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
        )->create();

    // Deklarasi array (sebagai nilai status_value).
    // Data diperoleh dari situs berikut (diakses pada tanggal 7 Juli 2020).
    // 1. http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/
    // 2. https://web.snmptn.ac.id/ptn
    // 3. https://www.lldikti4.or.id/wp-content/uploads/2019/11/Daftar-Perguruan-Tinggi-undangan.pdf
    $status_values = ['SMP MODERN AL- ALAWIYAH', 'SMPN 3 SEPATAN', 'SMPN 4 ABAB', 'SMPS IT MIFTAHURROHMAH', 'SMP - GLOBAL', 'SMP IT AL-FALAH BANYURESMI', 'SMPN 23 AKO', 'SMPS KOPISAN', 'SMP BINA DAKWAH ISLAM TERPADU YAPISA', 'SMP ISLAM TERPADU AL USWAH', 'SMPN 5 CIRINTEN', 'SMPS ANANDA', 'SMP ISLAM AS-SALAM', 'SMP IT ARMANIYAH', 'SMPN MUGI HITUGI', 'SMPS PUTERI ATTANWIR', 'SMP IT PESANTREN AL-ZAUHAR', 'SMP NEGERI 26 KOTA TANGERANG', 'SMP PLUS NURUL IKHLASH IBTIDAI', 'SMPN SATAP SERADALA', 'SMP KIMIA TIRTA UTAMA', 'SMP KRISTEN KANAAN', 'SMP Negeri 4 Simpang Empat', 'SMPS ISLAM AL BAROKAH', 'SMP EVERGREEN', 'SMP IT BANI ROSYIDIN', 'SMP NEGERI 5 FATULEU BARAT SATU ATAP', 'UPT SMP SATU ATAP KALIGAMBIR', 'SMA NEGERI 1 WULANDONI', 'SMA NU HASYIM ASY ARI', 'SMAN 1 PLOSOKLATEN', 'SMAS GALUH HANDAYANI', 'SMA EDUCATION', 'SMAN 1 SIAU BARAT', 'SMAS PASUNDAN 1 CIANJUR', 'SMAS THERESIANA WELERI', 'SMAN 1 SIEMPAT NEMPU', 'SMAN 1 TOULUAAN', 'SMAN 16 Mukomuko', 'SMAS TAMAN SISWA BEKASI', 'SMAN 1 BUKIK BARISAN', 'SMAN 1 KUPANG', 'SMAN 1 PARENGAN', 'SMAN 10 HALMAHERA UTARA', 'SMA Negeri 1 Napan', 'SMA SWASTA KATOLIK FRATERAN PODOR', 'SMAS ISLAM SHOHIBURRAHMAN BELEKA', 'SMAS MUHAMMADIYAH (PLUS) SALATIGA', 'SMA SANTO MICHAEL', 'SMAN 10 MERANGIN', 'SMAN 4 KOTA KOMBA', 'SMAS DARMA PERTIWI', 'SMA NEGERI 1 MUARA BADAK', 'SMAS ELPIDA', 'SMAS MUHAMMADIYAH', 'SMAS MUHAMMADIYAH T PINANG', 'ISBI ACEH', 'UNIVERSITAS ISLAM NEGERI AR-RANIRY', 'UNIVERSITAS MALIKUSSALEH', 'UNIVERSITAS SAMUDRA', 'UNIVERSITAS SYIAH KUALA', 'UNIVERSITAS TEUKU UMAR', 'UNIVERSITAS ISLAM NEGERI SUMATERA UTARA', 'UNIVERSITAS NEGERI MEDAN', 'UNIVERSITAS SUMATERA UTARA', 'ISI PADANG PANJANG', 'UNIVERSITAS ANDALAS', 'UNIVERSITAS NEGERI PADANG', 'UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM', 'UNIVERSITAS RIAU', 'UNIVERSITAS MARITIM RAJA ALI HAJI', 'UNIVERSITAS JAMBI', 'UNIVERSITAS BENGKULU', 'UNIVERSITAS ISLAM NEGERI RADEN FATAH', 'UNIVERSITAS SRIWIJAYA', 'UNIVERSITAS BANGKA BELITUNG', 'INSTITUT TEKNOLOGI SUMATERA', 'UNIVERSITAS LAMPUNG', 'UNIVERSITAS INDONESIA', 'UNIVERSITAS ISLAM NEGERI JAKARTA', 'UNIVERSITAS NEGERI JAKARTA', 'UNIVERSITAS TERBUKA', 'Universitas Telkom', 'Universitas Katolik Parahyangan', 'Universitas Presiden', 'Universitas Islam Nusantara', 'Universitas Jenderal Achmad Yani', 'Universitas Pakuan', 'Universitas Komputer Indonesia', 'Universitas Pamulang', 'Universitas Swadaya Gunung Djati', 'Universitas Muhammadiyah Sukabumi', 'Universitas Pembangunan Jaya Tangerang', 'Universitas Galuh', 'Universitas Ibn Khaldun', 'Universitas Suryakancana', 'Universitas Muhammadiyah Tasikmalaya'];

    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];

    $age =
        ($faker->boolean($chanceOfGettingTrue = 50))? (
            ($user->birthdate == 0)?
                ($faker->numberBetween($min = 10, $max = 80))
                : (Carbon::parse($user->birthdate)->age)
        ) : null;
    $status_job =
        ($faker->boolean($chanceOfGettingTrue = 50))? 'Student' : 'Professional';
    $status_value =
        ($status_job == 'Student')? (
            ($faker->boolean($chanceOfGettingTrue = 50))? $faker->randomElement($array = $status_values) : null
        ) : (
                ($status_job == 'Professional')? (
                    ($faker->boolean($chanceOfGettingTrue = 50))? Faker\Factory::create('id_ID')->company : null
                ) : null
        );
    $status_description =
        ($status_job == 'Student')? (
            ($status_value != null)? (
                ($faker->boolean($chanceOfGettingTrue = 50))? 'Hi. I am currently studying at '.$status_value : 'Currently studying.'
            ) : 'Currently studying.'
        ) : (
                ($status_job == 'Professional')? (
                    ($faker->boolean($chanceOfGettingTrue = 50))? 'Hi. I am currently working at '.$status_value : 'Currently working.'
                ) : null
        );
    $interest =
        ($faker->boolean($chanceOfGettingTrue = 70))? (
            implode(", ", $faker->randomElements(
                $array = $interests,
                $count = $faker->numberBetween($min = 1, $max = 5)
            ))
        ) : null;
    $target_language_experience =
        ($faker->boolean($chanceOfGettingTrue = 50))? (
            ($faker->boolean($chanceOfGettingTrue = 50))? (
                ($faker->boolean($chanceOfGettingTrue = 50))? 'Never (no experience)' : '< 6 months'
            ) : '<= 1 year'
        ) : 'Others';
    $target_language_experience_value =
        ($target_language_experience == 'Others')? (
            $faker->numberBetween($min = 2, $max = 10) // Menggunakan satuan "tahun".
        ) : null;
    $description_of_course_taken =
        ($faker->boolean($chanceOfGettingTrue = 50))? (
            'This is a text for description_of_course_taken.'
        ) : null;
    $indonesian_language_proficiency =
        ($faker->boolean($chanceOfGettingTrue = 50))? (
            ($faker->boolean($chanceOfGettingTrue = 70))? 'Novice' : 'Intermediate'
        ) : 'Advanced';
    $learning_objective =
        ($faker->boolean($chanceOfGettingTrue = 50))? (
            'This is a text for learning_objective.'
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
        'user_id'            => $user,
        'age'                => $age,
        'status_job'         => $status_job,
        'status_description' => $status_description,
        'status_value'       => $status_value,
        'interest'           => $interest,
        'target_language_experience'       => $target_language_experience,
        'target_language_experience_value' => $target_language_experience_value, // Menggunakan satuan "tahun".
        'description_of_course_taken'      => $description_of_course_taken,
        'indonesian_language_proficiency'  => $indonesian_language_proficiency,
        'learning_objective' => $learning_objective,
        'created_at'         => $created_at,
        'updated_at'         => $updated_at
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'Age', function ($faker) {
    $param_full   = ($faker->boolean($chanceOfGettingTrue = 50))? 'Full' : 'NULL';
    $param_roles  = 'RolesStudent';
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

    $user = factory(App\User::class)
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
        )->create();

    return [
        'user_id' => $user,
        'age'     => ($user->birthdate == 0)? ($faker->numberBetween($min = 10, $max = 80)) : (Carbon::parse($user->birthdate)->age)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobStudent', function ($faker) {
    // Deklarasi array (sebagai nilai status_value).
    // Data diperoleh dari situs berikut (diakses pada tanggal 7 Juli 2020).
    // 1. http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/
    // 2. https://web.snmptn.ac.id/ptn
    // 3. https://www.lldikti4.or.id/wp-content/uploads/2019/11/Daftar-Perguruan-Tinggi-undangan.pdf
    $status_values = ['SMP MODERN AL- ALAWIYAH', 'SMPN 3 SEPATAN', 'SMPN 4 ABAB', 'SMPS IT MIFTAHURROHMAH', 'SMP - GLOBAL', 'SMP IT AL-FALAH BANYURESMI', 'SMPN 23 AKO', 'SMPS KOPISAN', 'SMP BINA DAKWAH ISLAM TERPADU YAPISA', 'SMP ISLAM TERPADU AL USWAH', 'SMPN 5 CIRINTEN', 'SMPS ANANDA', 'SMP ISLAM AS-SALAM', 'SMP IT ARMANIYAH', 'SMPN MUGI HITUGI', 'SMPS PUTERI ATTANWIR', 'SMP IT PESANTREN AL-ZAUHAR', 'SMP NEGERI 26 KOTA TANGERANG', 'SMP PLUS NURUL IKHLASH IBTIDAI', 'SMPN SATAP SERADALA', 'SMP KIMIA TIRTA UTAMA', 'SMP KRISTEN KANAAN', 'SMP Negeri 4 Simpang Empat', 'SMPS ISLAM AL BAROKAH', 'SMP EVERGREEN', 'SMP IT BANI ROSYIDIN', 'SMP NEGERI 5 FATULEU BARAT SATU ATAP', 'UPT SMP SATU ATAP KALIGAMBIR', 'SMA NEGERI 1 WULANDONI', 'SMA NU HASYIM ASY ARI', 'SMAN 1 PLOSOKLATEN', 'SMAS GALUH HANDAYANI', 'SMA EDUCATION', 'SMAN 1 SIAU BARAT', 'SMAS PASUNDAN 1 CIANJUR', 'SMAS THERESIANA WELERI', 'SMAN 1 SIEMPAT NEMPU', 'SMAN 1 TOULUAAN', 'SMAN 16 Mukomuko', 'SMAS TAMAN SISWA BEKASI', 'SMAN 1 BUKIK BARISAN', 'SMAN 1 KUPANG', 'SMAN 1 PARENGAN', 'SMAN 10 HALMAHERA UTARA', 'SMA Negeri 1 Napan', 'SMA SWASTA KATOLIK FRATERAN PODOR', 'SMAS ISLAM SHOHIBURRAHMAN BELEKA', 'SMAS MUHAMMADIYAH (PLUS) SALATIGA', 'SMA SANTO MICHAEL', 'SMAN 10 MERANGIN', 'SMAN 4 KOTA KOMBA', 'SMAS DARMA PERTIWI', 'SMA NEGERI 1 MUARA BADAK', 'SMAS ELPIDA', 'SMAS MUHAMMADIYAH', 'SMAS MUHAMMADIYAH T PINANG', 'ISBI ACEH', 'UNIVERSITAS ISLAM NEGERI AR-RANIRY', 'UNIVERSITAS MALIKUSSALEH', 'UNIVERSITAS SAMUDRA', 'UNIVERSITAS SYIAH KUALA', 'UNIVERSITAS TEUKU UMAR', 'UNIVERSITAS ISLAM NEGERI SUMATERA UTARA', 'UNIVERSITAS NEGERI MEDAN', 'UNIVERSITAS SUMATERA UTARA', 'ISI PADANG PANJANG', 'UNIVERSITAS ANDALAS', 'UNIVERSITAS NEGERI PADANG', 'UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM', 'UNIVERSITAS RIAU', 'UNIVERSITAS MARITIM RAJA ALI HAJI', 'UNIVERSITAS JAMBI', 'UNIVERSITAS BENGKULU', 'UNIVERSITAS ISLAM NEGERI RADEN FATAH', 'UNIVERSITAS SRIWIJAYA', 'UNIVERSITAS BANGKA BELITUNG', 'INSTITUT TEKNOLOGI SUMATERA', 'UNIVERSITAS LAMPUNG', 'UNIVERSITAS INDONESIA', 'UNIVERSITAS ISLAM NEGERI JAKARTA', 'UNIVERSITAS NEGERI JAKARTA', 'UNIVERSITAS TERBUKA', 'Universitas Telkom', 'Universitas Katolik Parahyangan', 'Universitas Presiden', 'Universitas Islam Nusantara', 'Universitas Jenderal Achmad Yani', 'Universitas Pakuan', 'Universitas Komputer Indonesia', 'Universitas Pamulang', 'Universitas Swadaya Gunung Djati', 'Universitas Muhammadiyah Sukabumi', 'Universitas Pembangunan Jaya Tangerang', 'Universitas Galuh', 'Universitas Ibn Khaldun', 'Universitas Suryakancana', 'Universitas Muhammadiyah Tasikmalaya'];

    $status_value = $faker->randomElement($array = $status_values);

    return [
        'status_job'         => 'Student',
        'status_description' => ($faker->boolean($chanceOfGettingTrue = 50))? 'Hi. I am currently studying at '.$status_value : 'Currently studying.',
        'status_value'       => $status_value
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobStudentNoDetail', function ($faker) {
    // Deklarasi array (sebagai nilai status_value).
    // Data diperoleh dari situs berikut (diakses pada tanggal 7 Juli 2020).
    // 1. http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/
    // 2. https://web.snmptn.ac.id/ptn
    // 3. https://www.lldikti4.or.id/wp-content/uploads/2019/11/Daftar-Perguruan-Tinggi-undangan.pdf
    $status_values = ['SMP MODERN AL- ALAWIYAH', 'SMPN 3 SEPATAN', 'SMPN 4 ABAB', 'SMPS IT MIFTAHURROHMAH', 'SMP - GLOBAL', 'SMP IT AL-FALAH BANYURESMI', 'SMPN 23 AKO', 'SMPS KOPISAN', 'SMP BINA DAKWAH ISLAM TERPADU YAPISA', 'SMP ISLAM TERPADU AL USWAH', 'SMPN 5 CIRINTEN', 'SMPS ANANDA', 'SMP ISLAM AS-SALAM', 'SMP IT ARMANIYAH', 'SMPN MUGI HITUGI', 'SMPS PUTERI ATTANWIR', 'SMP IT PESANTREN AL-ZAUHAR', 'SMP NEGERI 26 KOTA TANGERANG', 'SMP PLUS NURUL IKHLASH IBTIDAI', 'SMPN SATAP SERADALA', 'SMP KIMIA TIRTA UTAMA', 'SMP KRISTEN KANAAN', 'SMP Negeri 4 Simpang Empat', 'SMPS ISLAM AL BAROKAH', 'SMP EVERGREEN', 'SMP IT BANI ROSYIDIN', 'SMP NEGERI 5 FATULEU BARAT SATU ATAP', 'UPT SMP SATU ATAP KALIGAMBIR', 'SMA NEGERI 1 WULANDONI', 'SMA NU HASYIM ASY ARI', 'SMAN 1 PLOSOKLATEN', 'SMAS GALUH HANDAYANI', 'SMA EDUCATION', 'SMAN 1 SIAU BARAT', 'SMAS PASUNDAN 1 CIANJUR', 'SMAS THERESIANA WELERI', 'SMAN 1 SIEMPAT NEMPU', 'SMAN 1 TOULUAAN', 'SMAN 16 Mukomuko', 'SMAS TAMAN SISWA BEKASI', 'SMAN 1 BUKIK BARISAN', 'SMAN 1 KUPANG', 'SMAN 1 PARENGAN', 'SMAN 10 HALMAHERA UTARA', 'SMA Negeri 1 Napan', 'SMA SWASTA KATOLIK FRATERAN PODOR', 'SMAS ISLAM SHOHIBURRAHMAN BELEKA', 'SMAS MUHAMMADIYAH (PLUS) SALATIGA', 'SMA SANTO MICHAEL', 'SMAN 10 MERANGIN', 'SMAN 4 KOTA KOMBA', 'SMAS DARMA PERTIWI', 'SMA NEGERI 1 MUARA BADAK', 'SMAS ELPIDA', 'SMAS MUHAMMADIYAH', 'SMAS MUHAMMADIYAH T PINANG', 'ISBI ACEH', 'UNIVERSITAS ISLAM NEGERI AR-RANIRY', 'UNIVERSITAS MALIKUSSALEH', 'UNIVERSITAS SAMUDRA', 'UNIVERSITAS SYIAH KUALA', 'UNIVERSITAS TEUKU UMAR', 'UNIVERSITAS ISLAM NEGERI SUMATERA UTARA', 'UNIVERSITAS NEGERI MEDAN', 'UNIVERSITAS SUMATERA UTARA', 'ISI PADANG PANJANG', 'UNIVERSITAS ANDALAS', 'UNIVERSITAS NEGERI PADANG', 'UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM', 'UNIVERSITAS RIAU', 'UNIVERSITAS MARITIM RAJA ALI HAJI', 'UNIVERSITAS JAMBI', 'UNIVERSITAS BENGKULU', 'UNIVERSITAS ISLAM NEGERI RADEN FATAH', 'UNIVERSITAS SRIWIJAYA', 'UNIVERSITAS BANGKA BELITUNG', 'INSTITUT TEKNOLOGI SUMATERA', 'UNIVERSITAS LAMPUNG', 'UNIVERSITAS INDONESIA', 'UNIVERSITAS ISLAM NEGERI JAKARTA', 'UNIVERSITAS NEGERI JAKARTA', 'UNIVERSITAS TERBUKA', 'Universitas Telkom', 'Universitas Katolik Parahyangan', 'Universitas Presiden', 'Universitas Islam Nusantara', 'Universitas Jenderal Achmad Yani', 'Universitas Pakuan', 'Universitas Komputer Indonesia', 'Universitas Pamulang', 'Universitas Swadaya Gunung Djati', 'Universitas Muhammadiyah Sukabumi', 'Universitas Pembangunan Jaya Tangerang', 'Universitas Galuh', 'Universitas Ibn Khaldun', 'Universitas Suryakancana', 'Universitas Muhammadiyah Tasikmalaya'];

    return [
        'status_job'         => 'Student',
        'status_description' => null,
        'status_value'       => $faker->randomElement($array = $status_values)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobStudentNoPlace', function ($faker) {
    return [
        'status_job'         => 'Student',
        'status_description' => 'This is a description.',
        'status_value'       => null
    ];
});

$factory->state(App\Models\Student::class, 'StatusJobStudentNoInfo', [
    'status_job'         => 'Student',
    'status_description' => null,
    'status_value'       => null
]);

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobProfessional', function ($faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    $status_value = $faker->company;

    return [
        'status_job'         => 'Professional',
        'status_description' => ($faker->boolean($chanceOfGettingTrue = 50))? 'Hi. I am currently working at '.$status_value : 'Working...',
        'status_value'       => $status_value
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobProfessionalNoDetail', function ($faker) {
    // Referensi: https://github.com/fzaninotto/Faker
    $faker = Faker\Factory::create('id_ID'); // Membuat faker lokal dalam Bahasa Indonesia.

    return [
        'status_job'         => 'Professional',
        'status_description' => null,
        'status_value'       => $faker->company
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'StatusJobProfessionalNoPlace', function ($faker) {
    return [
        'status_job'         => 'Professional',
        'status_description' => 'This is a description.',
        'status_value'       => null
    ];
});

$factory->state(App\Models\Student::class, 'StatusJobProfessionalNoInfo', [
    'status_job'         => 'Professional',
    'status_description' => null,
    'status_value'       => null
]);

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'Interest', function ($faker) {
    // Deklarasi array.
    $interests = ['Singing', 'Dancing', 'Reading', 'Listening to music', 'Playing games', 'Football', 'Sports', 'Physical exercise', 'Teaching', 'Public speaking', 'Leadership', 'Painting', 'Drawing', 'Travelling', 'Swimming', 'Playing chess', 'Computer', 'Software development', 'Foods & beverages', 'Hiking', 'Surfing', 'Snorkeling', 'Administration', 'Business', 'Writing'];

    return [
        'interest' => implode(", ", $faker->randomElements(
             $array = $interests,
             $count = $faker->numberBetween($min = 1, $max = 5)
        ))
    ];
});

$factory->state(App\Models\Student::class, 'TargetLanguageExperienceOpt1', [
    'target_language_experience' => 'Never (no experience)'
]);

$factory->state(App\Models\Student::class, 'TargetLanguageExperienceOpt2', [
    'target_language_experience' => '< 6 months'
]);

$factory->state(App\Models\Student::class, 'TargetLanguageExperienceOpt3', [
    'target_language_experience' => '<= 1 year'
]);

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'TargetLanguageExperienceOpt4', function ($faker) {
    return [
        'target_language_experience'       => 'Others',
        'target_language_experience_value' => $faker->numberBetween($min = 2, $max = 10) // Menggunakan satuan "tahun".
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'DescriptionOfCourseTaken', function ($faker) {
    return [
        'description_of_course_taken' => 'This is a text for description_of_course_taken.'
    ];
});

$factory->state(App\Models\Student::class, 'IndonesianLanguageProficiencyOpt1', [
    'indonesian_language_proficiency' => 'Novice'
]);

$factory->state(App\Models\Student::class, 'IndonesianLanguageProficiencyOpt2', [
    'indonesian_language_proficiency' => 'Intermediate'
]);

$factory->state(App\Models\Student::class, 'IndonesianLanguageProficiencyOpt3', [
    'indonesian_language_proficiency' => 'Advanced'
]);

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'LearningObjective', function ($faker) {
    return [
        'learning_objective' => 'This is a text for learning_objective.'
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'CreatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null)
    ];
});

// Gunakan fungsi ini apabila memerlukan variabel $faker pada waktu melakukan update state.
$factory->state(App\Models\Student::class, 'UpdatedAt', function ($faker) {
    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});