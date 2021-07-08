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

class CustomerServiceController extends Controller
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

    public function student_index()
    {
        // melihat daftar student
    }

    public function student_show($user_id)
    {
        // melihat informasi profil student
    }

    public function chat_student_index()
    {
        // menghubungi student (via chat)
    }

    public function chat_student_show($user_id)
    {
        // menghubungi student (via chat)
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
        return view('role_customer_service.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_store(Request $request, $user_id)
    {
        // menghubungi student (via chat)
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

    public function student_course_registration_index($user_id)
    {
        // melihat informasi daftar course yang diikuti oleh student
    }

    public function student_course_registration_show($course_registration_id)
    {
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & melihat feedback per sesi yang diberikan oleh student
        // & melihat status kehadiran student dalam setiap sesi
        // & melihat daftar materi
        // & melihat daftar tugas diberikan
        // & melihat daftar pengumpulan tugas
        // & melihat daftar ujian diberikan
        // & melihat daftar pengumpulan ujian
        // & melihat daftar instructor course
        // & melihat informasi profil instructor
        // & melihat daftar student dalam course
        // & melihat status penerimaan sertifikat keikutsertaan dalam course
    }

    public function course_certificate_download($course_registration_id)
    {
        // mengunduh sertifikat
        $data = CourseRegistration::find($course_registration_id)->course_certificate;
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/student/certificate/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function course_certificate_update(Request $request, $course_registration_id)
    {
        // mengunggah sertifikat
        // $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->course_registration->course->title . '_' . $data->course_registration->student->user->first_name . ' ' . $data->course_registration->student->user->last_name; // + file extension
    }
}
