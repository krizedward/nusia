<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Course;
use App\Models\CourseLevel;
use App\Models\CoursePackage;
use App\Models\CoursePackageDiscount;
use App\Models\CoursePayment;
use App\Models\CourseRegistration;
use App\Models\CourseType;
use App\Models\Instructor;
use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\MaterialType;
use App\Models\PlacementTest;
use App\Models\Metadata;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\Student;
use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function is_financial_team() {
        return ($this->user_roles() == "Financial Team")? 1 : 0;
    }
    public function is_customer_service() {
        return ($this->user_roles() == "Customer Service")? 1 : 0;
    }
    public function is_lead_instructor() {
        return ($this->user_roles() == "Lead Instructor")? 1 : 0;
    }
    public function is_instructor() {
        return ($this->user_roles() == "Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    /**
     * Memeriksa apakah saat ini website ada dalam mode "Trial" atau "Full Version".
     * Return boolean (1 dan 0).
     */
    public function is_trial() {
        return (Metadata::find(1)->value == 'Trial');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //04.11.2020
        //Membuat Akses Untuk Financial Team
        if ($this->is_financial_team()) {
            return view('dashboard.financial_team_index');
        }

        //Membuat Akses Untuk Customer Service
        if ($this->is_customer_service()) {
            # code...
            return view('dashboard.customer_service_index');
        }

        //03.11.2020
        //Membuat Akses Untuk Lead Instructor
        if ($this->is_lead_instructor()) {
            
            return view('dashboard.lead_instructor_index');
        }

        if($this->is_admin()) {
            //alert
            Alert::success('Success', 'Login Berhasil !!!');
            //$temp_nation = $c->where('name.common', Auth::user()->timezone)->first()->hydrate('timezones')->timezones->first()->zone_name;
            $timeNusia = Carbon::now()->setTimezone('Asia/Jakarta');
            $timeStudent = Carbon::now()->setTimezone(Auth::user()->timezone);
            //$student = Student::paginate(5);
            $student = Student::all();
            //$instructor = Instructor::paginate(5);
            $instructor = Instructor::all();
            //$session = Session::paginate(5);
            $session = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('schedules.schedule_time', '>=', now())
                ->orderBy('schedules.schedule_time')
                /*->take(7)*/
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();

            //$session_reg = SessionRegistration::paginate(5);
            $course = Course::all();
            //return value
            return view('dashboard.admin_index',compact(
                'student','instructor','timeNusia','timeStudent',
                'session', /*'session_reg',*/ 'course'
            ));
        }

        if($this->is_instructor()) {
            $timeNusia = Carbon::now();
            $timeStudent = Carbon::now(Auth::user()->timezone);
            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id_2', 'instructors.id')
                ->join('users', 'instructors.user_id', 'users.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where('schedules.schedule_time', '>=', now())
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at', 'schedules.instructor_id_2', 'users.image_profile')
                ->get();
            $sessions_order_by_schedule_time = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructors', 'schedules.instructor_id_2', 'instructors.id')
                ->join('users', 'instructors.user_id', 'users.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where('schedules.schedule_time', '>=', now())
                ->orderBy('schedules.schedule_time')
                ->take(5)
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at', 'schedules.instructor_id_2', 'users.image_profile')
                ->get();

            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('schedules.instructor_id', Auth::user()->instructor->id)
                ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id)
                ->get();

            $is_local_access = config('database.connections.mysql.username') == 'root';
            return view('dashboard.instructor_index', compact('sessions', 'sessions_order_by_schedule_time', 'timeNusia', 'timeStudent', 'sessions', 'is_local_access'));
        }

        if($this->is_student()) {
            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('layouts.questionnaire');
            } else if(Auth::user()->student->course_registrations->toArray() == null) {
                //return redirect()->route('courses.index'); // KHUSUS UNTUK 1st FREE CLASSES, mungkin ada bug di CLASS PRIVATE DAN/ATAU GROUP.
                return redirect()->route('student.choose_materials');
            } else if(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null) {
                return redirect()->route('student.complete_payment_information', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed') {
                return redirect()->route('student.complete_placement_tests', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null) {
                return redirect()->route('student.complete_course_registrations', [Auth::user()->student->course_registrations->first()->id]);
            }

            //$temp_nation = $c->where('name.common', Auth::user()->timezone)->first()->hydrate('timezones')->timezones->first()->zone_name;
            $timeNusia = Carbon::now()->setTimezone('Asia/Jakarta');
            $timeStudent = Carbon::now()->setTimezone(Auth::user()->timezone);
            //untuk mengubah zona waktu isi didalam dengan lokasi
            $session_registration = SessionRegistration
                ::join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                //->where('schedules.schedule_time', '>=', now())
                ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();
            /*$session = Session
                ::join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('schedules.schedule_time', '>=', now())
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();*/
            $session_order_by_schedule_time = Session
                ::join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('schedules.schedule_time', '>=', now())
                ->orderBy('schedules.schedule_time')
                ->take(5)
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();
            $material = MaterialSession::all();
            $course_registrations = CourseRegistration::where('student_id', Auth::user()->student->id)->get();
            $instructors = Instructor::where('id',Auth::user()->id);
            $is_local_access = config('database.connections.mysql.username') == 'root';
            return view('dashboard.student_index', compact(
                'session_registration', /*session,*/ 'session_order_by_schedule_time',
                'material', 'course_registrations', 'instructors','timeNusia','timeStudent', 'is_local_access'
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

        //$c = (new Countries())->all();
        //$countries = $c->pluck('name.common')->toArray();
        //sort($countries);

        /*$flag = 0;
        foreach($countries as $country) {
            $c_timezones = $c->where('name.common', $country)->first()->hydrate('timezones')->timezones;
            foreach($c_timezones as $c_timezone) {
                foreach($c_timezone['abbreviations'] as $cta) {
                    if($cta == $request->timezone) {
                        $request->timezone = $c_timezone['zone_name'];
                        $flag = 1;
                        $break;
                    }
                }
                if($flag == 1) break;
            }
            if($flag == 1) break;
        }
        if($flag == 0) $request->timezone = null;*/

        $data = $request->all();
        $file = $request->file('image_profile');
        $data = Validator::make($data, [
            'citizenship' => ['bail', 'required'],
            'domicile' => ['bail', 'required'],
            'timezone' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],

            'age' => ['bail', 'required', 'numeric'],
            'status_job' => ['bail', 'required'],
            'status_description' => ['bail', 'required'],
            'interest_1' => ['bail', 'required'],
            'target_language_experience' => ['bail', 'required'],
            'target_language_experience_value' => ['bail', 'required_if:target_language_experience,Others', 'numeric'],
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

        if($file) {
            $file_name = Str::random(50).'.'.$file->extension();
        }

        if($this->is_admin()) {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 'Student',
                'citizenship' => $request->citizenship,
                'domicile' => $request->domicile,
                'timezone' => $request->timezone,
                'image_profile' => ($file)? $file_name : 'user.jpg',
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
                'domicile' => $request->domicile,
                'timezone' => $request->timezone,
                'image_profile'   => $file_name,
            ]);

            //Move Uploaded File
            $destinationPath = 'uploads/student/profile/';
            $file->move($destinationPath, $file_name);
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
                    'domicile' => $request->domicile,
                    'timezone' => $request->timezone,
                    'image_profile'   => 'user.jpg',
                ]);
            }
        }

        return redirect()->route('student.choose_materials');
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
        //04.11.2020
        if( $this->is_admin() || $this->is_instructor() || $this->is_financial_team() ||
            $this->is_lead_instructor() || $this->is_customer_service()) {
            //menampilkan halaman dashboard
            return redirect()->route('home');
        }

        if(Auth::user()->citizenship != 'Not Available') {
            if(Auth::user()->student->course_registrations->toArray() == null) {
                // Jika Student belum terdaftar dalam class manapun,
                // tetapi sudah melakukan pengisian kuisioner.
                // Contoh kasus: Student mengumpulkan kuisioner, kemudian logout, kemudian login lagi.
                //return redirect()->route('courses.index');
                return redirect()->route('student.choose_materials');
            } else if(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null) {
                // Student belum mengisi informasi pembayaran.
                return redirect()->route('student.complete_payment_information', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed') {
                // Student belum mengunggah hasil placement test.
                return redirect()->route('student.complete_placement_tests', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null) {
                // Student sudah mengikuti placement test, tetapi belum memilih jadwal.
                return redirect()->route('student.complete_course_registrations', [Auth::user()->student->course_registrations->first()->id]);
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

        //$c = (new Countries())->all();
        //$countries = $c->pluck('name.common')->toArray();
        //sort($countries);

        $timezones = [
            '-11', '-10', '-09:30', '-09', '-08', '-07',
            '-06', '-05', '-04', '-03', '-02', '-01',
            '+00', '+01', '+02', '+03', '+04', '+04:30', '+05', '+05:30', '+05:45', '+06',
            '+06:30', '+07', '+08', '+08:45', '+09', '+09:30', '+10', '+11', '+12', '+13', '+14',
        ];

        return view('layouts.questionnaire', compact(/*'countries',*/ 'interests', 'timezones'));
    }

    public function choose_materials($id = 0) {
        if($this->is_trial()) {
            $material_types = MaterialType
              ::where('name', 'NOT LIKE', '%Trial%')
              ->get();
            $course_types = CourseType::where('name', 'LIKE', '%Free%')->orWhere('name', 'LIKE', '%Test%')->orWhere('name', 'LIKE', '%Trial%')->get();
            $course_packages = CoursePackage::where('title', 'LIKE', '%Free%')->orWhere('title', 'LIKE', '%Test%')->orWhere('title', 'LIKE', '%Trial%')->get();
            $course_package_discounts = CoursePackageDiscount
                ::join('course_packages', 'course_package_discounts.course_package_id', 'course_packages.id')
                ->where(function($q) {
                    $q
                        ->where('title', 'LIKE', '%Free%')
                        ->orWhere('title', 'LIKE', '%Test%')
                        ->orWhere('title', 'LIKE', '%Trial%');
                })
                ->where('course_package_discounts.due_date', '>', now())
                ->where('course_package_discounts.status', 'Active')
                ->select('course_package_discounts.id', 'course_package_discounts.code', 'course_package_discounts.course_package_id', 'course_package_discounts.price', 'course_package_discounts.description', 'course_package_discounts.due_date', 'course_package_discounts.status', 'course_package_discounts.created_at', 'course_package_discounts.updated_at', 'course_package_discounts.deleted_at')
                ->get();

            $registered_early_classes = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'LIKE', '%Early Registration%')
                ->where(function($q) {
                    $q
                        ->where('course_packages.title', 'LIKE', '%Free%')
                        ->orWhere('course_packages.title', 'LIKE', '%Test%')
                        ->orWhere('course_packages.title', 'LIKE', '%Trial%');
                })
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();

            // Menyimpan daftar course_registrations yang memiliki jadwal sesi yang belum berjalan.
            // Query ini menghilangkan daftar course_registrations yang sudah SEPENUHNYA selesai.
            // Hal ini dilakukan untuk mengganti button pada material_type
            // yang masih belum dapat didaftarkan oleh Student, karena ada course yang masih dihadiri.
            $all_current_running_course_registrations = Schedule
                ::join('sessions', 'schedules.id', 'sessions.schedule_id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where(function($q) {
                    $q
                        ->where('course_packages.title', 'LIKE', '%Free%')
                        ->orWhere('course_packages.title', 'LIKE', '%Test%')
                        ->orWhere('course_packages.title', 'LIKE', '%Trial%');
                })
                ->where('schedules.schedule_time', '>', now())
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->distinct()
                ->get();

            // Menyimpan daftar course_registrations yang bersifat "Not Registered".
            // Hal ini dilakukan untuk mengetahui daftar course yang berstatus masih dalam proses pendaftaran.
            $all_not_completely_registered_courses = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where(function($q) {
                    $q
                        ->where('course_packages.title', 'LIKE', '%Free%')
                        ->orWhere('course_packages.title', 'LIKE', '%Test%')
                        ->orWhere('course_packages.title', 'LIKE', '%Trial%');
                })
                ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
                ->where('course_packages.title', 'LIKE', '%Not Assigned%')
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();
        } else {
            $material_types = MaterialType
              ::where('name', 'NOT LIKE', '%Trial%')
              ->get();
            $course_types = CourseType
                ::where('name', 'NOT LIKE', '%Free%')
                ->where('name', 'NOT LIKE', '%Test%')
                ->where('name', 'NOT LIKE', '%Trial%')
                ->where('name', 'NOT LIKE', '%Not Assigned%')
                ->get();
            $course_packages = CoursePackage
                ::where('title', 'NOT LIKE', '%Free%')
                ->where('title', 'NOT LIKE', '%Test%')
                ->where('title', 'NOT LIKE', '%Trial%')
                ->where('title', 'NOT LIKE', '%Not Assigned%')
                ->where('title', 'NOT LIKE', '%Early Registration%')
                ->get();
            $course_package_discounts = CoursePackageDiscount
                ::join('course_packages', 'course_package_discounts.course_package_id', 'course_packages.id')
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
                ->where('course_package_discounts.due_date', '>', now())
                ->where('course_package_discounts.status', 'Active')
                ->select('course_package_discounts.id', 'course_package_discounts.code', 'course_package_discounts.course_package_id', 'course_package_discounts.price', 'course_package_discounts.description', 'course_package_discounts.due_date', 'course_package_discounts.status', 'course_package_discounts.created_at', 'course_package_discounts.updated_at', 'course_package_discounts.deleted_at')
                ->get();

            $registered_early_classes = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'LIKE', '%Early Registration%')
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();

            // Menyimpan daftar course_registrations yang memiliki jadwal sesi yang belum berjalan.
            // Query ini menghilangkan daftar course_registrations yang sudah SEPENUHNYA selesai.
            // Hal ini dilakukan untuk mengganti button pada material_type
            // yang masih belum dapat didaftarkan oleh Student, karena ada course yang masih dihadiri.
            $all_current_running_course_registrations = Schedule
                ::join('sessions', 'schedules.id', 'sessions.schedule_id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('schedules.schedule_time', '>', now())
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->distinct()
                ->get();

            // Menyimpan daftar course_registrations yang bersifat "Not Registered".
            // Hal ini dilakukan untuk mengetahui daftar course yang berstatus masih dalam proses pendaftaran.
            $not_completed_registrations = [];
            $not_assigned_registrations = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
                ->where('course_packages.title', 'LIKE', '%Not Assigned%')
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();
            foreach($registered_early_classes as $rec)
                if($rec->session_registrations->toArray() == null)
                    array_push($not_completed_registrations, $rec->id);
            foreach($not_assigned_registrations as $nar)
                array_push($not_completed_registrations, $nar->id);
            $all_not_completely_registered_courses = CourseRegistration
                ::whereIn('course_registrations.id', $not_completed_registrations)
                ->get();
        }

        if($id > 0) {
            $current_course_registration = CourseRegistration
                ::where('student_id', Auth::user()->student->id)
                ->where('id', $id)
                ->first();
            // URI dapat diganti oleh Student.
            // Apabila diganti ke ID selain course yang terdaftar, redirect ke route ini.
            if($current_course_registration == null) {
                return redirect()->route('student.choose_materials');
            }
            $current_course_registration = $current_course_registration->id;
            // LANJUTKAN DARI KODE INI (apa lagi ya yang perlu ditambahkan?)
        } else if($id == -1) {
            // Jika Student memilih untuk mendaftar course baru,
            // selain daftar course yang sudah/sedang didaftarkan sebelumnya.
            // GANTI KODE DI BAGIAN INI DENGAN KODE YANG SESUAI.
            $current_course_registration = -1;
        } else {
            if($all_not_completely_registered_courses->count() == 0) {
                // Jika Student BELUM/TIDAK melakukan pendaftaran dalam course manapun,
                // ubah nilai $current_course_registration menjadi -1.
                $current_course_registration = -1;
            } else {
                // Jika Student SUDAH pernah mendaftar course sebelumnya,
                // (dan mungkin pendaftaran belum/tidak dilanjutkan hingga selesai),
                // ubah nilai $current_course_registration menjadi 0 (tampilkan format view tabel).
                $current_course_registration = 0;
            }
        }

        return view('registrations.student_choose_materials', compact(
            'material_types', 'course_types', 'course_packages', 'course_package_discounts',
            'current_course_registration',
            'registered_early_classes', 'all_current_running_course_registrations', 'all_not_completely_registered_courses'
        ));
    }

    public function store_materials(Request $request) {
        // LANGKAH 1: Apakah User sudah melakukan login pada waktu mengirim request?
        // Jika User belum login (atau sesi login telah berakhir), lakukan redirect ke GET method.
        if(!Auth::check()) {
            return redirect()->route('student.choose_materials');
        }

        // LANGKAH 2: Apakah sebelumnya Student pernah mendaftar course "lain" pada material yang sama?
        //            Apabila "ya", maka tidak diperbolehkan mendaftar pada material tersebut.
        $not_assigned_course_registrations = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('course_packages.title', 'LIKE', '%Not Assigned%')
            ->where('course_packages.material_type_id', $request->choice_mt)
            ->count();
        if($not_assigned_course_registrations > 0) {
            // Jika Student sudah melakukan pendaftaran satu (atau lebih) course "lain"
            // pada material type yang sama, selain pendaftaran course yang ini.

            // Tambahkan penjelasan dalam bentuk pesan error, bahwa
            // sudah ada course terdaftar pada jenis materi tersebut, yang juga belum dialokasikan.
            session(['error_message' => 'You cannot register in two classes with same material type. Please choose another.']);

            return redirect()->back();
        }

        // LANGKAH 3: Apakah Student memilih ID yang sesuai dengan ID yang ditampilkan pada layar?
        // Bagaimana jika ID yang dimasukkan sudah diedit pada inspect elements, pada value input?
        // Berikut daftar ID yang diperbolehkan untuk melanjutkan ke langkah berikutnya.
        // Pengeditan array dilakukan secara MANUAL.
        $arr_available = [7, 16, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39];
        if(!in_array($request->choice, $arr_available)) {
            return redirect()->route('student.choose_materials');
        }

        // LANGKAH 4: Berikut course package yang dipilih untuk didaftarkan.
        //            Data $current_course_package digunakan untuk mencari course_package_id yang
        //            sesuai untuk placement test, dan diubah dalam data $new_course_package.
        $current_course_package = CoursePackage::find($request->choice);

        // LANGKAH 5: Apakah Student sudah mendaftar dalam early class?
        //            Satu material type memberikan 1 bonus early class untuk masing-masing Student.
        $early_classes_registration = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('course_packages.title', 'LIKE', '%Early Registration%')
            ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
            ->get();
        /*$early_classes_not_accepted_registration = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->join('placement_tests', 'course_registrations.id', 'placement_tests.course_registration_id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('course_packages.title', 'LIKE', '%Early Registration%')
            ->where('placement_tests.status', 'Not Passed')
            ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
            ->get();*/
        // Simpan keterangan apakah Student sudah mendaftar pada early classes dengan material sama.
        $have_early_classes_for_same_material_type = 0;
        // Untuk semua early classes.
        foreach($early_classes_registration as $ecr) {
            // Apabila sudah ada pendaftaran pada material type yang sama.
            if($ecr->course->course_package->material_type_id == $request->choice_mt) {
                // Maka, tidak diperbolehkan mendaftar pada early class di material type yang sama.
                // MAKA, DAFTARKAN COURSE INI SEBAGAI COURSE YANG SIAP BERBAYAR.
                $have_early_classes_for_same_material_type = 1;
                
                // Jika terdaftar pada early class dengan material sama,
                // maka Student perlu bergabung dalam course berbayar.
                // Setelah mengetahui hal ini, tidak diperlukan iterasi kembali.
                break;
            }
        }

        // LANGKAH 6: Apakah Student mengakses website mode "Trial" atau "Full Version"?
        //            Sesuaikan new course package apa yang akan diambil.
        if($this->is_trial()) {
            if($current_course_package->material_type->name == 'Cultural Classes') {
                $new_course_package = CoursePackage
                    ::where(function($q) {
                        $q
                            ->where('title', 'LIKE', '%Free%')
                            ->orWhere('title', 'LIKE', '%Test%')
                            ->orWhere('title', 'LIKE', '%Trial%');
                    })
                    ->where('title', 'LIKE', '%Not Assigned%')
                    ->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')
                    ->where('title', 'LIKE', '%'.$current_course_package->title.'%')
                    ->first();
            } else {
                $new_course_package = CoursePackage
                    ::where(function($q) {
                        $q
                            ->where('title', 'LIKE', '%Free%')
                            ->orWhere('title', 'LIKE', '%Test%')
                            ->orWhere('title', 'LIKE', '%Trial%');
                    })
                    ->where('title', 'LIKE', '%Not Assigned%')
                    ->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')
                    ->first();
            }
        } else {
            if($current_course_package->material_type->name == 'Cultural Classes') {
                $new_course_package = CoursePackage
                    ::where('title', 'NOT LIKE', '%Free%')
                    ->where('title', 'NOT LIKE', '%Test%')
                    ->where('title', 'NOT LIKE', '%Trial%')
                    ->where('title', 'LIKE', '%Not Assigned%')
                    ->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')
                    ->where('title', 'LIKE', '%'.$current_course_package->title.'%')
                    ->first();
            } else {
                $new_course_package = CoursePackage
                    ::where('title', 'NOT LIKE', '%Free%')
                    ->where('title', 'NOT LIKE', '%Test%')
                    ->where('title', 'NOT LIKE', '%Trial%')
                    ->where('title', 'LIKE', '%Not Assigned%')
                    ->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')
                    ->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')
                    ->first();
            }
        }

        // LANGKAH 7: Apabila Student belum pernah memilih jenis course sebelumnya,
        //            maka dibuat course registration baru. Otherwise, update course registration lama,
        //            sesuai course yang diganti oleh Student tersebut (selama dapat diganti).
        $new_course_registration_id = -1;
        if($request->older_choice == 0 || $request->older_choice == -1) {
            // Apabila Student belum pernah memilih jenis course sebelumnya,
            // maka buat course registration baru.
            CourseRegistration::create([
                'course_id' => Course::create([
                    'course_package_id' => $new_course_package->id,
                    'title' => 'Not Assigned Course - ' . $current_course_package->material_type->name . ' - ' . $current_course_package->course_type->name,
                ])->id,
                'student_id' => Auth::user()->student->id,
            ]);
            $new_course_registration_id = CourseRegistration
              ::where('student_id', Auth::user()->student->id)
              ->get()->last()->id;
        } else {
            // Apabila Student sudah pernah memilih jenis course sebelumnya, maka update kelas Course,
            // ubah course_package_id dengan ID baru yang telah dipilih.
            Course
                ::join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_registrations.id', $request->older_choice)
                ->where('course_packages.title', 'LIKE', '%Not Assigned%')
                ->select('courses.id', 'courses.course_package_id', 'courses.title')
                ->first()
                ->update([
                    'course_package_id' => $new_course_package->id,
                    'title' => 'Not Assigned Course - ' . $current_course_package->material_type->name . ' - ' . $current_course_package->course_type->name,
                ]);
            $new_course_registration_id = $request->older_choice;
        }

        // LANGKAH 8: Apabila Student sudah mendaftar dalam early class,
        //            maka Student perlu mengisi formulir pembayaran. Otherwise, "no" (or, "skip").
        if($have_early_classes_for_same_material_type) {
            // Jika Student sudah pernah mendaftar early class pada material type ini.
            // Maka, arahkan ke formulir pembayaran.
            return redirect()->route('student.complete_payment_information', [$new_course_registration_id]);
        } else {
            // Jika Student belum pernah mendaftar early class pada material type ini.
            // Maka, skip formulir pembayaran (tambah course payment dengan harga 0).
            CoursePayment::create([
                'course_registration_id' => $new_course_registration_id,
                'payment_type_id' => 1,
                'payment_time' => now(),
                'amount' => 0,
                'status' => 'Confirmed',
            ]);

            // Selanjutnya, arahkan ke pelaksanaan placement test.
            return redirect()->route('student.complete_placement_tests', [$new_course_registration_id]);
        }
    }

    public function complete_payment_information($course_registration_id) {
        // Fungsi ini hanya dapat diakses oleh Student
        // yang sudah pernah mendaftar dalam material type yang sama (sebelumnya).
        // Sehingga memasuki fungsi ini, sistem early registration (1 sesi trial) tidak berlaku.

        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();

        return view('registrations.student_complete_payment_information', compact(
            'course_registration'
        ));
    }

    public function store_payment_information(Request $request, $course_registration_id) {
        //
    }

    public function upload_payment_evidence($course_registration_id) {
        //
    }

    public function update_payment_evidence(Request $request, $course_registration_id) {
        //
    }

    public function complete_placement_tests($course_registration_id) {
        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();

        // Simpan nilai status placement test Student.
        $has_uploaded_for_placement_test = 0;

        if($course_registration->placement_test == null) {
            // Jika data placement test belum dibuat sama sekali, arahkan ke halaman placement test,
            // sehingga Student dapat mengunggah hasil placement test.
            $has_uploaded_for_placement_test = 0;
        } else if($course_registration->placement_test->status == 'Not Passed') {
            // Jika hasil test masih 'Not Passed' (entah sudah diunggah atau belum).
            if($course_registration->placement_test->path == null) {
                // Jika hasil test BELUM/TIDAK DIUNGGAH,
                // atau ditolak oleh Lead Instructor,
                // Student dapat mengunggah hasil placement test [berikutnya].
                $has_uploaded_for_placement_test = 0;
            } else {
                // Jika hasil test sudah diunggah tetapi masih 'Not Passed', tampilkan halaman "waiting".
                $has_uploaded_for_placement_test = 1;
            }
        } else if($course_registration->placement_test->status == 'Passed') {
            // Jika hasil test sudah diunggah dan 'Passed', redirect ke langkah berikutnya.
            return redirect()->route('student.complete_course_registrations', [$course_registration->id]);
        }

        // Halaman "upload-enabled" dan "waiting" digabungkan dalam satu view yang sama,
        // dipisahkan menggunakan seleksi nilai pada variabel $has_uploaded_for_placement_test.
        return view('registrations.student_complete_placement_tests', compact(
            'course_registration', 'has_uploaded_for_placement_test'
        ));
    }

    public function store_placement_tests(Request $request, $course_registration_id) {
        // Melakukan validasi apakah link yang digunakan adalah secure https?
        $has_valid_link = (strpos($request->video_link, 'https://') !== false);

        $data = $request->all();
        if($has_valid_link) {
            // jika link valid, lanjutkan proses.
        } else {
            // jika link tidak valid, sesuaikan pada validasi 'url' untuk di-redirect (fail) ke view.
            $data['video_link'] = 'invalid url';
        }
        $data = Validator::make($data, [
            'video_link' => ['bail', 'required', 'url'],
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        // Untuk valid link.

        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();

        // Jika sebelumnya model PlacementTest belum/tidak dibuat dalam course_registration ini.
        if($course_registration->placement_test == null) {
            // Buat model baru dalam course_registration ini.
            PlacementTest::create([
                'course_registration_id' => $course_registration_id,
                'path' => $request->video_link,
                'status' => 'Not Passed',
                'submitted_at' => now(),
            ]);
        } else {
            // Update model yang sudah ada dalam course_registration ini.
            $course_registration->placement_test->update([
                'path' => $request->video_link,
                'submitted_at' => now(),
                'result_updated_at' => null,
            ]);
        }

        return redirect()->route('student.complete_placement_tests', [$course_registration_id]);
    }

    public function complete_course_registrations($course_registration_id) {
        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();

        // ...
        dd('Passed');
    }

    public function update_course_registrations(Request $request, $course_registration_id) {
        //
    }

    public function profile()
    {
        // Berpindah ke ProfileController.
    }

    public function contact()
    {
        return view('layouts.contact');
    }

    public function landing_page()
    {
        return view('index');
    }
}
