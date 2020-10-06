<?php

namespace App\Http\Controllers;

use App\Models\SessionRegistration;
use Illuminate\Http\Request;

use App\User;
use App\Models\Instructor;
use App\Models\Student;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
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
        if($this->is_admin()){
            return view('profile.admin');
        } else if($this->is_instructor()){
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

            return view('profile.instructor',compact(/*'countries',*/ 'interests'));
        } else if($this->is_student()){
            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('layouts.questionnaire');
            } else if(Auth::user()->student->course_registrations->count() == 0) {
                return redirect()->route('courses.index'); // KHUSUS UNTUK FREE CLASSES, mungkin ada bug di CLASS PRIVATE DAN/ATAU GROUP.
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

            $timezones = [
                '-11', '-10', '-09:30', '-09', '-08', '-07',
                '-06', '-05', '-04', '-03', '-02', '-01',
                '+00', '+01', '+02', '+03', '+04', '+04:30', '+05', '+05:30', '+05:45', '+06',
                '+06:30', '+07', '+08', '+08:45', '+09', '+09:30', '+10', '+11', '+12', '+13', '+14',
            ];
            return view('profile.student',compact(/*'countries',*/ 'interests', 'timezones'));
        } else {
            return redirect()->back();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        if($this->is_admin()) {
            $student = Student::findOrFail($student_id);

            return view('profile_details.instructor_show', compact('student'));
        }
        if($this->is_instructor()) {
            $student = Student::findOrFail($student_id);

            $flag = 0;
            foreach($student->course_registrations as $cr) {
                foreach($cr->session_registrations as $sr) {
                    if($sr->session->schedule->instructor_id == Auth::user()->instructor->id) {
                        $flag = 1;
                        break;
                    } else if($sr->session->schedule->instructor_id_2 == Auth::user()->instructor->id) {
                        $flag = 1;
                        break;
                    }
                }
                if($flag == 1) break;
            }

            if($flag == 1) {
                return view('profile_details.instructor_show', compact('student'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
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
    public function update(Request $request)
    {
        if($this->is_admin()) {
            // update tampilan profil admin (?).

            // tips: untuk Admin mengedit tampilan Instructor / Student, gunakan session('roles_to_edit') untuk mengambil roles yang sedang diedit.
            session(['roles_to_edit' => null]); // membersihkan session.
        } else if($this->is_instructor()) {
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
                $request->working_experience_begin_year_10,
                $request->working_experience_begin_year_11,
                $request->working_experience_begin_year_12,
                $request->working_experience_begin_year_13,
                $request->working_experience_begin_year_14,
                $request->working_experience_begin_year_15,
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
                $request->working_experience_end_year_10,
                $request->working_experience_end_year_11,
                $request->working_experience_end_year_12,
                $request->working_experience_end_year_13,
                $request->working_experience_end_year_14,
                $request->working_experience_end_year_15,
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
                $request->working_experience_10,
                $request->working_experience_11,
                $request->working_experience_12,
                $request->working_experience_13,
                $request->working_experience_14,
                $request->working_experience_15,
            );

            $flag = 1;
            for($i = 0; $i < 15; $i = $i + 1) {
                if($request->working_experience_begin_year_1 == null) {
                    // No data in the arrays.
                    $flag = -1;
                    break;
                } else if($working_experience_begin_year[$i] == null) {
                    // No data after this index, so unset all index(es) that (be) not needed.
                    for(; $i < 15; $i = $i + 1) unset($working_experience[$i]);
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
            sort($working_experience);
            if($flag == 1) $working_experience = implode('|| ', $working_experience);
            else {
                for($i = 0; $i < 15; $i = $i + 1) {
                    if($working_experience[$i] == null) unset($working_experience[$i]);
                }
                $working_experience = implode('|| ', $working_experience);
            }

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

            $flag = 1;
            if($request->old_password != null && strlen($request->old_password) < 8) {
                session(['error_old_password' => 'This field is required to have at least 8 characters.']);
                $flag = 0;
            }
            if($request->password != null && strlen($request->password) < 8) {
                session(['error_password' => 'This field is required to have at least 8 characters.']);
                $flag = 0;
            }
            if(strlen($request->old_password) >= 8 && strlen($request->password) >= 8 && !Hash::check($request->old_password, Auth::user()->password)) {
                session(['error_old_password' => 'This input field does not match the previous password.']);
                $flag = 0;
            }
            if($request->old_password != null && $request->password == null) {
                session(['error_password' => 'This field is required.']);
                $flag = 0;
            }
            if($request->password != null && $request->old_password == null) {
                session(['error_old_password' => 'This field is required.']);
                $flag = 0;
            }
            if($flag == 0) return redirect()->back()->withInput();

            $data = $request->all();
            $data = Validator::make($data, [
                'first_name' => ['bail', 'sometimes'],
                'last_name' => ['bail', 'sometimes'],
                'email' => ['bail', 'sometimes', Rule::unique('users')->ignore(Auth::user()->id, 'id')],
                'old_password' => ['bail', 'sometimes'],
                'password' => ['bail', 'sometimes'],
                'citizenship' => ['bail', 'sometimes'],
                'domicile' => ['bail', 'sometimes'],
                'image_profile' => ['bail', 'sometimes', 'max:8000'],

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

            if($data->fails()) {
                return redirect()->back()
                    ->withErrors($data)
                    ->withInput();
            }

            $file = $request->file('image_profile');
            if($file && Auth::user()->image_profile != 'user.jpg') {
                $destinationPath = 'uploads/instructor/';
                File::delete($destinationPath . Auth::user()->image_profile);
            }

            if($file) {
                $file_name = Str::random(50).'.'.$file->extension();

                Auth::user()->update([
                    'image_profile' => $file_name,
                ]);

                //Move Uploaded File
                $destinationPath = 'uploads/instructor/';
                $file->move($destinationPath, $file_name);
            }

            Auth::user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'citizenship' => $request->citizenship,
                'domicile' => $request->domicile,
            ]);

            Auth::user()->instructor->update([
                'working_experience' => $working_experience,
                'interest' => $interest,
            ]);

            return redirect()->route('profile');
        } else if($this->is_student()) {
            // update tampilan profil student.
        } else {
            return redirect()->route('profile');
        }
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
}
