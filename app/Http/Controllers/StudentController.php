<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use PragmaRX\Countries\Package\Countries;
use Str;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Carbon\Carbon;

class StudentController extends Controller
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
        if ($this->is_admin()) {
            $data = Student::all();
            return view('students.admin_index', compact('data'));
        }
        //$data = Student::all();
        //return view('users.students.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->is_admin() || $this->is_student()) {
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

            return view('users.students.create', compact('countries', 'interests'));
        } else {
            return redirect()->route('students.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
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
            'first_name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'email' => ['bail', 'required', 'unique:users'],
            'password' => ['bail', 'required', 'min:8'],
            'citizenship' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],

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

        // Membuat slug baru.
        $data = "";
        while(1) {
            $data = Str::random(255);
            if(User::where('slug', $data)->first() === null) break;
        }

        if($this->is_admin() || $this->is_student()) {
            User::create([
                'slug' => $data,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Student',
                'citizenship' => $request->citizenship,
                'image_profile' => ($request->hasFile('image_profile'))? $request->file('image_profile')->storeAs('students', $data) : null,
            ]);
            $temp = User::all()->last();

            Student::create([
                'slug' => $data,
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
        } else {
            // Tidak memiliki izin akses.
        }

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Student::findOrFail($id);
        if($data == null) {
            return redirect()->back();
        }
        if ($this->is_admin()){

            $student = Student::all();
            return view('students.admin_show',compact('data'));
        }

        return view('users.students.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->is_admin() || $this->is_student()) {
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

            $data = Student::findOrFail($id);
            if($data == null) {
                // Data yang dicari tidak ditemukan.
                // Return?
            }
            return view('users.students.edit', compact('countries', 'interests', 'data'));
        } else {
            return redirect()->route('students.index');
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
        $student = Student::findOrFail($id);
        $file = $request->file('image_profile');

        $data = $request->all();
        $data = Validator::make($data, [
            'timezone' => ['bail', 'sometimes'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],
        ]);

        // FOR TIMEZONE
        $timezones = [
            '-11', '-10', '-09:30', '-09', '-08', '-07',
            '-06', '-05', '-04', '-03', '-02', '-01',
            '+00', '+01', '+02', '+03', '+04', '+04:30', '+05', '+05:30', '+05:45', '+06',
            '+06:30', '+07', '+08', '+08:45', '+09', '+09:30', '+10', '+11', '+12', '+13', '+14',
        ];

        $zone_names = [
            'Pacific/Pago_Pago',      // -11
            'Pacific/Rarotonga',      // -10
            'Pacific/Marquesas',      // -09:30
            'Pacific/Gambier',        // -09
            'Pacific/Pitcairn',       // -08
            'America/Phoenix',        // -07
            'America/Costa_Rica',     // -06
            'America/Panama',         // -05
            'America/Port_of_Spain',  // -04
            'America/Montevideo',     // -03
            'Atlantic/South_Georgia', // -02
            'Atlantic/Cape_Verde',    // -01
            'Africa/Abidjan',         // +00
            'Africa/Lagos',           // +01
            'Africa/Maputo',          // +02
            'Africa/Nairobi',         // +03
            'Asia/Dubai',             // +04
            'Asia/Kabul',             // +04:30
            'Asia/Ashgabat',          // +05
            'Asia/Colombo',           // +05:30
            'Asia/Kathmandu',         // +05:45
            'Asia/Dhaka',             // +06
            'Asia/Yangon',            // +06:30
            'Asia/Bangkok',           // +07
            'Asia/Macau',             // +08
            'Australia/Eucla',        // +08:45
            'Asia/Tokyo',             // +09
            'Australia/Darwin',       // +09:30
            'Asia/Vladivostok',       // +10
            'Pacific/Pohnpei',        // +11
            'Pacific/Nauru',          // +12
            'Pacific/Fakaofo',        // +13
            'Pacific/Kiritimati',     // +14
        ];

        for($i = 0; $i < count($timezones); $i++) {
            if($request->timezone == $timezones[$i]) {
                $request->timezone = $zone_names[$i];
                break;
            }
        }

        if ($this->is_student()){

            if($file && Auth::user()->image_profile != 'user.jpg') {
                $destinationPath = 'uploads/student/profile/';
                File::delete($destinationPath . Auth::user()->image_profile);
            }

            if($file) {
                $file_name = Str::random(50).'.'.$file->extension();

                $student->user->update([
                    'image_profile' => $file_name,
                ]);

                //Move Uploaded File
                $destinationPath = 'uploads/student/profile/';
                $file->move($destinationPath, $file_name);
            }

            $student->user->update([
                'timezone' => $request->timezone,
            ]);

            return redirect()->route('profile', $student->user->id);
        }

        if($this->is_admin()) {

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
            'email' => ['bail', 'required', Rule::unique('users')->ignore($student->user->id, 'id')],
            'password' => ['bail', 'required', 'min:8'],
            'phone' => ['bail', 'sometimes'],
            'citizenship' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],

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

        if($file) {
            $file_name = Str::random(50).'.'.$file->extension();
        }

            $student->user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'citizenship' => $request->citizenship,
                'image_profile' => ($file)? $file_name : 'user.jpg',
            ]);

            $student->update([
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

            \Session::flash('coba','Update Success !!!');
        } else {
            // Tidak memiliki izin akses.
        }

        return redirect()->route('students.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Student::findOrFail($id);
        if($data == null) {
            // Data yang dicari tidak ditemukan.
            // Return?
        }

        if($this->is_admin() || $this->is_student()) {
            // Menghapus ini akan terhubung dengan model CourseRegistration.
            // Menghapus CourseRegistration terhubung dengan model CourseCertificate, CoursePayment, SessionRegistration.
            // Menghapus CourseCertificate tidak terhubung dengan model lain.
            // Menghapus CoursePayment tidak terhubung dengan model lain.
            // Menghapus SessionRegistration tidak terhubung dengan model lain.
                // SEND CONFIRMATION ALERT FIRST?
            if($data->course_registrations != null) {
                foreach($data->course_registrations as $course_registration) {
                    if($course_registration->course_certificate != null) {
                        $course_registration->course_certificate->delete();
                    }
                    if($course_registration->course_payment != null) {
                        $course_registration->course_payment->delete();
                    }
                    if($course_registration->session_registrations != null) {
                        foreach($course_registration->session_registrations as $session_registration) {
                            $session_registration->delete();
                        }
                    }
                    $course_registration->delete();
                }
            }
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        return redirect()->route('students.index');
    }
}
