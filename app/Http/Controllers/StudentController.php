<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\CourseLevel;
use App\Models\CoursePackage;
use App\Models\CoursePackageDiscount;
use App\Models\CoursePayment;
use App\Models\CourseRegistration;
use App\Models\CourseType;
use App\Models\CourseTypeValue;
use App\Models\EconomyFlag;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
use App\Models\FormResponse;
use App\Models\FormResponseDetail;
use App\Models\Instructor;
use App\Models\InstructorSchedule;
use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\MaterialType;
use App\Models\MaterialTypeValue;
use App\Models\Message;
use App\Models\Metadata;
use App\Models\Notification;
use App\Models\NotificationDuration;
use App\Models\NotificationLabel;
use App\Models\OtherUser;
use App\Models\PlacementTest;
use App\Models\Rating;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\UserNotification;

use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

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
        return ($this->user_roles() == "Instructor"
            || $this->user_roles() == "Lead Instructor")? 1 : 0;
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

    public function student_registration_form_index()
    {
        // mendaftar course: mengisi formulir registrasi student
        //28.02.2021
        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

        if(Auth::user()->citizenship != 'Not Available') {
            if(Auth::user()->student->course_registrations->toArray() == null) {
                return redirect()->route('student.choose_course.index');
            } else if(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null) {
                return redirect()->route('student.complete_payment_information.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->course_payments->last()->status != 'Confirmed') {
                return redirect()->route('student.upload_payment_evidence.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed') {
                return redirect()->route('student.upload_placement_test.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null) {
                return redirect()->route('student.choose_course_registration.show', [Auth::user()->student->course_registrations->first()->id]);
            }
            return redirect()->route('registered.dashboard.index');
        }

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
        
        /*$countries = new Countries();
        $countries = $countries->all();
        $arr_countries = $countries->pluck('name.common')->toArray();
        $arr_provinces = [];
        foreach($arr_countries as $ac) {
            $country = $countries->where('name.common', $ac)->first();
            $provinces = $country->hydrateStates()->states->pluck('name')->toArray();
            foreach($provinces as $p)
                if($p != null && !in_array($ac . ' - ' . $p, $arr_provinces))
                    // menghindari provinsi bernilai null dan nilai duplikat
                    array_push($arr_provinces, $ac . ' - ' . $p);
            sort($arr_provinces);
        }*/
        $arr_provinces = EconomyFlag::all()->pluck('name')->toArray();
        
        return view('role_student.registration_01_questionnaire', compact('interests', 'timezones', /*'arr_countries',*/ 'arr_provinces'));
    }

    public function student_registration_form_update(Request $request, $user_id)
    {
        // mendaftar course: mengisi formulir registrasi student
        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
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

        $data = $request->all();
        $file = $request->file('image_profile');
        $data = Validator::make($data, [
            'citizenship' => ['bail', 'required'],
            'domicile' => ['bail', 'required'],
            'timezone' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],

            'age' => ['bail', 'required', 'numeric', 'min:7'],
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

        // sesuaikan input ke DB dengan opsi yang dipilih user.
        // input yang tidak sesuai harapan dihapus di bagian ini.
        if($request->target_language_experience == 'Never (no experience)') {
            $request->target_language_experience_value = null;
            $request->description_of_course_taken = null;
        } else if($request->target_language_experience == '< 6 months') {
            $request->target_language_experience_value = null;
        } else if($request->target_language_experience == '<= 1 year') {
            $request->target_language_experience_value = null;
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
                'economy_flag_id' => EconomyFlag::where('name', $request->domicile)->first()->id,
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
                    'economy_flag_id' => EconomyFlag::where('name', $request->domicile)->first()->id,
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

        return redirect()->route('student.choose_course.index');
    }

    public function choose_course_index($course_registration_id = 0)
    {
        // mendaftar course: memilih jenis course
        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

            $material_types = MaterialType
              ::where('name', 'NOT LIKE', '%Trial%')
              ->get();
            $course_types = CourseType
                ::where('name', 'NOT LIKE', '%Free%')
                ->where('name', 'NOT LIKE', '%Test%')
                ->where('name', 'NOT LIKE', '%Trial%')
                /*->where('name', 'NOT LIKE', '%Not Assigned%')*/
                ->get();
            $course_packages = CoursePackage
                ::where('title', 'NOT LIKE', '%Free%')
                ->where('title', 'NOT LIKE', '%Test%')
                ->where('title', 'NOT LIKE', '%Trial%')
                /*->where('title', 'NOT LIKE', '%Not Assigned%'*/
                /*->where('title', 'NOT LIKE', '%Early Registration%')*/
                ->get();
            $course_package_discounts = CoursePackageDiscount
                ::join('course_packages', 'course_package_discounts.course_package_id', 'course_packages.id')
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                /*->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')*/
                /*->where('course_packages.title', 'NOT LIKE', '%Early Registration%')*/
                ->where('course_package_discounts.due_date', '>', now())
                ->where('course_package_discounts.status', 'Active')
                ->select('course_package_discounts.*')
                ->get();
            
            /*$registered_early_classes = CourseRegistration
                ::join('courses', 'course_registrations.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'LIKE', '%Early Registration%')
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->get();*/
            
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
                /*->join('course_packages', 'courses.course_package_id', 'course_packages.id')*/
                ->where('course_registrations.student_id', Auth::user()->student->id)
                /*->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')*/
                ->where('courses.title', 'LIKE', '%Not Assigned%')
                ->select('course_registrations.*')
                ->get();
            /*foreach($registered_early_classes as $rec)
                if($rec->session_registrations->toArray() == null)
                    array_push($not_completed_registrations, $rec->id);*/
            foreach($not_assigned_registrations as $nar)
                array_push($not_completed_registrations, $nar->id);
            $all_not_completely_registered_courses = CourseRegistration
                ::whereIn('course_registrations.id', $not_completed_registrations)
                ->get();

        if($course_registration_id > 0) {
            $current_course_registration = CourseRegistration
                ::where('student_id', Auth::user()->student->id)
                ->where('id', $course_registration_id)
                ->first();
            $current_course_registration_data = CourseRegistration
                ::where('student_id', Auth::user()->student->id)
                ->where('id', $course_registration_id)
                ->first();
            if($current_course_registration == null) {
                // URI dapat diganti oleh Student.
                // Apabila diganti ke ID selain course yang terdaftar, redirect ke route ini.
                return redirect()->route('registered.dashboard.index');
            } else if($current_course_registration->course_payments->toArray() != null) {
                // Jika informasi pendaftaran course tsb sudah dikonfirmasi tidak dapat diubah,
                // maka lakukan redirect ke route ini.
                return redirect()->route('registered.dashboard.index');
            }
            $current_course_registration = $current_course_registration->id;
            // LANJUTKAN DARI KODE INI (apa lagi ya yang perlu ditambahkan?)
        } else if($course_registration_id == -1) {
            // Jika Student memilih untuk mendaftar course baru,
            // selain daftar course yang sudah/sedang didaftarkan sebelumnya.
            // GANTI KODE DI BAGIAN INI DENGAN KODE YANG SESUAI.
            $current_course_registration_data = null;
            $current_course_registration = -1;
        } else if($course_registration_id == 0) {
            $current_course_registration_data = null;
            if($all_not_completely_registered_courses->count() == 0) {
                // Jika Student BELUM/TIDAK SEDANG melakukan pendaftaran dalam course manapun,
                // ubah nilai $current_course_registration menjadi -1.
                $current_course_registration = -1;
            } else {
                // Jika Student SUDAH pernah mendaftar course sebelumnya,
                // (dan mungkin pendaftaran belum/tidak dilanjutkan hingga selesai),
                // ubah nilai $current_course_registration menjadi 0 (tampilkan format view tabel).
                $current_course_registration = 0;
            }
        } else {
            // Jika Student melakukan pengeditan di inspect elements
            // (nilai parameter negatif selain -1),
            // maka lakukan redirect ke route ini.
            return redirect()->route('registered.dashboard.index');
        }
                
        return view('role_student.registration_02_choose_materials', compact(
            'material_types', 'course_types', 'course_packages', 'course_package_discounts',
            'current_course_registration', 'current_course_registration_data', /*'registered_early_classes',*/
            'all_current_running_course_registrations', 'all_not_completely_registered_courses'
        ));
    }

    public function choose_course_store(Request $request)
    {
        // mendaftar course: memilih jenis course
        // LANGKAH 1: Apakah User sudah melakukan login pada waktu mengirim request?
        // Jika User belum login (atau sesi login telah berakhir), lakukan redirect ke GET method.
        // Hal ini dilakukan untuk menghindari display pesan error oleh sistem (for security).
        if(!Auth::check()) {
            return redirect()->route('student.choose_course.index');
        }
        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

        // LANGKAH 2: Apakah Student memilih ID yang sesuai dengan ID yang ditampilkan pada layar?
        // Bagaimana jika ID yang dimasukkan sudah diedit pada inspect elements, pada value input?
        // Berikut daftar ID yang diperbolehkan untuk melanjutkan ke langkah berikutnya.
        // Pengeditan array dilakukan secara MANUAL.
        $arr_available = [
            15, 24, 25, 26, 27, 28, 29, 30, 31, 32,
            33, 34, 35, 36, 37, 38, 39, 58, 59, 60,
            94, 95, 96, 99, 102, 103, 104, 105]; // 28 types
        if(!in_array($request->choice, $arr_available)) {
            session(['error_message' => 'You are not allowed to choose this course type. Please contact us for more information.']);
            return redirect()->route('student.choose_course.index', [$request->older_choice]);
        }

        // LANGKAH 3: Berikut course package yang dipilih untuk didaftarkan.
        //            Data $current_course_package digunakan untuk mencari course_package_id yang
        //            sesuai untuk placement test, dan diubah dalam data $new_course_package.
        $current_course_package = CoursePackage::find($request->choice);
        
        // LANGKAH 4: Sesuaikan new course package apa yang akan diambil.
            //if($current_course_package->material_type->name == 'Indonesian Culture') {
                //$new_course_package = CoursePackage
                //    ::where('title', 'NOT LIKE', '%Free%')
                //    ->where('title', 'NOT LIKE', '%Test%')
                //    ->where('title', 'NOT LIKE', '%Trial%')
                    /*->where('title', 'LIKE', '%Not Assigned%')*/
                    /*->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')*/
                    /*->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')*/
                //    ->where('title', 'LIKE', '%'.$current_course_package->title.'%')
                //    ->first();
            //} else {
                //$new_course_package = CoursePackage
                //    ::where('title', 'NOT LIKE', '%Free%')
                //    ->where('title', 'NOT LIKE', '%Test%')
                //    ->where('title', 'NOT LIKE', '%Trial%')
                    /*->where('title', 'LIKE', '%Not Assigned%')*/
                //    ->where('title', 'LIKE', '%'.$current_course_package->material_type->name.'%')
                //    ->where('title', 'LIKE', '%'.ucwords(strtolower($current_course_package->course_type->name)).'%')
                //    ->first();
            //}
            if($current_course_package->id == 99) {
                // Seleksi untuk class for young and teenage learners (private).
                if(Auth::user()->student->age >= 7 && Auth::user()->student->age <= 11) {
                    $new_course_package = CoursePackage::find(97);
                } else if(Auth::user()->student->age >= 12 && Auth::user()->student->age <= 14) {
                    $new_course_package = CoursePackage::find(98);
                } else if(Auth::user()->student->age >= 15 && Auth::user()->student->age <= 17) {
                    $new_course_package = $current_course_package;
                } else {
                    // Jika Student berusia di atas 17 tahun,
                    // maka tidak diperkenankan mengikuti course ini.
                    session(['error_message' => 'You are not eligible to choose this course type. Please contact us for more information.']);
                    return redirect()->route('student.choose_course.index', [$request->older_choice]);
                }
            } else if($current_course_package->id == 102) {
                // Seleksi untuk class for young and teenage learners (group).
                if(Auth::user()->student->age >= 7 && Auth::user()->student->age <= 11) {
                    $new_course_package = CoursePackage::find(100);
                } else if(Auth::user()->student->age >= 12 && Auth::user()->student->age <= 14) {
                    $new_course_package = CoursePackage::find(101);
                } else if(Auth::user()->student->age >= 15 && Auth::user()->student->age <= 17) {
                    $new_course_package = $current_course_package;
                } else {
                    // Jika Student berusia di atas 17 tahun,
                    // maka tidak diperkenankan mengikuti course ini.
                    session(['error_message' => 'You are not eligible to choose this course type. Please contact us for more information.']);
                    return redirect()->route('student.choose_course.index', [$request->older_choice]);
                }
            } else {
                // Untuk tipe course lain, course package tidak diubah.
                $new_course_package = $current_course_package;
            }

        // LANGKAH 5: Apakah sebelumnya Student pernah mendaftar course "lain" pada material yang sama?
        //            Apabila "ya", maka tidak diperbolehkan mendaftar pada material tersebut.
        $not_assigned_course_registrations = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('courses.title', 'LIKE', '%Not Assigned%')
            ->where('course_packages.material_type_id', $request->choice_mt)
            ->where('course_registrations.id', '<>', $request->older_choice)
            ->count();
        if($not_assigned_course_registrations > 0) {
            // Jika Student sudah melakukan pendaftaran satu (atau lebih) course "lain"
            // pada material type yang sama, selain pendaftaran course yang ini,
            // maka tambahkan penjelasan dalam bentuk pesan error, bahwa
            // sudah ada course terdaftar pada jenis materi tersebut, yang juga belum dialokasikan.
            // Mengapa $not_assigned_course_registrations > 1 ?
            // Karena 
            session(['error_message' => 'You cannot register in two same courses at a time. Please choose another.']);
            return redirect()->back();
        }
        
        // LANGKAH 6: Apabila Student belum pernah memilih jenis course sebelumnya,
        //            maka dibuat course registration baru. Otherwise, update course registration lama,
        //            sesuai course yang diganti oleh Student tersebut (selama dapat diganti).
        $new_course_registration_id = -1;
        if($request->older_choice == -1) {
            // Apabila Student belum pernah memilih jenis course sebelumnya,
            // maka buat course registration baru.
            CourseRegistration::create([
                'course_id' => Course::create([
                    'code' => $request->promo_code,
                    'course_package_id' => $new_course_package->id,
                    'title' => 'Not Assigned Course - ' . $new_course_package->material_type->name . ' - ' . $new_course_package->course_type->name,
                ])->id,
                'student_id' => Auth::user()->student->id,
            ]);
            $new_course_registration_id = CourseRegistration
              ::where('student_id', Auth::user()->student->id)
              ->get()->last()->id;
        } else if($request->older_choice > 0 && in_array($request->choice, $arr_available)) {
            // Apabila Student sudah pernah memilih jenis course sebelumnya, maka update kelas Course,
            // ubah course_package_id dengan ID baru yang telah dipilih.
            Course
                ::join('course_registrations', 'courses.id', 'course_registrations.course_id')
                /*->join('course_packages', 'courses.course_package_id', 'course_packages.id')*/
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_registrations.id', $request->older_choice)
                ->where('courses.title', 'LIKE', '%Not Assigned%')
                ->select('courses.id', 'courses.requirement', 'courses.course_package_id', 'courses.title')
                ->first()
                ->update([
                    'course_package_id' => $new_course_package->id,
                    'title' => 'Not Assigned Course - ' . $new_course_package->material_type->name . ' - ' . $new_course_package->course_type->name,
                    'requirement' => $request->promo_code,
                ]);
            $new_course_registration_id = $request->older_choice;
        } else {
            // Jika dilakukan perubahan via inspect elements, maka lakukan redirect.
            session(['error_message' => 'You are not allowed to choose this course type. Please contact us for more information.']);
            return redirect()->route('student.choose_course.index');
        }

        // LANGKAH 7: Apabila Student sedang mendaftar dalam class berbayar?
        //            Jika ya, maka Student perlu mengisi formulir pembayaran. Otherwise, "no" (or, "skip").
        if($request->is_paid == '1') {
            // Jika Student sedang mendaftar dalam class berbayar untuk material type ini.
            // Maka, arahkan ke formulir pembayaran.
            return redirect()->route('student.complete_payment_information.show', [$new_course_registration_id]);
        } else {
            // Jika Student sedang mendaftar dalam class gratis pada material type ini.
            // Maka, skip formulir pembayaran (tambah course payment dengan harga 0).
            CoursePayment::create([
                'course_registration_id' => $new_course_registration_id,
                'payment_type_id' => 1,
                'payment_time' => now(),
                'amount' => 0,
                'status' => 'Confirmed',
            ]);

            // Selanjutnya, arahkan ke pelaksanaan placement test.
            return redirect()->route('student.upload_placement_test.show', [$new_course_registration_id]);
        }
    }

    public function complete_payment_information_show($course_registration_id)
    {
        // mendaftar course: melengkapi informasi pembayaran

        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }
        
        // Fungsi ini hanya dapat diakses oleh Student
        // yang sudah pernah mendaftar dalam material type yang sama (sebelumnya).
        // Sehingga memasuki fungsi ini, sistem early registration (1 sesi trial) tidak berlaku.
        
        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration
            ::where('student_id', Auth::user()->student->id)
            ->where('id', $course_registration_id)->get()->first();
        
        if($course_registration == null) {
            // Jika informasi pendaftaran diubah oleh Student melalui URI,
            // maka lakukan redirect ke route ini.
            return redirect()->route('registered.dashboard.index');
        } else if($course_registration->course_payments->toArray() != null) {
            // Jika informasi pendaftaran course tsb sudah dikonfirmasi tidak dapat diubah,
            // maka lakukan redirect ke route ini.
            return redirect()->route('registered.dashboard.index');
        }
        
        return view('role_student.registration_03_complete_payment_information', compact(
            'course_registration'
        ));
    }

    public function complete_payment_information_update(Request $request, $course_registration_id)
    {
        // mendaftar course: melengkapi informasi pembayaran

        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration
            ::where('student_id', Auth::user()->student->id)
            ->where('id', $course_registration_id)->get()->first();
        
        // Jika informasi pendaftaran diubah oleh Student melalui URI,
        // maka lakukan redirect ke halaman pemilihan daftar course.
        if($course_registration == null) {
            return redirect()->route('student.choose_course.index');
        }

        if(CoursePayment::where('course_registration_id', $course_registration_id)->first() == null) {
            CoursePayment::create([
                'course_registration_id' => $course_registration_id,
                'payment_type_id' => 1,
                'payment_time' => null,
                'amount' => 0,
                'status' => 'Not Confirmed',
            ]);
        }

        return redirect()->route('student.upload_payment_evidence.show', [$course_registration_id]);
    }

    public function upload_payment_evidence_show($course_registration_id)
    {
        // mendaftar course: mengirim bukti pembayaran

        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration
            ::where('student_id', Auth::user()->student->id)
            ->where('id', $course_registration_id)->get()->first();
        
        // Jika informasi pendaftaran diubah oleh Student melalui URI,
        // maka lakukan redirect ke halaman pemilihan daftar course.
        if($course_registration == null) {
            return redirect()->route('student.choose_course.index');
        }
        if($course_registration->course_payments->toArray() == null) {
            return redirect()->route('student.choose_course.index');
        }

        if($course_registration->course_payments->last()->status == 'Confirmed') {
            // Jika pembayaran Student dalam course ybs telah dikonfirmasi sesuai,
            // maka lakukan redirect ke halaman placement test.
            return redirect()->route('student.upload_placement_test.show', [$course_registration_id]);
        } else if($course_registration->course_payments->last()->path != null) {
            // Jika pembayaran Student dalam course ybs telah dilakukan
            // tetapi belum atau tidak dikonfirmasi, tampilkan halaman menunggu.
            $is_waiting_for_confirmation = 1;
        } else $is_waiting_for_confirmation = 0;
        
        return view('role_student.registration_04_upload_payment_evidence', compact(
            'course_registration', 'is_waiting_for_confirmation',
        ));
    }

    public function upload_payment_evidence_update(Request $request, $course_registration_id)
    {
        // mendaftar course: mengirim bukti pembayaran

        if(!$this->is_student()) {
            //menampilkan halaman dashboard
            return redirect()->route('registered.dashboard.index');
        }

        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration
            ::where('student_id', Auth::user()->student->id)
            ->where('id', $course_registration_id)->get()->first();
        
        // Jika informasi pendaftaran diubah oleh Student melalui inspect elements,
        // maka lakukan redirect ke halaman pemilihan daftar course.
        if($course_registration == null) {
            return redirect()->route('student.choose_course.index');
        }

        // Lakukan validasi informasi pembayaran.
        $data = $request->all();
        $file = $request->file('payment_evidence');
        $data = Validator::make($data, [
            'account_number' => ['bail', 'required'],
            'account_name' => ['bail', 'required'],
            'payment_evidence' => ['bail', 'required', 'max:8000'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'Your payment evidence has not been uploaded. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($file) {
            $file_name = Str::random(50).'.'.$file->extension();
            $destinationPath = 'uploads/student/payment/';
            $file->move($destinationPath, $file_name);
        }

        $price_amount = $course_registration->course->course_package->price;

        // Ambil course package discount saat ini, jika ada yang aktif dan tidak lewat batas waktu.
        $course_package_discount = $course_registration->course->course_package->course_package_discounts->last();
        if($course_package_discount && $course_package_discount->status == 'Active') {
            if($course_package_discount->due_date == null || $course_package_discount->due_date >= now()) {
                // Jika informasi course package discount ditemukan,
                // maka gantikan harga awal dengan harga setelah didiskon.
                $price_amount = $course_package_discount->price;
            }
        }
        $course_package_discount = CoursePackageDiscount
            ::where('economy_flag_id', Auth::user()->student->economy_flag_id)
            ->where('course_package_id', $course_registration->course->course_package_id)
            ->where('status', 'Active')
            ->get()->last();
        if($course_package_discount && ($course_package_discount->due_date == null || $course_package_discount->due_date >= now())) {
            // Jika informasi course package discount ditemukan,
            // maka gantikan harga awal dengan harga setelah didiskon.
            $price_amount = $course_package_discount->price;
        }
        $course_package_discount = CoursePackageDiscount
            ::where('economy_flag_id', Auth::user()->student->economy_flag_id)
            ->where('code', $course_registration->course->requirement) // KODE PROMO
            ->where('course_package_id', $course_registration->course->course_package_id)
            ->where('status', 'Active')
            ->get()->last();
        if($course_package_discount && ($course_package_discount->due_date == null || $course_package_discount->due_date >= now())) {
            // Jika informasi course package discount ditemukan,
            // maka gantikan harga awal dengan harga setelah didiskon.
            $price_amount = $course_package_discount->price;
        }

        $course_registration->course_payments->last()->update([
            'payment_time' => now(),
            'amount' => $price_amount,
            'path' => ($file)? $file_name : null,
        ]);
        $course_registration->course->update([
            'description' => $request->account_number . ' | ' . $request->account_name,
        ]);

        session(['caption-success' => 'Your payment evidence has been uploaded. Please wait while we check your payment. Thank you!']);
        return redirect()->route('student.upload_payment_evidence.show', [$course_registration_id]);
    }

    public function chat_financial_team_index()
    {
        // mendaftar course: menghubungi financial team (via chat)
    }

    public function chat_financial_team_show($user_id)
    {
        // mendaftar course: menghubungi financial team (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_student.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_financial_team_store(Request $request, $user_id)
    {
        // mendaftar course: menghubungi financial team (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function upload_placement_test_show($course_registration_id)
    {
        // mendaftar course: mengirim hasil placement test
        
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
                // Student dapat mengunggah hasil placement test.
                $has_uploaded_for_placement_test = 0;
            } else {
                // Jika hasil test sudah diunggah tetapi masih 'Not Passed', tampilkan halaman "waiting" atau "interview".
                if($course_registration->course->requirement == null) {
                    // Jika masih menunggu konfirmasi dari Lead Instructor.
                    $has_uploaded_for_placement_test = 1;
                } else {
                    // Jika masih menunggu waktu pelaksanaan interview.
                    $has_uploaded_for_placement_test = 2;
                }
            }
        } else if($course_registration->placement_test->status == 'Passed') {
            // Jika hasil test sudah diunggah dan 'Passed', redirect ke langkah berikutnya.
            return redirect()->route('student.choose_course_registration.show', [$course_registration->id]);
        }

        // Halaman "upload-enabled" dan "waiting" digabungkan dalam satu view yang sama,
        // dipisahkan menggunakan seleksi nilai pada variabel $has_uploaded_for_placement_test.
        return view('role_student.registration_05_complete_placement_tests', compact(
            'course_registration', 'has_uploaded_for_placement_test'
        ));
    }

    public function upload_placement_test_update(Request $request, $course_registration_id)
    {
        // mendaftar course: mengirim hasil placement test

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

        session(['caption-success' => 'Your placement test video has been uploaded. Please wait while we check your video. Thank you!']);
        return redirect()->route('student.upload_placement_test.show', [$course_registration_id]);
    }

    public function chat_lead_instructor_index()
    {
        // mendaftar course: menghubungi lead instructor (via chat)
    }

    public function chat_lead_instructor_show($user_id)
    {
        // mendaftar course: menghubungi lead instructor (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_student.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_lead_instructor_store(Request $request, $user_id)
    {
        // mendaftar course: menghubungi lead instructor (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function choose_course_registration_show($course_registration_id)
    {
        // mendaftar course: memilih jadwal & memilih instructor
        
        // Ambil informasi course_registration Student.
        $course_registration = CourseRegistration::where('id', $course_registration_id)->get()->first();

        // Periksa apakah Student mendaftar dalam kelas "PRIVATE" (atau tidak).
        // Jika ya, variabel bernilai true, selain itu maka false.
        $course_registration_is_private = ( strpos(
            strtolower($course_registration->course->course_package->course_type->name),
            'private'
        ) !== false );

        // Jika Student mendaftar dalam kelas "PRIVATE",
        // maka diperlukan untuk menampilkan daftar instruktur yang mengajar.
        if($course_registration_is_private) {
            // Hubungkan dengan instruktur yang memiliki jadwal dalam materi yang sama.
            // Walaupun instruktur sedang busy semua jadwalnya, tetap ditampilkan,
            // dengan tujuan agar terlihat kepada Student daftar semua instruktur NUSIA yang tersedia,
            // sehingga tidak berkesan bahwa jumlah instruktur adalah sedikit.
            // Model InstructorSchedule digunakan untuk menghindari querying
            // terhadap pendaftaran course Student, karena memang terdapat dalam course package yang sama,
            // seperti dapat dilihat dalam seleksi where() pada kode di bawah ini.
            $instructors = InstructorSchedule
                ::join('instructors', 'instructor_schedules.instructor_id', 'instructors.id')
                ->join('schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->join('sessions', 'sessions.schedule_id', 'schedules.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->where('courses.course_package_id', $course_registration->course->course_package_id)
                ->select('instructors.id', 'instructors.code', 'instructors.user_id', 'instructors.interest', 'instructors.working_experience', 'instructors.created_at', 'instructors.updated_at', 'instructors.deleted_at')
                ->distinct()->get();
dd($course_registration->course->course_package->title);
        } else {
            // Jika Student tidak mendaftar dalam kelas "PRIVATE",
            // maka tidak diperlukan daftar instruktur yang mengajar,
            // karena memang tidak dapat dilihat oleh Student.
            $instructors = null;
        }

        // Hubungkan dengan daftar course yang tersedia,
        // untuk course_package dan instruktur yang siap mengajar
        // (entah data instruktur ditampilkan atau tidak).
        // Walaupun course tersebut sudah penuh kuota pendaftarannya, tetap ditampilkan,
        // dengan tujuan agar terlihat kepada Student daftar semua course NUSIA yang tersedia (entah available atau already full),
        // sehingga tidak berkesan bahwa jumlah course yang tersedia adalah sedikit.
        // Model InstructorSchedule digunakan untuk menghindari querying
        // terhadap pendaftaran course Student, karena memang terdapat dalam course package yang sama,
        // seperti dapat dilihat dalam seleksi where() pada kode di bawah ini.
        $courses = InstructorSchedule
            ::join('instructors', 'instructor_schedules.instructor_id', 'instructors.id')
            ->join('schedules', 'instructor_schedules.schedule_id', 'schedules.id')
            ->join('sessions', 'sessions.schedule_id', 'schedules.id')
            ->join('courses', 'sessions.course_id', 'courses.id')
            ->where('courses.course_package_id', $course_registration->course->course_package_id)
            ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at', 'courses.deleted_at')
            ->distinct()->get();

        return view('role_student.registration_06_complete_course_registrations', compact(
            'course_registration', 'course_registration_is_private', 'instructors', 'courses',
        ));
    }

    public function confirm_course_registration_show($course_registration_id, $course_id)
    {
        // mendaftar course: mengonfirmasi jadwal & mengonfirmasi instructor
    }

    public function confirm_course_registration_update(Request $request, $course_registration_id, $course_id)
    {
        // mendaftar course: mengonfirmasi jadwal & mengonfirmasi instructor
        
        // KODE DI BAWAH INI (DALAM FUNGSI INI) HANYA PERKIRAAN YANG MIRIP SAJA
        if($request->flag == false) return redirect()->route('courses.index');
        
        $data = $request->all();
        $data = Validator::make($data, [
            'course_id' => [
                'bail', 'required',
                Rule::unique('course_registrations', 'course_id')
                    ->where('student_id', $request->student_id)
            ],
            'student_id' => [
                'bail', 'required',
                Rule::unique('course_registrations', 'student_id')
                    ->where('course_id', $request->course_id)
            ]
        ]);
        
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $course = Course::findOrFail($request->course_id);
        $course_registration_id = CourseRegistration::create([
            'course_id' => $request->course_id,
            'student_id' => $request->student_id
        ])->id;
        foreach($course->sessions as $s) {
            SessionRegistration::create([
                'session_id' => $s->id,
                'course_registration_id' => $course_registration_id,
                'status' => 'Not Assigned',
            ]);
        }
        return redirect()->route('registered.dashboard.index');
    }

    public function view_course_registration_index()
    {
        // melihat daftar course dalam proses registrasi
    }

    public function schedule_index()
    {
        // melihat daftar sesi yang sedang atau akan berlangsung
        // & mengikuti kelas (via meeting link)
        // & melihat daftar course yang diikuti
        // & melihat hasil filter daftar course sesuai jenis course
        /*$session = Session::all();
        return view('role_student.sessions_index', compact('session'));*/
        
        // Menyimpan keseluruhan ID course yang sudah terdaftar (untuk Student ybs).
        $completed_registrations = [];
        
        // Melakukan seleksi daftar early registrations
        // (karena ada Early Registration yang belum/tidak selesai pendaftarannya
        // karena belum/tidak menentukan jadwal [dan instruktur]).
        $early_registrations = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
            ->where('course_packages.title', 'LIKE', '%Early Registration%')
            ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
            ->get();
        foreach($early_registrations as $er)
            if($er->session_registrations->toArray() != null)
                array_push($completed_registrations, $er->id);
        
        $other_registrations = CourseRegistration
            ::join('courses', 'course_registrations.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_registrations.student_id', Auth::user()->student->id)
            ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
            ->where('course_packages.title', 'NOT LIKE', '%Early Registration%')
            ->pluck('course_registrations.id');
        foreach($other_registrations as $or)
            // Nilai dalam array bersifat otomatis distinct()
            // karena ada seleksi penggunaan kata "Early Registration" dalam course_package.
            // Sehingga, tidak perlu digunakan PHP function in_array().
            array_push($completed_registrations, $or->id);
        
        // Bagian ini untuk mengambil daftar sesi yang diikuti oleh Student.
        $course_registrations = Auth::user()->student->course_registrations->pluck('id');
        $session_registrations = SessionRegistration
            ::join('sessions', 'session_registrations.session_id', 'sessions.id')
            ->join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->join('courses', 'sessions.course_id', 'courses.id')
            ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
            ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
            ->whereIn('session_registrations.course_registration_id', $course_registrations)
            ->orderBy('schedules.schedule_time')
            ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at', 'session_registrations.deleted_at')
            ->get();
        
        // Bagian ini untuk mengambil daftar course yang diikuti oleh Student.
        $course_registrations = CourseRegistration
            ::whereIn('id', $completed_registrations)
            ->get();
        
        return view('role_student.schedule_index', compact(
            'session_registrations', 'course_registrations',
        ));
    }

    public function schedule_show($course_registration_id)
    {
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & mengikuti kelas (via meeting link)
        // & melihat status kehadiran masing-masing sesi
        // & melihat daftar materi
        // & melihat daftar tugas
        // & melihat nilai tugas
        // & melihat hasil koreksi tugas
        // & melihat daftar ujian
        // & melihat nilai ujian
        // & melihat hasil koreksi ujian
        // & melihat daftar instructor course
        // & melihat daftar student dalam course
        // & melihat status penerimaan sertifikat keikutsertaan dalam course
        $course_registration = CourseRegistration::findOrFail($course_registration_id);
        
        $material_types = MaterialType::all();
        $course_types = CourseType::all();
        $course_levels = CourseLevel::all();
        
        $course_payments = CoursePayment
            ::where('course_registration_id', $course_registration_id)
            ->orderBy('payment_time')
            ->get();
        
        return view('role_student.schedule_show', compact(
            'course_registration', 'material_types', 'course_types', 'course_levels', 'course_payments',
        ));
    }
    
    public function schedule_reschedule_update(Request $request) {
        // mengajukan reschedule
        $session = Session::findOrFail($request->session_id);
        if($session->reschedule_technical_issue_student > 0) {
            session(['caption-danger' => 'Cannot reschedule as your limit has been reached for this session.']);
            return redirect()->back()->withInput();
        }
        if($session->requirement && $session->reschedule_technical_issue_instructor == -1) {
            session(['caption-danger' => 'Cannot reschedule, please firstly accept or decline a reschedule request from your instructor for this session.']);
            return redirect()->back()->withInput();
        }
        
        $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date . ' ' . $request->schedule_time_time)->toDateTimeString();
        if($schedule_time < now()) {
            session(['caption-danger' => 'Cannot reschedule as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        if($schedule_time == $session->schedule->schedule_time) {
            session(['caption-danger' => 'Cannot reschedule as the inputted time is same as the current time schedule.']);
            return redirect()->back()->withInput();
        }
        if($schedule_time == $session->requirement) {
            session(['caption-danger' => 'Cannot reschedule as the inputted time is same as the latest requested time schedule.']);
            return redirect()->back()->withInput();
        }
        $session->update([
            'requirement' => $schedule_time,
            'reschedule_technical_issue_student' => -1,
            'updated_at' => now(),
        ]);
        session(['caption-success' => 'This reschedule information has been added. Thank you!']);
        return redirect()->back();
    }
    
    public function schedule_reschedule_approval_update(Request $request, $session_id) {
        // menyetujui reschedule
        $session = Session::findOrFail($request->session_id);
        if($session->requirement < now()) {
            session(['caption-danger' => 'Cannot approve this reschedule information, as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        if($request->approval_status == 0) {
            $session->update([
                'requirement' => null,
                'reschedule_technical_issue_instructor' => 0,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This reschedule information has been approved not to be changed. Thank you!']);
        } else if($request->approval_status == 1) {
            $session->schedule->update([
                'schedule_time' => $session->requirement,
                'updated_at' => now(),
            ]);
            $session->update([
                'requirement' => null,
                'reschedule_technical_issue_instructor' => 1,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This reschedule information has been approved for change. Kindly check the most recent time schedule for this session. Thank you!']);
        }
        return redirect()->back();
    }
    
    public function feedback_store(Request $request, $course_registration_id, $session_registration_id)
    {
        // mengirim feedback per sesi
        $session_registration = SessionRegistration::findOrFail($session_registration_id);
        if(Auth::user()->student->id != $session_registration->course_registration->student_id)
            return redirect()->back();
        
        $data = Validator::make($request->all(), [
            'rating' . $session_registration_id => ['bail', 'required', 'between:1,5'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'Your feedback has not been sent. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $session_registration->update([
            'status' => 'Present',
        ]);
        Rating::create([
            'session_registration_id' => $session_registration_id,
            'rating' => $request['rating' . $session_registration_id],
            'comment' => $request['comment'],
            'created_at' => now(),
        ]);
        session(['caption-success' => 'Thank you for your feedback!']);
        return redirect()->back();
    }

    public function material_download($course_registration_id, $material_type, $material_id)
    {
        // mengunduh materi
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        
        // 1 untuk MaterialPublic
        // 2 untuk MaterialSession
        if($material_type == 1) $data = MaterialPublic::find($material_id);
        else if($material_type == 2) $data = MaterialSession::find($material_id);
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/material/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function assignment_download($course_registration_id, $assignment_id)
    {
        // mengunduh tugas
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        $data = Task::where('type', 'Assignment')->where('id', $assignment_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/assignment/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function assignment_submission_store(Request $request, $course_registration_id)
    {
        // mengumpulkan tugas
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        
        $course_registration = CourseRegistration::findOrFail($course_registration_id);
        $arr_assignments = [];
        $schedule_now = Carbon::now()->setTimezone(Auth::user()->timezone);
        foreach($course_registration->course->sessions as $s)
            foreach($s->tasks as $dt)
                if($dt->type == 'Assignment') {
                    $this_has_been_checked = 0;
                    foreach($dt->task_submissions as $ts) {
                        if($ts->session_registration->course_registration_id == $course_registration_id && $ts->status == 'Accepted') {
                            $this_has_been_checked = 1;
                            break;
                        }
                    }
                    if($this_has_been_checked == 0 && $schedule_now <= Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone))
                        array_push($arr_assignments, $dt->id);
                }
        $data = Validator::make($request->all(), [
            'type' => ['bail', 'required', Rule::in(['Assignment'])],
            'assignment_id' => ['bail', 'required', Rule::in($arr_assignments)],
            'assignment_title' => ['bail', 'required', 'max:255'],
            'assignment_description' => ['bail', 'required'],
            'assignment_path_1' => ['bail', 'sometimes', 'file', 'max:8000'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'Your assignment has not been sent. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        $task = Task::findOrFail($request->assignment_id);
        if($task->task_submissions->toArray() != null && $task->task_submissions->count() == 10) {
            // hanya boleh maksimum 10 submission untuk masing-masing tugas
            session(['caption-danger' => 'Your assignment cannot be submitted (has exceeded the limit of 10 submissions).']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $session_registration_id = null;
        foreach($course_registration->session_registrations as $sr)
            if($sr->session_id == $task->session_id) {
                $session_registration_id = $sr->id;
                break;
            }
        
        $file = $request->file('assignment_path_1');
        if($file) {
            $file_name = Str::random(10) . '_' . $request['assignment_title'] . '.' . $file->extension();
            $file_path = 'uploads/assignment/submission/';
            $file->move($file_path, $file_name);
        }
        
        TaskSubmission::create([
            'session_registration_id' => $session_registration_id,
            'task_id' => $task->id,
            'title' => $request['assignment_title'],
            'description' => $request['assignment_description'],
            'status' => 'Not Accepted',
            'path_1' => ($file)? $file_name : null,
            'path_1_submitted_at' => ($file)? now() : null,
            'created_at' => now(),
        ]);
        session(['caption-success' => 'Your submission has been successfully sent. Thank you!']);
        return redirect()->back();
    }

    public function assignment_submission_download($course_registration_id, $submission_id)
    {
        // mengunduh pengumpulan tugas
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Assignment')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/assignment/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function exam_download($course_registration_id, $exam_id)
    {
        // mengunduh ujian
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        $data = Task::where('type', 'Exam')->where('id', $exam_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/exam/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function exam_submission_store(Request $request, $course_registration_id)
    {
        // mengumpulkan ujian
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        
        $course_registration = CourseRegistration::findOrFail($course_registration_id);
        $arr_exams = [];
        $schedule_now = Carbon::now()->setTimezone(Auth::user()->timezone);
        foreach($course_registration->course->sessions as $s)
            foreach($s->tasks as $dt)
                if($dt->type == 'Exam') {
                    $this_has_been_checked = 0;
                    foreach($dt->task_submissions as $ts) {
                        if($ts->session_registration->course_registration_id == $course_registration_id && $ts->status == 'Accepted') {
                            $this_has_been_checked = 1;
                            break;
                        }
                    }
                    if($this_has_been_checked == 0 && $schedule_now <= Carbon::parse($dt->due_date)->setTimezone(Auth::user()->timezone))
                        array_push($arr_exams, $dt->id);
                }
        $data = Validator::make($request->all(), [
            'type' => ['bail', 'required', Rule::in(['Exam'])],
            'exam_id' => ['bail', 'required', Rule::in($arr_exams)],
            'exam_title' => ['bail', 'required', 'max:255'],
            'exam_description' => ['bail', 'required'],
            'exam_path_1' => ['bail', 'sometimes', 'file', 'max:8000'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'Your exam has not been sent. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        $task = Task::findOrFail($request->exam_id);
        if($task->task_submissions->toArray() != null && $task->task_submissions->count() == 3) {
            // hanya boleh maksimum 3 submission untuk masing-masing ujian
            session(['caption-danger' => 'Your exam cannot be submitted (has exceeded the limit of 3 submissions).']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        $session_registration_id = null;
        foreach($course_registration->session_registrations as $sr)
            if($sr->session_id == $task->session_id) {
                $session_registration_id = $sr->id;
                break;
            }
        
        $file = $request->file('exam_path_1');
        if($file) {
            $file_name = Str::random(10) . '_' . $request['exam_title'] . '.' . $file->extension();
            $file_path = 'uploads/exam/submission/';
            $file->move($file_path, $file_name);
        }
        
        TaskSubmission::create([
            'session_registration_id' => $session_registration_id,
            'task_id' => $task->id,
            'title' => $request['exam_title'],
            'description' => $request['exam_description'],
            'status' => 'Not Accepted',
            'path_1' => ($file)? $file_name : null,
            'path_1_submitted_at' => ($file)? now() : null,
            'created_at' => now(),
        ]);
        session(['caption-success' => 'Your submission has been successfully sent. Thank you!']);
        return redirect()->back();
    }

    public function exam_submission_download($course_registration_id, $submission_id)
    {
        // mengunduh pengumpulan ujian
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Exam')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/exam/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function certificate_download($course_registration_id)
    {
        // mengunduh sertifikat
        if(!in_array($course_registration_id, Auth::user()->student->course_registrations->pluck('id')->toArray()))
            return redirect()->back();
        $data = CourseRegistration::find($course_registration_id)->course_certificate;
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/student/certificate/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function chat_instructor_index()
    {
        // menghubungi instructor course (via chat)
    }

    public function chat_instructor_show($user_id)
    {
        // menghubungi instructor course (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_student.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_instructor_store(Request $request, $user_id)
    {
        // menghubungi instructor course (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function chat_student_index()
    {
        // menghubungi student course (via chat)
    }

    public function chat_student_show($user_id)
    {
        // menghubungi student course (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_student.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_store(Request $request, $user_id)
    {
        // menghubungi student course (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }

    public function chat_customer_service_index()
    {
        // menghubungi cs (via chat)
    }

    public function chat_customer_service_show($user_id)
    {
        // menghubungi cs (via chat)
        //$users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $users = User::all();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        
        $partner = User::findOrFail($user_id);
        $partner_messages = Message
            ::where(function($q) use($user_id){
                $q
                    ->where('user_id_sender', $user_id)
                    ->where('user_id_recipient', Auth::user()->id);
            })
            ->orWhere(function($q) use($user_id){
                $q
                    ->where('user_id_sender', Auth::user()->id)
                    ->where('user_id_recipient', $user_id);
            })
            ->select('user_id_sender', 'user_id_recipient', 'message', 'created_at')
            ->orderBy('created_at')
            ->get();
        return view('role_student.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_customer_service_store(Request $request, $user_id)
    {
        // menghubungi cs (via chat)
        $data = Validator::make($request->all(), [
            'messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id => ['bail', 'required',],
        ]);
        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        Message::create([
            'user_id_sender' => Auth::user()->id,
            'user_id_recipient' => $user_id,
            'subject' => 'Unknown Subject',
            'message' => $request['messageAs' . Str::slug(Auth::user()->roles, '-') . 'To' . $user_id],
            'created_at' => now(),
        ]);
        return redirect()->back();
    }
}
