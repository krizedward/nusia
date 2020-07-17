<?php

use Illuminate\Database\Seeder;
use App\Models\CourseCertificate;

class oldCourseCertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseCertificate::class, 200)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
