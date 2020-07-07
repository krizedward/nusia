<?php

use Illuminate\Database\Seeder;
use App\Models\Instructors;

class oldInstructorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instructors::create([
        	'user_id'	=> 1,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic1.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 
			'2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2018: Instructor, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang
			2018: Language partner, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang
			2017: Instructor, Teaching Practicum, Walailak University, Thailand
			2017 – 2018: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2016: Language partner,  In-Country (Thailand Student Exchange Program), Universitas Negeri Malang',
        ]);

        Instructors::create([
        	'user_id'	=> 2,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic2.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 
			'2019: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2018: Instructor, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang
			2018: Language partner, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang
			2017: Instructor, Teaching Practicum, Walailak University, Thailand
			2017 – 2018: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2016: Language partner,  In-Country (Thailand Student Exchange Program), Universitas Negeri Malang',
        ]);

        Instructors::create([
        	'user_id'	=> 5,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic3.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> '2018: Instructor, Language Assistant Program, the Department of Education WA, Australia.',
        ]);

        Instructors::create([
        	'user_id'	=> 6,
			'location'	=> 'Indonesia',
			'gender'	=> 'male',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic4.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 
			'2017 – 2019: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2018 – 2019: Language partner, Study Abroad—Kasetsart University (Thailand Student Exchange Program), Universitas Negeri Malang',
        ]);

        Instructors::create([
        	'user_id'	=> 7,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic5.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 
			'2019: Senior Assistant Program, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2019: Administration Staff, Indonesian Flagship Language Initiative—IFLI (American Student Exchange Program), Universitas Negeri Malang 
			2018 – 2019: Instructor, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang 
			2018: Instructor, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2016 – 2017: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2016: Language partner, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang',
        ]);

        Instructors::create([
        	'user_id'	=> 8,
			'location'	=> 'Indonesia',
			'gender'	=> 'female',
			'phone'		=> '0812345678',
			'birthdate'	=> '2020/02/01',
			'image'		=> 'pic7.png',
			'interest'	=> 'read, eat, travel',
			'pro_experiences'	=> 
			'2019: Language partner, Critical Language Scholarship—CLS (American Student Exchange Program), Universitas Negeri Malang
			2018 – 2019: Language partner, In-Country (Thailand Student Exchange Program), Universitas Negeri Malang',
        ]);
    }
}
