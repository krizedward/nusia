<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\User;

use Str;
use App\Models\Instructor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class InstructorController extends Controller
{
    /**
     * Memeriksa role User saat ini.
     * Return user.roles atau null.
     */
    public function user_roles() {
        return (Auth::check())? Auth::user()->roles : null;
    }

    /**
     * Memeriksa jenis role User saat ini.
     * 1: True (jenis role sesuai)
     * 0: False (jenis role tidak sesuai)
     */
    public function is_admin() {
        return ($this->user_roles() == "Admin")? 1 : 0;
    }
    public function is_instructor() {
        return ($this->user_roles() == "Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->is_student()){
            //halaman yang menampilkan data instructor yang
            // akan mengajar student yang terdaftar
            $instructors = Instructor::all();
            return view('instructors.student_index', compact('instructors'));
        }

        if ($this->is_admin()){
            $data = Instructor::all();
            return view('instructors.admin_index', compact('data'));
        }

        //$data = Instructor::all();
        //return view('users.instructors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_instructor()) {
            $countries = [
                'Afghanistan', 'Albania', 'Algeria', 'Angola', 'Anguilla',
                'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria',
                'Azerbaijan', 'Azores', 'Bahamas', 'Bangladesh', 'Barbados',
                'Belarus', 'Belgium', 'Belize', 'Bermuda', 'Bolivia',
                'Bosnia & Herzegovina', 'Brazil', 'Bulgaria', 'Cambodia', 'Cameroon',
                'Canada', 'Cape Verde', 'Cayman Islands', 'Chile', 'China',
                'Columbia', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus',
                'Czech Republic', 'Czechoslovakia', 'Denmark', 'Dominica', 'Dominican Republic',
                'Ecuador', 'Egypt', 'El Salvador', 'Eritrea', 'Ethiopia',
                'Fiji', 'Finland', 'France', 'Georgia', 'Germany',
                'Ghana', 'Greece', 'Grenada', 'Guam', 'Guatemala',
                'Guinea', 'Guyana', 'Haiti', 'Honduras', 'Hong Kong',
                'Hungary', 'India', 'Indonesia', 'Iran', 'Iraq',
                'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan',
                'Jordan', 'Kazakhstan', 'Kenya', 'Kosovo', 'Kuwait',
                'Laos', 'Latvia', 'Lebanon', 'Liberia', 'Liechtenstein',
                'Lithuania', 'Macedonia', 'Madagascar', 'Malaysia', 'Mexico',
                'Moldova', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar (Burma)',
                'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Nigeria',
                'North Korea', 'Northern Ireland', 'Norway', 'Pakistan', 'Panama',
                'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal',
                'Puerto Rico', 'Romania', 'Russia', 'Saint Barthelemy', 'Samoa',
                'Saudi Arabia', 'Scotland', 'Senegal', 'Serbia', 'Sierra Leone',
                'Singapore', 'Slovakia', 'Somalia', 'South Africa', 'South Korea',
                'Spain', 'Sri Lanka', 'St. Kitts--Nevis', 'St. Lucia', 'St. Vincent and the Grenadines',
                'Sudan', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
                'Tanzania', 'Thailand', 'Timor-Leste', 'Tonga', 'Trinidad and Tobago',
                'Turkey', 'U. S. Virgin Islands', 'Uganda', 'Ukraine', 'United Kingdom',
                'United States of America', 'United States Virgin Islands', 'Uruguay', 'Uzbekistan', 'Venezuela',
                'Vietnam', 'Wales', 'Yemen', 'Yugoslavia', 'Zimbabwe'
            ];
            $interests = [
                'Administration', 'Agriculture', 'Animal caring', 'Architecture', 'Art', 'Aviation',
                'Baking', 'Baseball', 'Basketball', 'Blogging', 'Boating', 'Bowling',
                'Broadcasting', 'Business', 'Camping', 'Chess', 'Child caring',
                'Clothing', 'Collecting', 'Community service', 'Cooking', 'Cosmetics', 'Crafting', 'Creative Writing', 'Culinary', 'Culture',
                'Cycling', 'Dancing', 'Design', 'Discussion', 'Driving/racing',
                'Electronics', 'Entrepreneurship', 'Event organizing', 'Fashion', 'Finance',
                'Fishing', 'Foods & beverages', 'Football', 'Formulate Teaching Methods', 'Gardening', 'Gender Studies', 'Golf',
                'Hairstyling', 'Handicrafting', 'Health', 'Higher education', 'Hiking',
                'History', 'Home decoration', 'Horseback riding', 'Housecleaning', 'Hunting',
                'Ice hockey', 'Jogging', 'Knowledge', 'Korean Pop Culture', 'Lacrosse', 'Laundry/ironing', 'Law',
                'Leadership', 'Leatherworking', 'Listening', 'Listening Music', 'Literature', 'Management', 'Marketing',
                'Mechanics', 'Motivating', 'Movie', 'Music', 'Nursing',
                'Outdoor recreation', 'Photography', 'Physical exercise', 'Politics', 'Pop Culture', 'Pottery',
                'Programming', 'Reading', 'Real estate', 'Research', 'Retail',
                'Running (marathon)', 'Running (sprint)', 'Science Fiction', 'Scouting', 'Sewing/needle work', 'Sharing', 'Sharing Culture', 'Shopping',
                'Singing', 'Skiing', 'Snorkeling', 'Snowboarding', 'Soccer', 'Social',
                'Speaking (1-on-1)', 'Speaking (public)', 'Sports', 'Surfing', 'Swimming',
                'Teaching', 'Technology', 'Tennis', 'Thriathlons', 'Tourism', 'Travelling',
                'Videographing', 'Volleyball', 'Volunteering', 'Walking', 'Wrestling', 'Writing',
                'Woodworking',
            ];

            return view('instructors.admin_create', compact('countries', 'interests'));
        } else {
            return redirect()->route('instructors.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $working_experience_begin_year = array(
            $request->working_experience_begin_year_1,
            $request->working_experience_begin_year_2,
            $request->working_experience_begin_year_3,
            $request->working_experience_begin_year_4,
            $request->working_experience_begin_year_5,
            $request->working_experience_begin_year_6,
            $request->working_experience_begin_year_7,
            $request->working_experience_begin_year_8,
            $request->working_experience_begin_year_9,
            $request->working_experience_begin_year_10
        );
        $working_experience_end_year = array(
            $request->working_experience_end_year_1,
            $request->working_experience_end_year_2,
            $request->working_experience_end_year_3,
            $request->working_experience_end_year_4,
            $request->working_experience_end_year_5,
            $request->working_experience_end_year_6,
            $request->working_experience_end_year_7,
            $request->working_experience_end_year_8,
            $request->working_experience_end_year_9,
            $request->working_experience_end_year_10
        );
        $working_experience = array(
            $request->working_experience_1,
            $request->working_experience_2,
            $request->working_experience_3,
            $request->working_experience_4,
            $request->working_experience_5,
            $request->working_experience_6,
            $request->working_experience_7,
            $request->working_experience_8,
            $request->working_experience_9,
            $request->working_experience_10
        );

        $flag = 1;
        for($i = 0; $i < 10; $i = $i + 1) {
            if($request->working_experience_begin_year_1 == null) {
                // No data in the arrays.
                $flag = -1;
                break;
            }
            else if($working_experience_begin_year[$i] == null) {
                // No data after this index, so unset all index(es) that (be) not needed.
                for(; $i < 10; $i = $i + 1) unset($working_experience[$i]);
                break; // Stop the repetition.
            }

            // SPECIAL CONDITION.
            if($working_experience_begin_year[$i] != null && $working_experience[$i] == null) {
                // $working_experience should be filled when $working_experience_begin_year exists.
                $flag = 0;
                break; // Validation will be error, so stop the repetition.
            }

            if($working_experience_begin_year[$i] != null && $working_experience_end_year[$i] != null) {
                if($working_experience_begin_year[$i] < $working_experience_end_year[$i]) {
                    // Completely filled.
                    $working_experience[$i] = $working_experience_begin_year[$i].'-'.$working_experience_end_year[$i].': '.$working_experience[$i];
                } else if($working_experience_begin_year[$i] == $working_experience_end_year[$i]) {
                    // Write just a year (because both of them are same).
                    $working_experience[$i] = $working_experience_begin_year[$i].': '.$working_experience[$i];
                } else {
                    // Reverse the years.
                    $working_experience[$i] = $working_experience_end_year[$i].'-'.$working_experience_begin_year[$i].': '.$working_experience[$i];
                }
            } else if($working_experience_begin_year[$i] != null) {
                // Here, $working_experience_end_year is null.
                $working_experience[$i] = $working_experience_begin_year[$i].': '.$working_experience[$i];
            }
        }
        if($flag == 1) $working_experience = implode('|| ', $working_experience);

        $interest = array(
            $request->interest_1,
            $request->interest_2,
            $request->interest_3,
            $request->interest_4,
            $request->interest_5,
            $request->interest_6
        );
        for($i = 0; $i < 6; $i = $i + 1) {
            if($interest[$i] == null) unset($interest[$i]);
        }
        $interest = implode(', ', $interest);

        $data = $request->all();
        $data = Validator::make($data, [
            'first_name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'email' => ['bail', 'required', 'unique:users'],
            'password' => ['bail', 'required', 'min:8'],
            'citizenship' => ['bail', 'required'],
            'domicile' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:5000'],

            'working_experience_1' => ['bail', 'required_unless:working_experience_begin_year_1,'],
            'working_experience_2' => ['bail', 'required_unless:working_experience_begin_year_2,'],
            'working_experience_3' => ['bail', 'required_unless:working_experience_begin_year_3,'],
            'working_experience_4' => ['bail', 'required_unless:working_experience_begin_year_4,'],
            'working_experience_5' => ['bail', 'required_unless:working_experience_begin_year_5,'],
            'working_experience_6' => ['bail', 'required_unless:working_experience_begin_year_6,'],
            'working_experience_7' => ['bail', 'required_unless:working_experience_begin_year_7,'],
            'working_experience_8' => ['bail', 'required_unless:working_experience_begin_year_8,'],
            'working_experience_9' => ['bail', 'required_unless:working_experience_begin_year_9,'],
            'working_experience_10' => ['bail', 'required_unless:working_experience_begin_year_10,'],
            'working_experience_11' => ['bail', 'required_unless:working_experience_begin_year_11,'],
            'working_experience_12' => ['bail', 'required_unless:working_experience_begin_year_12,'],
            'working_experience_13' => ['bail', 'required_unless:working_experience_begin_year_13,'],
            'working_experience_14' => ['bail', 'required_unless:working_experience_begin_year_14,'],
            'working_experience_15' => ['bail', 'required_unless:working_experience_begin_year_15,'],
            'interest_1' => ['bail', 'sometimes'],
        ]);
        /*
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }*/

        if ($this->is_admin()) {
            //alert
            Alert::success('Success Title', 'Success Message');
            //user create
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'roles' => 'Instructor',
                'citizenship' => $request->citizenship,
                'timezone' => 'Asia/Jakarta',
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', $data) : null,
            ]);

            $temp = User::all()->last();
            
            Instructor::create([
                'user_id' => $temp->id,
                'working_experience' => $working_experience,
                'interest' => $interest,
            ]);

            //\Session::flash('admin_store_instructor','Create Success !!!');
        }


        if($this->is_instructor()) {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Instructor',
                'citizenship' => $request->citizenship,
                'domicile' => 'Indonesia',
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', $data) : null,
            ]);
            $temp = User::all()->last();

            Instructor::create([
                'user_id' => $temp->id,
                'working_experience' => $working_experience,
                'interest' => $interest,
            ]);

            \Session::flash('coba','Create Success !!!');
        } else {
            // Tidak memiliki izin akses.
        }

        return redirect()->route('instructors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Instructor::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }
        if ($this->is_admin()){

            $instructor = Instructor::all();
            return view('instructors.admin_show',compact('instructor','id'));
        }
        return view('users.instructors.show', compact('instructor','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->is_admin() || $this->is_instructor()) {
            $data = Instructor::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('users.instructors.edit', compact('data'));
        } else {
            return redirect()->route('instructors.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Berpindah ke ProfileController, fungsi update()
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Course Private Untuk Memilih Instructor
     *
     * Role: Student
    */
    public function private()
    {
        $instructors = Instructor::all();
        return view('courses.student_private_instructor', compact('instructors'));
    }
}
