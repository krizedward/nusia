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
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->is_admin()) {
            $users = User::orderBy('first_name')->orderBy('last_name')->get();
            $lead_instructors = User::where('roles', 'Lead Instructor')->orderBy('first_name')->orderBy('last_name')->get();
            $instructors = User::where('roles', 'Instructor')->orderBy('first_name')->orderBy('last_name')->get();
            $students = User::where('roles', 'Student')->orderBy('first_name')->orderBy('last_name')->get();
            $other_users = User
                ::where('roles', '<>', 'Lead Instructor')
                ->where('roles', '<>', 'Instructor')
                ->where('roles', '<>', 'Student')
                ->get();
            return view('role_admin.users_index', compact(
                'users', 'lead_instructors', 'instructors', 'students', 'other_users'
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    if($this->is_student()) {

        // untuk akses fungsi ini (selain admin), mohon memperhatikan keamanan akses,
        // sehingga tidak ada user yang mengakses profil akun yang
        // tidak diizinkan untuk diakses oleh user tsb.

        $users = User::all();
        $user = null;
        $flag = 0;
        foreach($users as $dt) {
            if(Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name) == $id) {
                $user = $dt;
                $flag = 1;
                break;
            }
        }
        if($flag == 0) return redirect()->route('users.index');

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

        // Special condition for viewing a role (or some roles).
        $placement_tests = null;
        if($user->roles == 'Student') {
            $placement_tests = PlacementTest
                ::join('course_registrations', 'placement_tests.course_registration_id', 'course_registrations.id')
                ->where('course_registrations.student_id', $user->student->id)
                ->select('placement_tests.id', 'placement_tests.code', 'placement_tests.course_registration_id', 'placement_tests.path', 'placement_tests.status', 'placement_tests.submitted_at', 'placement_tests.result_updated_at', 'placement_tests.created_at', 'placement_tests.updated_at', 'placement_tests.deleted_at')
                ->orderBy('placement_tests.submitted_at')
                ->get();
        }

        return view('role_'.Str::slug(Auth::user()->roles, '_').'.users_show_'.Str::slug($user->roles, '_'), compact(
            'user', 'interests', 'timezones', 'placement_tests',
        ));
    } else if($this->is_instructor()) {
        // untuk akses fungsi ini (selain admin), mohon memperhatikan keamanan akses,
        // sehingga tidak ada user yang mengakses profil akun yang
        // tidak diizinkan untuk diakses oleh user tsb.
        
        $users = User::all();
        $user = null;
        $flag = 0;
        foreach($users as $dt) {
            if(Str::slug($dt->password.$dt->first_name.'-'.$dt->last_name) == $user_id) {
                $user = $dt;
                $flag = 1;
                break;
            }
        }
        if($flag == 0) return redirect()->route('users.index');
        
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

        // Special condition for viewing a role (or some roles).
        $courses = Course
            ::join('sessions', 'courses.id', 'sessions.course_id')
            ->join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->join('instructors', 'schedules.instructor_id', 'instructors.id')
            ->distinct()
            ->where('instructors.user_id', $user->id)
            ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at', 'courses.deleted_at')
            ->orderBy('courses.title')
            ->get();

        return view('role_'.Str::slug(Auth::user()->roles, '_').'.users_show_'.Str::slug($user->roles, '_'), compact(
            'user', 'interests', 'timezones', 'courses'
        ));
    }
    }
}
