<?php

namespace App\Http\Controllers;

use App\Models\SessionRegistration;
use Illuminate\Http\Request;

use App\User;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Session;
use App\Models\MaterialSession;
use App\Models\CourseRegistration;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
            $session_reg = SessionRegistration::all();
            return view('dashboard.instructor_index', compact('session_reg'));
        }

        if($this->is_student()) {
            $session = Session::all();
            $material = MaterialSession::all();
            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
            return view('dashboard.student_index', compact('session','material','course_registrations'));
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

        $data = $request->all();
        $data = Validator::make($data, [
            'citizenship' => ['bail', 'required'],
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


        if($this->is_admin()) {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Student',
                'citizenship' => $request->citizenship,
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', $data) : null,
            ]);
        }

        if($this->is_student()){
            $temp = User::all()->last();

            Student::create([
                'user_id' => $temp->id,
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

            \Session::flash('coba','Create Success !!!');
        }

        return redirect()->route('home');
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
            'Administration', 'Agriculture', 'Animal caring', 'Architecture', 'Aviation',
            'Baseball', 'Basketball', 'Blogging', 'Boating', 'Bowling',
            'Broadcasting', 'Business', 'Camping', 'Chess', 'Child caring',
            'Clothing', 'Collecting', 'Community service', 'Cooking/baking', 'Cosmetics',
            'Cycling', 'Dancing', 'Design', 'Discussion', 'Driving/racing',
            'Electronics', 'Entrepreneurship', 'Event organizing', 'Fashion', 'Finance',
            'Fishing', 'Foods & beverages', 'Football', 'Gardening', 'Golf',
            'Hairstyling', 'Handicrafting', 'Health', 'Higher education', 'Hiking',
            'History', 'Home decoration', 'Horseback riding', 'Housecleaning', 'Hunting',
            'Ice hockey', 'Jogging', 'Lacrosse', 'Laundry/ironing', 'Law',
            'Leadership', 'Leatherworking', 'Listening', 'Management', 'Marketing',
            'Mechanics', 'Motivating', 'Movies', 'Music', 'Nursing',
            'Outdoor recreation', 'Photographing', 'Physical exercise', 'Politics', 'Pottery',
            'Programming', 'Reading', 'Real estate', 'Research', 'Retail',
            'Running (marathon)', 'Running (sprint)', 'Scouting', 'Sewing/needle work', 'Shopping',
            'Singing', 'Skiing', 'Snorkeling', 'Snowboarding', 'Soccer',
            'Speaking (1-on-1)', 'Speaking (public)', 'Sports', 'Surfing', 'Swimming',
            'Teaching/lecturing', 'Technology', 'Tennis', 'Travelling', 'Thriathlons',
            'Videographing', 'Volleyball', 'Walking', 'Wrestling', 'Writing',
            'Woodworking',
        ];

        return view('layouts.questionnaire', compact('countries', 'interests'));
    }

    public function profile($id)
    {
        if($this->is_admin()){
            return view('profile.admin');
        }

        if($this->is_student()){
            $student = Student::where('user_id',$id)->get();
            return view('profile.student',compact('student'));
        }
    }
}
