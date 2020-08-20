<?php

namespace App\Http\Controllers;

use App\Models\SessionRegistration;
use Illuminate\Http\Request;

use App\User;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Session;
use App\Models\Schedule;
use App\Models\MaterialSession;
use App\Models\CourseRegistration;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;

class HomeController extends Controller
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
        if($this->is_admin()) {
            $student = Student::all();
            $instructor = Instructor::all();
            return view('dashboard.admin_index',compact('student','instructor'));
        }

        if($this->is_instructor()) {
            $timeNusia = Carbon::now();
            $timeStudent = Carbon::now(Auth::user()->timezone);
            $session_reg = SessionRegistration::all();
            $session_reg_order_by_schedule_time = Schedule
                ::join('instructors', 'schedules.instructor_id_2', 'instructors.id')
                ->join('users', 'instructors.user_id', 'users.id')
                ->where('instructor_id', Auth::user()->instructor->id)
                ->orWhere('instructor_id_2', Auth::user()->instructor->id)
                ->orderBy('schedule_time')
                ->select('schedules.id', 'schedules.code', 'schedules.instructor_id', 'schedules.instructor_id_2', 'schedules.schedule_time', 'schedules.status', 'schedules.created_at', 'schedules.updated_at', 'users.image_profile')
                ->get();
            return view('dashboard.instructor_index', compact('session_reg', 'session_reg_order_by_schedule_time','timeNusia','timeStudent'));
        }

        if($this->is_student()) {
            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('layouts.questionnaire');
            } else if(Auth::user()->student->course_registrations->count() == 0) {
                return redirect()->route('courses.index'); // KHUSUS UNTUK FREE CLASSES, mungkin ada bug di CLASS PRIVATE DAN/ATAU GROUP.
            }

            //$temp_nation = $c->where('name.common', Auth::user()->timezone)->first()->hydrate('timezones')->timezones->first()->zone_name;
            $timeNusia = Carbon::now()->setTimezone('Asia/Jakarta');
            $timeStudent = Carbon::now()->setTimezone(Auth::user()->timezone);
            //untuk mengubah zona waktu isi didalam dengan lokasi
            $session = Session
                ::join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();
            $session_order_by_schedule_time = Session
                ::join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->orderBy('schedule_time')
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();
            $material = MaterialSession::all();
            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
            $instructors = Instructor::where('id',Auth::user()->id);
            return view('dashboard.student_index', compact(
                'session', 'session_order_by_schedule_time',
                'material', 'course_registrations', 'instructors','timeNusia','timeStudent'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        if($interest != null) {
            $request->interest_1 = 'PASS';
        } else $request->interest_1 = null;

        // FOR TIMEZONE
        $c = new Countries();
        $countries = $c->all()->pluck('name.common')->toArray();
        sort($countries);

        $flag = 0;
        foreach($countries as $country) {
            $c_cities = $c->where('name.common', $country)->first()->hydrate('cities')->cities;
            foreach($c_cities as $c_city) {
                if($request->timezone == $c_city['name']) {
                    $request->timezone = $c_city['timezone'];
                    $flag = 1;
                    break;
                }
            }
            if($flag == 1) break;
        }
        if($flag == 0) $request->timezone = null;

        $data = $request->all();
        $file = $request->file('image_profile');
        $data = Validator::make($data, [
            'citizenship' => ['bail', 'required'],
            'timezone' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:5000'],

            'age' => ['bail', 'required', 'integer'],
            'status_job' => ['bail', 'required'],
            'status_description' => ['bail', 'required'],
            'interest_1' => ['bail', 'required'],
            'target_language_experience' => ['bail', 'required'],
            'target_language_experience_value' => ['bail', 'required_if:target_language_experience,Others'],
            'description_of_course_taken' => ['bail', 'required_unless:target_language_experience,Never (no experience)'],
            'indonesian_language_proficiency' => ['bail', 'required'],
            'learning_objective' => ['bail', 'required'],
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($request->target_language_experience == 'Never (no experience)') {
            $request->target_language_experience_value = null;
            $request->description_of_course_taken = null;
        } else if($request->target_language_experience == '< 6 months') {
            $request->target_language_experience_value = null;
        } else if($request->target_language_experience == '<= 1 year') {
            $request->target_language_experience_value = null;
        } else {
            // all information should be filled.
        }

        if($this->is_admin()) {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Student',
                'citizenship' => $request->citizenship,
                'timezone' => $request->timezone,
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', Hash::make(Auth::user()->id)) : null,
            ]);
        }

        if($this->is_student()){
            if ($file){
            Student::where('user_id', Auth::user()->id)->update([
                'user_id' => Auth::user()->id,
                'age' => $request->age,
                'status_job' => $request->status_job,
                'status_description' => $request->status_description,
                'interest' => $interest,
                'target_language_experience' => $request->target_language_experience,
                'target_language_experience_value' => $request->target_language_experience_value,
                'description_of_course_taken' => $request->description_of_course_taken,
                'indonesian_language_proficiency' => $request->indonesian_language_proficiency,
                'learning_objective' => $request->learning_objective,
            ]);

            User::find(Auth::user()->id)->update([
                'citizenship' => $request->citizenship,
                'timezone' => $request->timezone,
                //'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', Hash::make(Auth::user()->student->id)) : null,
                'image_profile'   => $file->getClientOriginalName(),
            ]);

            //Move Uploaded File
            $destinationPath = 'uploads/student/profile';
            $file->move($destinationPath,$file->getClientOriginalName());
            // \Session::flash('coba','Create Success !!!');
            } else {
                Student::where('user_id', Auth::user()->id)->update([
                    'user_id' => Auth::user()->id,
                    'age' => $request->age,
                    'status_job' => $request->status_job,
                    'status_description' => $request->status_description,
                    'interest' => $interest,
                    'target_language_experience' => $request->target_language_experience,
                    'target_language_experience_value' => $request->target_language_experience_value,
                    'description_of_course_taken' => $request->description_of_course_taken,
                    'indonesian_language_proficiency' => $request->indonesian_language_proficiency,
                    'learning_objective' => $request->learning_objective,
                ]);

                User::find(Auth::user()->id)->update([
                    'citizenship' => $request->citizenship,
                    'timezone' => $request->timezone,
                    //'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', Hash::make(Auth::user()->student->id)) : null,
                    'image_profile'   => 'user.jpg',
                ]);
            }
        }

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    //Menampilkan form questionnaire
    public function questionnaire()
    {
        if($this->is_admin() || $this->is_instructor()) {
            return redirect()->route('home');
        }

        if(Auth::user()->citizenship != 'Not Available') {
            if(Auth::user()->student->course_registrations->count() == 0) {
                // Jika Student belum terdaftar dalam class manapun,
                // tetapi sudah melakukan pengisian kuisioner.
                // Contoh kasus: Student mengumpulkan kuisioner, kemudian logout, kemudian login lagi.
                return redirect()->route('courses.index');
            }
            return redirect()->route('home');
        }

        /*$countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Antigua and Barbuda', 'Argentina',
            'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Azores',
            'Bahamas', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium',
            'Belize', 'Bermuda', 'Bolivia', 'Bosnia & Herzegovina', 'Brazil',
            'Bulgaria', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde',
            'Chile', 'China', 'Columbia', 'Costa Rica', 'Croatia',
            'Cuba', 'Cyprus', 'Czech Republic', 'Czechoslovakia', 'Denmark',
            'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
            'Eritrea', 'Ethiopia', 'Fiji', 'Finland', 'France',
            'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada',
            'Guam', 'Guatemala', 'Guyana', 'Haiti', 'Honduras',
            'Hong Kong', 'Hungary', 'India', 'Indonesia', 'Iran',
            'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica',
            'Japan', 'Jordan', 'Kenya', 'Kosovo', 'Kuwait',
            'Laos', 'Latvia', 'Lebanon', 'Liberia', 'Lithuania',
            'Macedonia', 'Malaysia', 'Mexico', 'Moldova', 'Morocco',
            'Myanmar (Burma)', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua',
            'Nigeria', 'North Korea', 'Northern Ireland', 'Norway', 'Pakistan',
            'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland',
            'Portugal', 'Puerto Rico', 'Romania', 'Russia', 'Samoa',
            'Saudi Arabia', 'Scotland', 'Senegal', 'Serbia', 'Sierra Leone',
            'Singapore', 'Slovakia', 'Somalia', 'South Africa', 'South Korea',
            'Spain', 'Sri Lanka', 'St. Kitts--Nevis', 'St. Lucia', 'St. Vincent and the Grenadines',
            'Sudan', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
            'Tanzania', 'Thailand', 'Tonga', 'Trinidad and Tobago', 'Turkey',
            'U. S. Virgin Islands', 'Uganda', 'Ukraine', 'United Kingdom', 'United States',
            'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Wales',
            'Yemen', 'Yugoslavia', 'Zimbabwe'
        ];*/
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

        $c = new Countries();
        $list_of_countries = $c->all()->pluck('name.common')->toArray();
        sort($list_of_countries);

        $countries = $list_of_countries;
        /* $countries = [];
        foreach($list_of_countries as $country) {
            $c_timezones = $c->where('name.common', $country)->first()->hydrate('timezones')->timezones;
            foreach($c_timezones as $c_timezone) {
                $c_abbr = "";
                foreach($c_timezone['abbreviations'] as $abbr) {
                    if($abbr[0] == '+' || $abbr[0] == '-') {
                        if(strlen($abbr) == 3 || strlen($abbr) == 5) {
                            $c_abbr = '(GMT' . $abbr . ')';
                            break;
                        }
                    }
                }
                array_push($countries, $country . ' - ' . $c_timezone['zone_name'] . ' ' . $c_abbr);
            }
        }*/
        $timezones = [];
        foreach($list_of_countries as $country) {
            /*$c_timezones = $c->where('name.common', $country)->first()->hydrate('timezones')->timezones;
            foreach($c_timezones as $c_timezone) {
                array_push($timezones, $c_timezone['zone_name']);
            }*/
            $c_cities = $c->where('name.common', $country)->first()->hydrate('cities')->cities->pluck('name');;
            foreach($c_cities as $c_city) {
                // Menghapus nama kota yang tidak dideteksi atau bernilai "null".
                if($c_city) array_push($timezones, $c_city);

                // BUG (untuk metode 1-3): Ini akan menghapus beberapa nama kota yang tidak dideteksi oleh UTF-8.

                // Metode 1: Deteksi karakter ASCII atau bukan.
                /*if(mb_check_encoding($c_city, 'ASCII')) {
                    array_push($timezones, $c_city);
                }*/

                // Metode 2: Deteksi karakter UTF-8 atau bukan.
                /*if( (bool) preg_match('//u', $c_city) ) {
                    array_push($timezones, $c_city);
                }*/

                // Metode 3: Manual menyesuaikan (TIDAK BERHASIL).
                /*$flag = 1;
                for($i = 0; $i < strlen($c_city); $i++) {
                    if($c_city[$i] >= 'a' && $c_city[$i] <= 'z') continue;
                    else if($c_city[$i] >= 'A' && $c_city[$i] <= 'Z') continue;
                    else if($c_city[$i] >= '0' && $c_city[$i] <= '9') continue;
                    else if($c_city[$i] == ' ' || $c_city[$i] == '-' || $c_city[$i] == '\'') continue;
                    else if($c_city[$i] == 'Ã' || $c_city[$i] == 'Ä' || $c_city[$i] == 'È' || $c_city[$i] == '©') continue;
                    else {
                        $flag = 0;
                        break;
                    }
                }
                if($flag == 1) {
                    array_push($timezones, $c_city);
                }*/
            }
        }
        sort($timezones);

        return view('layouts.questionnaire', compact('countries', 'interests', 'timezones'));
    }

    public function profile($id)
    {
        if($this->is_admin()){
            return view('profile.admin');
        }

        if($this->is_instructor()){
            $instructor = Instructor::where('user_id',$id)->get();
            $countries = [
                'Afghanistan', 'Albania', 'Algeria', 'Antigua and Barbuda', 'Argentina',
                'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Azores',
                'Bahamas', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium',
                'Belize', 'Bermuda', 'Bolivia', 'Bosnia & Herzegovina', 'Brazil',
                'Bulgaria', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde',
                'Chile', 'China', 'Columbia', 'Costa Rica', 'Croatia',
                'Cuba', 'Cyprus', 'Czech Republic', 'Czechoslovakia', 'Denmark',
                'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
                'Eritrea', 'Ethiopia', 'Fiji', 'Finland', 'France',
                'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada',
                'Guam', 'Guatemala', 'Guyana', 'Haiti', 'Honduras',
                'Hong Kong', 'Hungary', 'India', 'Indonesia', 'Iran',
                'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica',
                'Japan', 'Jordan', 'Kenya', 'Kosovo', 'Kuwait',
                'Laos', 'Latvia', 'Lebanon', 'Liberia', 'Lithuania',
                'Macedonia', 'Malaysia', 'Mexico', 'Moldova', 'Morocco',
                'Myanmar (Burma)', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua',
                'Nigeria', 'North Korea', 'Northern Ireland', 'Norway', 'Pakistan',
                'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland',
                'Portugal', 'Puerto Rico', 'Romania', 'Russia', 'Samoa',
                'Saudi Arabia', 'Scotland', 'Senegal', 'Serbia', 'Sierra Leone',
                'Singapore', 'Slovakia', 'Somalia', 'South Africa', 'South Korea',
                'Spain', 'Sri Lanka', 'St. Kitts--Nevis', 'St. Lucia', 'St. Vincent and the Grenadines',
                'Sudan', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
                'Tanzania', 'Thailand', 'Tonga', 'Trinidad and Tobago', 'Turkey',
                'U. S. Virgin Islands', 'Uganda', 'Ukraine', 'United Kingdom', 'United States',
                'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Wales',
                'Yemen', 'Yugoslavia', 'Zimbabwe'
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

            return view('profile.instructor',compact('instructor','countries', 'interests', 'instructor'));
        }

        if($this->is_student()){
            $student = Student::where('user_id',$id)->get();
            $countries = [
                'Afghanistan', 'Albania', 'Algeria', 'Antigua and Barbuda', 'Argentina',
                'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Azores',
                'Bahamas', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium',
                'Belize', 'Bermuda', 'Bolivia', 'Bosnia & Herzegovina', 'Brazil',
                'Bulgaria', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde',
                'Chile', 'China', 'Columbia', 'Costa Rica', 'Croatia',
                'Cuba', 'Cyprus', 'Czech Republic', 'Czechoslovakia', 'Denmark',
                'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
                'Eritrea', 'Ethiopia', 'Fiji', 'Finland', 'France',
                'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada',
                'Guam', 'Guatemala', 'Guyana', 'Haiti', 'Honduras',
                'Hong Kong', 'Hungary', 'India', 'Indonesia', 'Iran',
                'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica',
                'Japan', 'Jordan', 'Kenya', 'Kosovo', 'Kuwait',
                'Laos', 'Latvia', 'Lebanon', 'Liberia', 'Lithuania',
                'Macedonia', 'Malaysia', 'Mexico', 'Moldova', 'Morocco',
                'Myanmar (Burma)', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua',
                'Nigeria', 'North Korea', 'Northern Ireland', 'Norway', 'Pakistan',
                'Panama', 'Paraguay', 'Peru', 'Philippines', 'Poland',
                'Portugal', 'Puerto Rico', 'Romania', 'Russia', 'Samoa',
                'Saudi Arabia', 'Scotland', 'Senegal', 'Serbia', 'Sierra Leone',
                'Singapore', 'Slovakia', 'Somalia', 'South Africa', 'South Korea',
                'Spain', 'Sri Lanka', 'St. Kitts--Nevis', 'St. Lucia', 'St. Vincent and the Grenadines',
                'Sudan', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
                'Tanzania', 'Thailand', 'Tonga', 'Trinidad and Tobago', 'Turkey',
                'U. S. Virgin Islands', 'Uganda', 'Ukraine', 'United Kingdom', 'United States',
                'Uruguay', 'Uzbekistan', 'Venezuela', 'Vietnam', 'Wales',
                'Yemen', 'Yugoslavia', 'Zimbabwe'
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
            return view('profile.student',compact('student','countries', 'interests','student'));
        }
    }

    public function contact()
    {
        return view('layouts.contact');
    }
}
