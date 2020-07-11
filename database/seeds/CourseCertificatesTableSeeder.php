<?php

use Illuminate\Database\Seeder;
use App\Models\CourseCertificate;

class CourseCertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseCertificate::class, 5)
            ->states('Randomized')
            ->create()
            ->make();
    }
}
