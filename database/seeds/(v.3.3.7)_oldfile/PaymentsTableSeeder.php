<?php

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
        	'student_id'=> 1,
        	'class_id'	=> 1,
        	'method'	=> 'paypal',
        	'pay_day'	=> '2020/02/01',
        	'status'	=> 'paid',
        ]);

        Payment::create([
        	'student_id'=> 2,
        	'class_id'	=> 1,
        	'method'	=> 'paypal',
        	'pay_day'	=> '2019/02/01',
        	'status'	=> 'paid',
        ]);
    }
}
