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

class RegisteredController extends Controller
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

    public function dashboard_index()
    {
        // menampilkan dashboard

        //04.11.2020
        //Membuat Akses Untuk Financial Team
        if ($this->is_financial_team()) {
            return view('role_financial_team.dashboard');
        }

        //Membuat Akses Untuk Customer Service
        if ($this->is_customer_service()) {
            # code...
            return view('role_customer_service.dashboard');
        }

        //03.11.2020
        //Membuat Akses Untuk Lead Instructor
        if ($this->is_lead_instructor()) {
            
            return view('role_lead_instructor.dashboard');
        }

        if($this->is_admin()) {
            //Alert::success('Success', 'Login Berhasil !!!');
            $timeNusia = Carbon::now()->setTimezone('Asia/Jakarta');
            $timeStudent = Carbon::now()->setTimezone(Auth::user()->timezone);
            $student = Student::all();
            $instructor = Instructor::all();
            $session = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('schedules.schedule_time', '>=', $timeStudent)
                ->orderBy('schedules.schedule_time')
                /*->take(7)*/
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();

            $course = Course::all();
            return view('role_admin.dashboard',compact(
                'student','instructor','timeNusia','timeStudent',
                'session', 'course'
            ));
        }

        if($this->is_instructor()) {
            $timeNusia = Carbon::now()->setTimezone('Asia/Jakarta');
            $timeStudent = Carbon::now(Auth::user()->timezone);
            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->join('instructors', 'instructor_schedules.instructor_id', 'instructors.id')
                ->join('users', 'instructors.user_id', 'users.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->where('schedules.schedule_time', '>=', $timeStudent)
                ->distinct()
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.form_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.reschedule_late_confirmation', 'sessions.reschedule_technical_issue_instructor', 'sessions.reschedule_technical_issue_student', 'sessions.created_at', 'sessions.updated_at', 'sessions.deleted_at', 'instructor_schedules.instructor_id')
                ->get();

            $sessions_order_by_schedule_time = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->join('instructors', 'instructor_schedules.instructor_id', 'instructors.id')
                ->join('users', 'instructors.user_id', 'users.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->where('schedules.schedule_time', '>=', $timeStudent->add(3, 'hours')) // asumsi bahwa tidak ada kelas yang berdurasi di atas 3 jam
                ->distinct()
                ->orderBy('schedules.schedule_time')
                ->take(5)
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.form_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.reschedule_late_confirmation', 'sessions.reschedule_technical_issue_instructor', 'sessions.reschedule_technical_issue_student', 'sessions.created_at', 'sessions.updated_at', 'sessions.deleted_at', 'instructor_schedules.instructor_id')
                ->get();

            return view('role_instructor.dashboard', compact(
                'sessions', 'sessions_order_by_schedule_time', 'timeNusia', 'timeStudent', 'sessions',
            ));
        }

        if($this->is_student()) {
            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('student.student_registration_form.index');
            } else if(Auth::user()->student->course_registrations->toArray() == null) {
                return redirect()->route('student.choose_course.index');
            } else if(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null) {
                return redirect()->route('student.complete_payment_information.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->course_payments->last()->status == 'Not Confirmed') {
                return redirect()->route('student.upload_payment_evidence.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed') {
                return redirect()->route('student.upload_placement_test.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null) {
                return redirect()->route('student.choose_course_registration.show', [Auth::user()->student->course_registrations->first()->id]);
            }
            
            //untuk mengubah zona waktu isi didalam dengan lokasi
            $timeStudent = Carbon::now()->setTimezone(Auth::user()->timezone);
            $session_registration = SessionRegistration
                ::join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('schedules.schedule_time', '>=', $timeStudent->add(120, 'minutes')->add(3, 'days'))
                ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();
            $session_order_by_schedule_time = Session
                ::join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('schedules.schedule_time', '>=', $timeStudent->add(120, 'minutes')->add(3, 'days'))
                ->orderBy('schedules.schedule_time')
                ->take(5)
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.created_at', 'sessions.updated_at')
                ->get();
            $material = MaterialSession::all();
            
            // Menyimpan daftar course_registrations yang memiliki jadwal sesi yang belum berjalan.
            // Query ini menghilangkan daftar course_registrations yang sudah SEPENUHNYA selesai.
            $course_registrations = Schedule
                ::join('sessions', 'schedules.id', 'sessions.schedule_id')
                ->join('courses', 'sessions.course_id', 'courses.id')
                ->join('course_packages', 'courses.course_package_id', 'course_packages.id')
                ->join('course_registrations', 'courses.id', 'course_registrations.course_id')
                ->where('course_registrations.student_id', Auth::user()->student->id)
                ->where('course_packages.title', 'NOT LIKE', '%Free%')
                ->where('course_packages.title', 'NOT LIKE', '%Test%')
                ->where('course_packages.title', 'NOT LIKE', '%Trial%')
                ->where('course_packages.title', 'NOT LIKE', '%Not Assigned%')
                ->where('schedules.schedule_time', '>=', $timeStudent)
                ->select('course_registrations.id', 'course_registrations.code', 'course_registrations.course_id', 'course_registrations.student_id', 'course_registrations.created_at', 'course_registrations.updated_at', 'course_registrations.deleted_at')
                ->distinct()
                ->get();
            
            $instructors = Instructor::where('id',Auth::user()->id);
            $is_local_access = config('database.connections.mysql.username') == 'root';
            return view('role_student.dashboard', compact(
                'session_registration', /*session,*/ 'session_order_by_schedule_time',
                'material', 'course_registrations', 'instructors', 'is_local_access'
            ));
        }
    }

    public function contact_index()
    {
        // menampilkan NUSIA contact person
        return view('contact');
    }

    public function chat_index($change_skin = 0, $change_chat_color = 0)
    {
        // membuka fitur chat
        if($change_skin) {
            if(session('skin') == 'skin-blue') $arr = array('skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-blue-light') $arr = array('skin-blue', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-red') $arr = array('skin-blue', 'skin-blue-light', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-red-light') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-yellow') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-yellow-light') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-green') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-green-light') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-purple') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple-light', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-purple-light') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-black', 'skin-black-light');
            else if(session('skin') == 'skin-black') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black-light');
            else if(session('skin') == 'skin-black-light') $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black');
            else $arr = array('skin-blue', 'skin-blue-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-green', 'skin-green-light', 'skin-purple', 'skin-purple-light', 'skin-black', 'skin-black-light');
            session(['skin' => $arr[array_rand($arr)]]);
        }
        if($change_chat_color) {
            if(session('chat-color') == 'primary') $arr = array('warning', 'danger', 'success');
            else if(session('chat-color') == 'warning') $arr = array('primary', 'danger', 'success');
            else if(session('chat-color') == 'danger') $arr = array('primary', 'warning', 'success');
            else if(session('chat-color') == 'success') $arr = array('primary', 'warning', 'danger');
            else $arr = array('primary', 'warning', 'danger', 'success');
            session(['chat-color' => $arr[array_rand($arr)]]);
            
            if(session('chat-color') == 'primary') session(['chat-color-alias' => 'blue']);
            else if(session('chat-color') == 'warning') session(['chat-color-alias' => 'yellow']);
            else if(session('chat-color') == 'danger') session(['chat-color-alias' => 'red']);
            else if(session('chat-color') == 'success') session(['chat-color-alias' => 'green']);
        }
        
        $users = User::whereIn('id', app(Controller::class)->get_relevant_user_ids_for_chat())->get();
        $messages = Message
            ::where(function($q) {
                $q
                    ->whereIn('user_id_sender', app(Controller::class)->get_relevant_user_ids_for_chat())
                    ->where('user_id_recipient', 'LIKE', Auth::user()->id);
            })
            ->orWhere(function($q) {
                $q
                    ->where('user_id_sender', 'LIKE', Auth::user()->id)
                    ->whereIn('user_id_recipient', app(Controller::class)->get_relevant_user_ids_for_chat());
            })
            ->orderBy('created_at', 'DESC')
            ->get();
        if($this->is_student()) {
            return view('role_student.chat_index', compact('users', 'messages'));
        } else if($this->is_instructor()) {
            return view('role_instructor.chat_index', compact('users', 'messages'));
        } else if($this->is_lead_instructor()) {
            return view('role_lead_instructor.chat_index', compact('users', 'messages'));
        } else if($this->is_customer_service()) {
            return view('role_customer_service.chat_index', compact('users', 'messages'));
        } else if($this->is_financial_team()) {
            return view('role_financial_team.chat_index', compact('users', 'messages'));
        } else if($this->is_admin()) {
            return view('role_admin.chat_index', compact('users', 'messages'));
        }
    }

    public function profile_index()
    {
        // melihat informasi profil
        if($this->is_admin()){
            return view('role_admin.profile');
        } else if($this->is_lead_instructor()){
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

            return view('role_lead_instructor.profile',compact('interests'));
        } else if($this->is_instructor()){
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

            return view('role_instructor.profile',compact('interests'));
        } else if($this->is_student()){
            if(Auth::user()->citizenship == 'Not Available') {
                return redirect()->route('student.student_registration_form.index');
            } else if(Auth::user()->student->course_registrations->toArray() == null) {
                return redirect()->route('student.choose_course.index');
            } else if(Auth::user()->student->course_registrations->first()->course_payments->toArray() == null) {
                return redirect()->route('student.complete_payment_information.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->course_payments->last()->status == 'Not Confirmed') {
                return redirect()->route('student.upload_payment_evidence.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test == null || Auth::user()->student->course_registrations->first()->placement_test->status == 'Not Passed') {
                return redirect()->route('student.upload_placement_test.show', [Auth::user()->student->course_registrations->first()->id]);
            } else if(Auth::user()->student->course_registrations->first()->placement_test->status == 'Passed' && Auth::user()->student->course_registrations->first()->session_registrations->toArray() == null) {
                return redirect()->route('student.choose_course_registration.show', [Auth::user()->student->course_registrations->first()->id]);
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
            $zone_names = [
                /* -11 */ 'Pacific/Pago_Pago',      /* -10 */ 'Pacific/Rarotonga',
                /* -09:30 */ 'Pacific/Marquesas',   /* -09 */ 'Pacific/Gambier',
                /* -08 */ 'Pacific/Pitcairn',       /* -07 */ 'America/Phoenix',
                /* -06 */ 'America/Costa_Rica',     /* -05 */ 'America/Panama',
                /* -04 */ 'America/Port_of_Spain',  /* -03 */ 'America/Montevideo',
                /* -02 */ 'Atlantic/South_Georgia', /* -01 */ 'Atlantic/Cape_Verde',
                /* +00 */ 'Africa/Abidjan',         /* +01 */ 'Africa/Lagos',
                /* +02 */ 'Africa/Maputo',          /* +03 */ 'Africa/Nairobi',
                /* +04 */ 'Asia/Dubai',             /* +04:30 */ 'Asia/Kabul',
                /* +05 */ 'Asia/Ashgabat',          /* +05:30 */ 'Asia/Colombo',
                /* +05:45 */ 'Asia/Kathmandu',      /* +06 */ 'Asia/Dhaka',
                /* +06:30 */ 'Asia/Yangon',         /* +07 */ 'Asia/Bangkok',
                /* +08 */ 'Asia/Macau',             /* +08:45 */ 'Australia/Eucla',
                /* +09 */ 'Asia/Tokyo',             /* +09:30 */ 'Australia/Darwin',
                /* +10 */ 'Asia/Vladivostok',       /* +11 */ 'Pacific/Pohnpei',
                /* +12 */ 'Pacific/Nauru',          /* +13 */ 'Pacific/Fakaofo',
                /* +14 */ 'Pacific/Kiritimati',
            ];
            for($i = 0; $i < count($timezones); $i++) {
                if(Auth::user()->timezone == $zone_names[$i]) {
                    $tz_old = $timezones[$i];
                    break;
                }
            }
            return view('role_student.profile',compact('interests', 'timezones', 'tz_old'));
        } else {
            return redirect()->back();
        }
    }

    public function profile_update(Request $request)
    {
        // memodifikasi informasi profil
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
        } else if($this->is_student()) {
            $interest = array(
                $request->interest_1, $request->interest_2, $request->interest_3,
                $request->interest_4, $request->interest_5, $request->interest_6
            );
            for($i = 0; $i < 6; $i = $i + 1) if($interest[$i] == null) unset($interest[$i]);
            $interest = implode(', ', $interest);
            $data = $request->all();
            $data['interest_1'] = ($interest != null)? 'PASS' : null;
            
            $timezones = [
                '-11', '-10', '-09:30', '-09', '-08', '-07', '-06', '-05', '-04', '-03', '-02', '-01',
                '+00', '+01', '+02', '+03', '+04', '+04:30', '+05', '+05:30', '+05:45', '+06',
                '+06:30', '+07', '+08', '+08:45', '+09', '+09:30', '+10', '+11', '+12', '+13', '+14',
            ];
            $zone_names = [
                /* -11 */ 'Pacific/Pago_Pago',      /* -10 */ 'Pacific/Rarotonga',
                /* -09:30 */ 'Pacific/Marquesas',   /* -09 */ 'Pacific/Gambier',
                /* -08 */ 'Pacific/Pitcairn',       /* -07 */ 'America/Phoenix',
                /* -06 */ 'America/Costa_Rica',     /* -05 */ 'America/Panama',
                /* -04 */ 'America/Port_of_Spain',  /* -03 */ 'America/Montevideo',
                /* -02 */ 'Atlantic/South_Georgia', /* -01 */ 'Atlantic/Cape_Verde',
                /* +00 */ 'Africa/Abidjan',         /* +01 */ 'Africa/Lagos',
                /* +02 */ 'Africa/Maputo',          /* +03 */ 'Africa/Nairobi',
                /* +04 */ 'Asia/Dubai',             /* +04:30 */ 'Asia/Kabul',
                /* +05 */ 'Asia/Ashgabat',          /* +05:30 */ 'Asia/Colombo',
                /* +05:45 */ 'Asia/Kathmandu',      /* +06 */ 'Asia/Dhaka',
                /* +06:30 */ 'Asia/Yangon',         /* +07 */ 'Asia/Bangkok',
                /* +08 */ 'Asia/Macau',             /* +08:45 */ 'Australia/Eucla',
                /* +09 */ 'Asia/Tokyo',             /* +09:30 */ 'Australia/Darwin',
                /* +10 */ 'Asia/Vladivostok',       /* +11 */ 'Pacific/Pohnpei',
                /* +12 */ 'Pacific/Nauru',          /* +13 */ 'Pacific/Fakaofo',
                /* +14 */ 'Pacific/Kiritimati',
            ];
            for($i = 0; $i < count($timezones); $i++) {
                if($request->timezone == $timezones[$i]) {
                    $request->timezone = $zone_names[$i];
                    break;
                }
            }
            
            $data = Validator::make($data, [
                'domicile' => ['bail', 'required'],
                'interest_1' => ['bail', 'required'],
                'image_profile_flag' => ['bail', 'required'],
                'image_profile' => ['bail', 'sometimes', 'max:8000'],
                'timezone' => ['bail', 'required'],
            ]);
            if($data->fails()) {
                session(['caption-danger' => 'Your profile information has not been updated. Try again.']);
                return redirect()->back()->withErrors($data)->withInput();
            }
            
            if($request->image_profile_flag != 0 && Auth::user()->image_profile != 'user.jpg') {
                // mengganti atau menghapus foto profil, maka foto sebelumnya dihapus dari storage
                $destinationPath = 'uploads/student/profile/';
                File::delete($destinationPath . Auth::user()->image_profile);
            }
            $file = $request->file('image_profile');
            if($file) {
                // mengunggah foto profil baru
                if($request->image_profile_flag == 1) {
                    // mengganti foto profil dengan foto yang baru
                    $file_name = Str::random(50) . '.' . $file->extension();
                    $destinationPath = 'uploads/student/profile/';
                    $file->move($destinationPath, $file_name);
                } else if($request->image_profile_flag == 0) {
                    // tidak mengubah foto profil, maka seleksi ini tidak ada
                    // tetapi untuk keamanan, ganti foto profil dengan foto profil user saat ini
                    $file_name = Auth::user()->image_profile;
                } else if($request->image_profile_flag == -1) {
                    // menghapus foto profil tidak perlu up, maka seleksi ini tidak ada,
                    // tetapi untuk keamanan, ganti foto profil dengan 'user.jpg'
                    $file_name = 'user.jpg';
                }
            } else {
                // tidak mengunggah foto profil baru
                if($request->image_profile_flag == 1) {
                    // ingin mengganti foto profil, tetapi tidak ada foto profil baru yang diunggah
                    // maka, ganti foto profil dengan 'user.jpg'
                    $file_name = 'user.jpg';
                } else if($request->image_profile_flag == 0) {
                    // tidak mengubah foto profil, maka seleksi ini tidak ada
                    // tetapi untuk keamanan, ganti foto profil dengan foto profil user saat ini
                    $file_name = Auth::user()->image_profile;
                } else if($request->image_profile_flag == -1) {
                    // menghapus foto profil, maka ganti foto profil dengan 'user.jpg'
                    $file_name = 'user.jpg';
                }
            }
            Student::where('user_id', Auth::user()->id)->update([
                'user_id' => Auth::user()->id,
                'interest' => $interest,
                'updated_at' => now(),
            ]);
            User::find(Auth::user()->id)->update([
                'domicile' => $request->domicile,
                'timezone' => $request->timezone,
                'image_profile' => $file_name,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'Your profile information has been updated. Thank you!']);
        }
        return redirect()->back();
    }

    public function logout_get_index()
    {
        // apabila proses logout error (metode GET tidak didukung)
        return redirect()->route('registered.dashboard.index');
    }
}
