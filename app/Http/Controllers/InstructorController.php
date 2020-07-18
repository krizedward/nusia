<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Str;
use App\Models\Instructor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $data = Instructor::all();
        return view('users.instructors.index', compact('data'));
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

            return view('users.instructors.create', compact('countries', 'interests'));
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

        if($flag == 1) {
            $working_experience = implode(', ', $working_experience);

            if($working_experience != null) {
                $request->working_experience_begin_year_1 = 'PASS';
            } else $request->working_experience_begin_year_1 = null;
        } else if($flag == 0) {
            // $working_experience should be filled when $working_experience_begin_year exists.
            // Results in validation error.
            $request->working_experience_begin_year_1 = null;
        } else {
            // $flag == -1
            // No data in the arrays.
            $request->working_experience_begin_year_1 = 'PASS';
        }

        $educational_experience_begin_year = array(
            $request->educational_experience_begin_year_1,
            $request->educational_experience_begin_year_2,
            $request->educational_experience_begin_year_3,
            $request->educational_experience_begin_year_4,
            $request->educational_experience_begin_year_5,
            $request->educational_experience_begin_year_6,
            $request->educational_experience_begin_year_7,
            $request->educational_experience_begin_year_8,
            $request->educational_experience_begin_year_9,
            $request->educational_experience_begin_year_10
        );
        $educational_experience_end_year = array(
            $request->educational_experience_end_year_1,
            $request->educational_experience_end_year_2,
            $request->educational_experience_end_year_3,
            $request->educational_experience_end_year_4,
            $request->educational_experience_end_year_5,
            $request->educational_experience_end_year_6,
            $request->educational_experience_end_year_7,
            $request->educational_experience_end_year_8,
            $request->educational_experience_end_year_9,
            $request->educational_experience_end_year_10
        );
        $educational_experience = array(
            $request->educational_experience_1,
            $request->educational_experience_2,
            $request->educational_experience_3,
            $request->educational_experience_4,
            $request->educational_experience_5,
            $request->educational_experience_6,
            $request->educational_experience_7,
            $request->educational_experience_8,
            $request->educational_experience_9,
            $request->educational_experience_10
        );

        $flag = 1;
        for($i = 0; $i < 10; $i = $i + 1) {
            if($request->educational_experience_begin_year_1 == null) {
                // No data in the arrays.
                $flag = -1;
                break;
            }
            else if($educational_experience_begin_year[$i] == null) {
                // No data after this index, so unset all index(es) that (be) not needed.
                for(; $i < 10; $i = $i + 1) unset($educational_experience[$i]);
                break; // Stop the repetition.
            }

            // SPECIAL CONDITION.
            if($educational_experience_begin_year[$i] != null && $educational_experience[$i] == null) {
                // $educational_experience should be filled when $educational_experience_begin_year exists.
                $flag = 0;
                break; // Validation will be error, so stop the repetition.
            }

            if($educational_experience_begin_year[$i] != null && $educational_experience_end_year[$i] != null) {
                if($educational_experience_begin_year[$i] < $educational_experience_end_year[$i]) {
                    // Completely filled.
                    $educational_experience[$i] = $educational_experience_begin_year[$i].'-'.$educational_experience_end_year[$i].': '.$educational_experience[$i];
                } else if($educational_experience_begin_year[$i] == $educational_experience_end_year[$i]) {
                    // Write just a year (because both of them are same).
                    $educational_experience[$i] = $educational_experience_begin_year[$i].': '.$educational_experience[$i];
                } else {
                    // Reverse the years.
                    $educational_experience[$i] = $educational_experience_end_year[$i].'-'.$educational_experience_begin_year[$i].': '.$educational_experience[$i];
                }
            } else if($educational_experience_begin_year[$i] != null) {
                // Here, $educational_experience_end_year is null.
                $educational_experience[$i] = $educational_experience_begin_year[$i].': '.$educational_experience[$i];
            }
        }

        if($flag == 1) {
            $educational_experience = implode(', ', $educational_experience);

            if($educational_experience != null) {
                $request->educational_experience_begin_year_1 = 'PASS';
            } else $request->educational_experience_begin_year_1 = null;
        } else if($flag == 0) {
            // $educational_experience should be filled when $educational_experience_begin_year exists.
            // Results in validation error.
            $request->educational_experience_begin_year_1 = null;
        } else {
            // $flag == -1
            // No data in the arrays.
            $request->educational_experience_begin_year_1 = 'PASS';
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

        if($interest != null) {
            $request->interest_1 = 'PASS';
        } else $request->interest_1 = null;

        $data = $request->all();
        $data = Validator::make($data, [
            'first_name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'email' => ['bail', 'required', 'unique:users'],
            'password' => ['bail', 'required', 'min:8'],
            'citizenship' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:5000'],

            'working_experience_begin_year_1' => ['bail', 'sometimes'], // Bug: it should be that a special condition applies.
            'educational_experience_begin_year_1' => ['bail', 'sometimes'], // Bug: it should be that a special condition applies.
            'interest_1' => ['bail', 'sometimes'],
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        // Membuat slug baru.
        $data = "";
        while(1) {
            $data = Str::random(255);
            if(User::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_instructor()) {
            User::create([
                'slug' => $data,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Instructor',
                'citizenship' => $request->citizenship,
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', $data) : null,
            ]);
            $temp = User::all()->last();

            Instructor::create([
                'slug' => $data,
                'user_id' => $temp->id,
                'working_experience' => $working_experience,
                'educational_experience' => $educational_experience,
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
}
