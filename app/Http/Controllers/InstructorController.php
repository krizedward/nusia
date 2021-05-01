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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

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

    public function schedule_index() {
        // melihat jadwal mengajar yang diintegrasikan dengan sesi, yang sedang atau akan berlangsung
        // & melaksanakan kelas (via meeting link)
        // & melihat ketersediaan jadwal mengajar yang pernah dibuat, secara menyeluruh
        // & melihat daftar course yang diajar
        // & melihat hasil filter daftar course sesuai jenis course
        $instructor_schedules = InstructorSchedule::where('instructor_id', Auth::user()->instructor->id)->get();
        $courses = Course
            ::join('sessions', 'sessions.course_id', 'courses.id')
            ->join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
            ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
            ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at', 'courses.deleted_at')
            ->distinct()->get();
        return view('role_instructor.schedule_index', compact('instructor_schedules', 'courses'));
    }

    public function schedule_store(Request $request) {
        // menambah ketersediaan jadwal mengajar
    }

    public function schedule_update(Request $request, $schedule_id) {
        // memodifikasi ketersediaan jadwal mengajar
    }

    public function schedule_integrate_update(Request $request, $schedule_id) {
        // mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
    }

    public function schedule_destroy($schedule_id) {
        // menghapus ketersediaan jadwal mengajar
        $schedule = Schedule::findOrFail($schedule_id);
        foreach($schedule->instructor_schedules as $dt) if($dt->instructor_id == Auth::user()->instructor->id)
            $dt->delete();
        $schedule->delete();
        session(['caption-success' => 'This session information has been deleted. Thank you!']);
        return redirect()->back();
    }

    public function course_show($course_id) {
        // melihat informasi detail masing-masing course
        // & melihat daftar sesi
        // & melaksanakan kelas (via meeting link)
        // & melihat daftar materi
        // & melihat daftar tugas diberikan
        // & melihat daftar pengumpulan tugas
        // & melihat daftar ujian diberikan
        // & melihat daftar pengumpulan ujian
        // & melihat daftar instructor course
        // & melihat daftar student dalam course
        $course = Course::findOrFail($course_id);
        $sessions = Session
            ::join('schedules', 'sessions.schedule_id', 'schedules.id')
            ->where('sessions.course_id', $course_id)
            ->orderBy('schedules.schedule_time')
            ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.form_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.reschedule_late_confirmation', 'sessions.reschedule_technical_issue_instructor', 'sessions.reschedule_technical_issue_student', 'sessions.created_at', 'sessions.updated_at', 'sessions.deleted_at')
            ->get();
        $task_submissions = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')
            ->join('sessions', 'tasks.session_id', 'sessions.id')
            ->where('sessions.course_id', $course_id)
            ->orderBy('task_submissions.path_1_submitted_at')
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get();
        
        $material_types = MaterialType::all();
        $course_types = CourseType::all();
        $course_levels = CourseLevel::all();
        
        return view('role_instructor.course_show', compact(
            'course', 'sessions', 'task_submissions', 'material_types', 'course_types', 'course_levels',
        ));
    }

    public function session_store(Request $request, $course_id) {
        // membuat sesi baru
        // & mengintegrasikan ketersediaan jadwal mengajar dengan sesi tertentu
        // & menambah ketersediaan jadwal mengajar
    }

    public function session_update(Request $request) {
        // memodifikasi informasi umum mengenai sesi
        // & memodifikasi ketersediaan jadwal mengajar
        $data = Validator::make($request->all(), [
            'schedule_time_date' => ['bail', Rule::requiredIf($request->schedule_time_flag == 1)],
            'schedule_time_time' => ['bail', Rule::requiredIf($request->schedule_time_flag == 1)],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'This session information has not been changed. Try again.']);
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }
        
        if($request->schedule_time_flag == 1) {
            $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date . ' ' . $request->schedule_time_time)->toDateTimeString();
            if($schedule_time < now()) {
                session(['caption-danger' => 'Cannot change the time schedule as the inputted time is invalid.']);
                return redirect()->back()->withInput();
            }
        }
        else $schedule_time = null;
        
        $schedule_time_is_exist = 0;
        $already_existed_instructor_schedule = null;
        if($schedule_time) {
            foreach(Auth::user()->instructor->instructor_schedules as $dt) {
                if($dt->schedule->schedule_time == $schedule_time) {
                    $schedule_time_is_exist = 1;
                    $already_existed_instructor_schedule = $dt;
                    break;
                }
            }
        }
        
        if($request->session_id) {
            // memodifikasi informasi sesi yang sudah ada
            $session = Session::findOrFail($request->session_id);
            if($request->link_zoom_flag == 1) {
                // memodifikasi link meeting
                $session->update([
                    'link_zoom' => $request->link_zoom,
                    'updated_at' => now(),
                ]);
                session(['caption-success' => 'This session information has been changed. Thank you!']);
            }
            if($schedule_time) {
                // memodifikasi jadwal meeting
                if($schedule_time_is_exist) {
                    // terdapat jadwal meeting yang sama dengan schedule_time
                    // maka tukar ketersediaan waktu antara jadwal lama dengan jadwal baru
                    if($already_existed_instructor_schedule->status == 'Busy') {
                        // jadwal yang ditukar telah diintegrasikan dengan sesi lain
                        // maka tidak dapat dilakukan penukaran jadwal
                        session(['caption-danger' => 'Cannot change the time schedule as the inputted time has been assigned to another session.']);
                    } else if($already_existed_instructor_schedule->status == 'Available') {
                        // jadwal yang ditukar belum diintegrasikan dengan sesi lain
                        // maka dilakukan penukaran jadwal
                        $session->schedule->instructor_schedules->first()->update([
                            'status' => 'Available',
                            'updated_at' => now(),
                        ]);
                        $session->update([
                            'schedule_id' => $already_existed_instructor_schedule->schedule_id,
                            'updated_at' => now(),
                        ]);
                        $already_existed_instructor_schedule->update([
                            'status' => 'Busy',
                            'updated_at' => now(),
                        ]);
                        session(['caption-success' => 'This session information has been changed. Thank you!']);
                    }
                } else {
                    // tidak ada jadwal meeting yang sama dengan jadwal baru ini
                    $session->schedule->update([
                        'schedule_time' => $schedule_time,
                        'updated_at' => now(),
                    ]);
                    session(['caption-success' => 'This session information has been changed. Thank you!']);
                }
            }
        } else {
            // menambah informasi jadwal atau informasi sesi baru
            if($schedule_time) {
                if($schedule_time_is_exist) {
                    // jadwal tersebut sudah ada, sehingga tidak dilakukan perubahan
                    session(['caption-danger' => 'This schedule has been previously registered. No changes are made.']);
                    return redirect()->back()->withInput();
                } else {
                    // jadwal tersebut belum ada, sehingga dibuat sebagai jadwal baru
                    InstructorSchedule::create([
                        'instructor_id' => Auth::user()->instructor->id,
                        'schedule_id' => Schedule::create([
                            'schedule_time' => $schedule_time,
                            'created_at' => now(),
                        ])->id,
                        'status' => 'Available',
                        'created_at' => now(),
                    ]);
                    session(['caption-success' => 'This schedule information has been added. Thank you!']);
                }
            }
        }
        return redirect()->back();
    }
    
    public function session_reschedule_update(Request $request) {
        // mengajukan reschedule
        $session = Session::findOrFail($request->session_id);
        if($session->reschedule_technical_issue_instructor > 0) {
            session(['caption-danger' => 'Cannot reschedule as the limit for instructor has been reached for this session.']);
            return redirect()->back()->withInput();
        }
        
        $schedule_time = Carbon::createFromFormat('m/d/Y H:i A', $request->schedule_time_date . ' ' . $request->schedule_time_time)->toDateTimeString();
        if($schedule_time < now()) {
            session(['caption-danger' => 'Cannot reschedule as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        $session->update([
            'requirement' => $schedule_time,
            'reschedule_technical_issue_instructor' => -1,
            'updated_at' => now(),
        ]);
        session(['caption-success' => 'This reschedule information has been added. Thank you!']);
        return redirect()->back();
    }
    
    public function session_reschedule_approval_update(Request $request, $session_id) {
        // menyetujui reschedule
        $session = Session::findOrFail($request->session_id);
        if($session->requirement < now()) {
            session(['caption-danger' => 'Cannot approve this reschedule information, as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        if($request->approval_status == 0) {
            $session->update([
                'requirement' => null,
                'reschedule_technical_issue_student' => 0,
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
                'reschedule_technical_issue_student' => 1,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This reschedule information has been approved for change. Kindly check the most recent time schedule for this session. Thank you!']);
        }
        return redirect()->back();
    }
    
    public function session_destroy($course_id, $session_id) {
        // menghapus informasi sesi
        // & menghapus ketersediaan jadwal mengajar
    }

    public function student_attendance_index($course_id, $session_id) {
        // melihat status kehadiran student dalam setiap sesi
        $session_registrations = SessionRegistration::where('session_id', $session_id)->get();
        if($session_registrations->count() == 0) {
            session(['caption-danger' => 'Cannot edit this session attendance, as no students are available in this session.']);
            return redirect()->back();
        }
        
        $session = Session::findOrFail($session_id);
        $schedule_time_begin_attendance = Carbon::parse($session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
        $schedule_time_begin_attendance->add($session->course->course_package->material_type->duration_in_minute, 'minutes')->sub(10, 'minutes');
        $schedule_time_end_attendance = Carbon::parse($session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
        $schedule_time_end_attendance->add($session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
        if(now() <= $schedule_time_begin_attendance || now() > $schedule_time_end_attendance) {
            // tidak diperbolehkan mengakses link.
            session(['caption-danger' => 'Cannot edit this session attendance, as it is not the time.']);
            return redirect()->route('instructor.course.show', [$course_id]);
        }
        
        return view('role_instructor.attendances_index', compact('session_registrations', 'session'));
    }

    public function student_attendance_update(Request $request, $course_id, $session_id) {
        // mengubah status kehadiran student dalam satu sesi
        $session = Session::findOrFail($session_id);
        $schedule_now = Carbon::now()->setTimezone(Auth::user()->timezone);
        $schedule_time_begin = Carbon::parse($session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
        $schedule_time_end_attendance = Carbon::parse($session->schedule->schedule_time)->setTimezone(Auth::user()->timezone);
        $schedule_time_end_attendance->add($session->course->course_package->material_type->duration_in_minute, 'minutes')->add(30, 'minutes');
        if($schedule_now > $schedule_time_end_attendance) {
            session(['caption-danger' => 'Cannot update the attendance information, as the due time has passed. Please contact NUSIA Admin for support.']);
            return redirect()->route('instructor.course.show', [$course_id]);
        }
        foreach($session->session_registrations as $sr) {
            $flag = 0;
            foreach($request->all() as $key => $val) {
                if($key == 'flag'.$sr->course_registration->student->id && $val == 'true') {
                    $sr->update([
                        'status' => 'Should Submit Form',
                    ]);
                    $flag = 1;
                    break;
                }
            }
            if($flag == 0) {
                $sr->update([
                    'status' => 'Not Present',
                ]);
            }
        }
        session(['caption-success' => 'This attendance information has been updated. Thank you!']);
        return redirect()->route('instructor.course.show', [$course_id]);
    }

    public function session_feedback_index($course_id, $session_id) {
        // melihat feedback per sesi
    }

    public function material_store(Request $request, $course_id) {
        // mengunggah materi
    }

    public function material_download($material_type, $material_id) {
        // mengunduh materi
        // 1 untuk MaterialPublic
        // 2 untuk MaterialSession
        if($material_type == 1) $data = MaterialPublic::find($material_id);
        else if($material_type == 2) $data = MaterialSession::find($material_id);
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path;
        $path = 'uploads/material/' . $data->path;
        return response()->download($path, $file_name);
    }

    public function material_update(Request $request, $course_id, $material_type) {
        // memodifikasi informasi materi
        $course = Course::findOrFail($course_id);
        if($material_type == 1) {
            // material public
            $sessions = Session::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where('sessions.course_id', $course_id)
                ->orderBy('schedules.schedule_time')
                ->get();
            foreach($sessions as $i => $s) {
                if($s->id == $request->material_public_session_name) {
                    $session_number = $i + 1;
                    break;
                }
            }
            
            $data = Validator::make($request->all(), [
                'material_public_id' => ['bail', 'required'],
                'material_public_session_name' => ['bail', 'required', 'numeric'],
                'material_public_name' => ['bail', 'required', 'max:255'],
                'material_public_description' => ['bail', 'sometimes'],
                'material_public_path_type' => ['bail', 'required'],
                'material_public_path_link' => ['bail', 'required_if:material_public_path_type,link'],
                'material_public_path_file' => ['bail', 'required_if:material_public_path_type,file', 'max:8000'],
            ]);
            if($data->fails()) {
                if($request->material_public_id == 0)
                    // add a new material
                    session(['caption-danger' => 'Your material has not been uploaded. Try again.']);
                else
                    // update an existing material
                    session(['caption-danger' => 'Your material has not been updated. Try again.']);
                return redirect()->back()->withErrors($data)->withInput();
            }
            
            $material_public_path = null;
            $file = $request->file('material_public_path_file');
            if($file) {
                $file_name = Str::random(10) . '_' . $request['material_public_name'] . '.' . $file->extension();
                $destination_path = 'uploads/material/';
                $file->move($destination_path, $file_name);
                $material_public_path = $file_name;
            } else if($request->material_public_path_type == 'link') {
                $material_public_path = $request->material_public_path_link;
            }
            
            if($request->material_public_id == 0) {
                // add a new material
                MaterialPublic::create([
                    'course_package_id' => $course->course_package_id,
                    'session_number' => $session_number,
                    'name' => $request->material_public_name, // 'Session ' . $session_number . ' - ' . $request->material_public_name,
                    'description' => $request->material_public_description,
                    'path' => $material_public_path,
                    'created_at' => now(),
                ]);
                session(['caption-success' => 'This material information has been added. Thank you!']);
            } else {
                // update an existing material
                $material_public = MaterialPublic::findOrFail($request->material_public_id);
                if($material_public->path) {
                    $destination_path = 'uploads/material/';
                    File::delete($destination_path . $material_public->path);
                }
                $material_public->update([
                    'course_package_id' => $course->course_package_id,
                    'session_number' => $session_number,
                    'name' => $request->material_public_name, // 'Session ' . $session_number . ' - ' . $request->material_public_name,
                    'description' => $request->material_public_description,
                    'path' => $material_public_path,
                    'updated_at' => now(),
                ]);
                session(['caption-success' => 'This material information has been updated. Thank you!']);
            }
        } else if($material_type == 2) {
            // material session
            $data = Validator::make($request->all(), [
                'material_session_id' => ['bail', 'required'],
                'material_session_name' => ['bail', 'required', 'max:255'],
                'material_session_description' => ['bail', 'sometimes'],
                'material_session_path' => ['bail', 'sometimes', 'max:8000'],
                'material_session_path_type' => ['bail', 'required'],
                'material_session_path_link' => ['bail', 'required_if:material_session_path_type,link'],
                'material_session_path_file' => ['bail', 'required_if:material_session_path_type,file', 'max:8000'],
            ]);
            if($data->fails()) {
                if($request->material_session_id == 0)
                    // add a new material
                    session(['caption-danger' => 'Your material has not been uploaded. Try again.']);
                else
                    // update an existing material
                    session(['caption-danger' => 'Your material has not been updated. Try again.']);
                return redirect()->back()->withErrors($data)->withInput();
            }
            
            $material_session_path = null;
            $file = $request->file('material_session_path');
            if($file) {
                $file_name = Str::random(10) . '_' . $request['material_session_name'] . '.' . $file->extension();
                $destination_path = 'uploads/material/';
                $file->move($destination_path, $file_name);
                $material_session_path = $file_name;
            } else if($request->material_session_path_type == 'link') {
                $material_session_path = $request->material_session_path_link;
            }
            
            if($request->material_session_id == 0) {
                // add a new material
                MaterialSession::create([
                    'session_id' => $request->material_session_updated_id,
                    'name' => $request->material_session_name,
                    'description' => $request->material_session_description,
                    'path' => $material_session_path,
                    'created_at' => now(),
                ]);
                session(['caption-success' => 'This material information has been added. Thank you!']);
            } else {
                // update an existing material
                $material_session = MaterialSession::findOrFail($request->material_session_id);
                if($material_session->path) {
                    $destination_path = 'uploads/material/';
                    File::delete($destination_path . $material_session->path);
                }
                $material_session->update([
                    'session_id' => $request->material_session_updated_id,
                    'name' => $request->material_session_name,
                    'description' => $request->material_session_description,
                    'path' => $material_session_path,
                    'updated_at' => now(),
                ]);
                session(['caption-success' => 'This material information has been updated. Thank you!']);
            }
        } else return redirect()->route('login');
        return redirect()->back();
    }

    public function material_destroy($course_id, $material_type, $material_id) {
        // menghapus informasi materi
        if($material_type == 1) {
            // material public
            $material = MaterialPublic::findOrFail($material_id);
        } else if($material_type == 2) {
            // material session
            $material = MaterialSession::findOrFail($material_id);
        } else return redirect()->route('login');
        
        if($material->path) {
            if(strpos($material->path, '://') !== false || strpos($material->path, 'www.') !== false) {
                $destination_path = 'uploads/material/';
                File::delete($destination_path . $material->path);
            }
        }
        $material->delete();
        session(['caption-success' => 'This material information has been deleted. Thank you!']);
        return redirect()->back();
    }

    public function assignment_store(Request $request, $course_id) {
        // mengunggah tugas
    }

    public function assignment_download($course_id, $assignment_id) {
        // mengunduh tugas
        $data = Task::where('type', 'Assignment')->where('id', $assignment_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/assignment/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function assignment_update(Request $request, $course_id) {
        // memodifikasi informasi tugas
        $data = Validator::make($request->all(), [
            'assignment_id' => ['bail', 'required'],
            'assignment_session_id' => ['bail', 'required', 'numeric'],
            'assignment_title' => ['bail', 'required', 'max:255'],
            'assignment_description' => ['bail', 'sometimes'],
            'assignment_due_date_date' => ['bail', 'required'],
            'assignment_due_date_time' => ['bail', 'required'],
            'assignment_path_1' => ['bail', 'sometimes', 'max:8000'],
        ]);
        if($data->fails()) {
            if($request->assignment_id == 0)
                // add a new assignment
                session(['caption-danger' => 'Your assignment has not been uploaded. Try again.']);
            else
                // update an existing assignment
                session(['caption-danger' => 'Your assignment has not been updated. Try again.']);
            return redirect()->back()->withErrors($data)->withInput();
        }
        
        $due_date = Carbon::createFromFormat('m/d/Y H:i A', $request->assignment_due_date_date . ' ' . $request->assignment_due_date_time)->toDateTimeString();
        if($due_date < now()) {
            session(['caption-danger' => 'Cannot change the due time as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        
        $file = $request->file('assignment_path_1');
        if($file) {
            $file_name = Str::random(10) . '_' . $request['assignment_title'] . '.' . $file->extension();
            $destination_path = 'uploads/assignment/';
            $file->move($destination_path, $file_name);
        }
        
        $course = Course::findOrFail($course_id);
        if($request->assignment_id == 0) {
            // add a new assignment
            Task::create([
                'session_id' => $request->assignment_session_id,
                'type' => 'Assignment',
                'title' => $request->assignment_title,
                'description' => $request->assignment_description,
                'due_date' => $due_date,
                'path_1' => ($file)? $file_name : null,
                'created_at' => now(),
            ]);
            session(['caption-success' => 'This assignment information has been added. Thank you!']);
        } else {
            // update an existing assignment
            $assignment = Task::findOrFail($request->assignment_id);
            if($assignment->path_1) {
                $destination_path = 'uploads/assignment/';
                File::delete($destination_path . $assignment->path_1);
            }
            $assignment->update([
                'session_id' => $request->assignment_session_id,
                'type' => 'Assignment',
                'title' => $request->assignment_title,
                'description' => $request->assignment_description,
                'due_date' => $due_date,
                'path_1' => ($file)? $file_name : null,
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This assignment information has been updated. Thank you!']);
        }
        return redirect()->back();
    }

    public function assignment_destroy(Request $request, $course_id, $assignment_id) {
        // menghapus informasi tugas
        $assignment = Task::findOrFail($request->assignment_id);
        if($assignment->path_1) {
            $destination_path = 'uploads/assignment/';
            File::delete($destination_path . $assignment->path_1);
        }
        $assignment->delete();
        session(['caption-success' => 'This assignment information has been deleted. Thank you!']);
        return redirect()->back();
    }

    public function assignment_submission_download($course_id, $submission_id) {
        // mengunduh pengumpulan tugas
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Assignment')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/assignment/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function assignment_submission_update(Request $request, $course_id, $submission_id) {
        // mengoreksi pengumpulan tugas
        $data = Validator::make($request->all(), [
            'assignment_submission_score' => ['bail', 'required', 'numeric'],
            'assignment_submission_instructor_reply' => ['bail', 'required'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'The submission information has not been updated. Try again.']);
            return redirect()->back()->withErrors($data)->withInput();
        }
        
        $task_submission = TaskSubmission::findOrFail($submission_id);
        if($task_submission->task->session->course_id == $course_id) {
            $task_submission->update([
                'score' => $request->assignment_submission_score,
                'instructor_reply' => $request->assignment_submission_instructor_reply,
                'status' => 'Accepted',
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This submission information has been updated. Thank you!']);
        } else {
            session(['caption-danger' => 'You are not authorized to update this information.']);
            return redirect()->back()->withErrors($data)->withInput();
        }
        return redirect()->back();
    }

    public function exam_store(Request $request, $course_id) {
        // mengunggah ujian
    }

    public function exam_download($course_id, $exam_id) {
        // mengunduh ujian
        $data = Task::where('type', 'Exam')->where('id', $exam_id)->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/exam/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function exam_update(Request $request, $course_id) {
        // memodifikasi informasi ujian
        $data = Validator::make($request->all(), [
            'exam_session_id' => ['bail', 'required', 'numeric'],
            'exam_title' => ['bail', 'required', 'max:255'],
            'exam_description' => ['bail', 'sometimes'],
            'exam_due_date_date' => ['bail', 'required'],
            'exam_due_date_time' => ['bail', 'required'],
            'exam_path_1' => ['bail', 'sometimes', 'max:8000'],
            'session_mid_id' => ['bail', 'required', 'numeric'],
            'session_last_id' => ['bail', 'required', 'numeric'],
            'already_has_mid_exam' => ['bail', 'required', 'numeric'],
            'already_has_final_exam' => ['bail', 'required', 'numeric'],
        ]);
        if($data->fails()) {
            if($request->exam_session_id == $request->session_mid_id) {
                // for "mid" exam
                if($request->already_has_mid_exam == 0) {
                    // add a new "mid" exam
                    session(['caption-danger' => 'Your mid exam has not been uploaded. Try again.']);
                } else {
                    // update the "mid" exam
                    session(['caption-danger' => 'Your mid exam has not been updated. Try again.']);
                }
            } else if($request->exam_session_id == $request->session_last_id) {
                // for "final" exam
                if($request->already_has_final_exam == 0) {
                    // add a new "final" exam
                    session(['caption-danger' => 'Your final exam has not been uploaded. Try again.']);
                } else {
                    // update the "final" exam
                    session(['caption-danger' => 'Your final exam has not been updated. Try again.']);
                }
            } else return redirect()->route('login');
            return redirect()->back()->withErrors($data)->withInput();
        }
        
        $due_date = Carbon::createFromFormat('m/d/Y H:i A', $request->exam_due_date_date . ' ' . $request->exam_due_date_time)->toDateTimeString();
        if($due_date < now()) {
            session(['caption-danger' => 'Cannot change the due time as the inputted time is invalid.']);
            return redirect()->back()->withInput();
        }
        
        if($request->exam_session_id != $request->session_mid_id && $request->exam_session_id != $request->session_last_id)
            return redirect()->route('login');
        
        $file = $request->file('exam_path_1');
        if($file) {
            $file_name = Str::random(10) . '_' . $request['exam_title'] . '.' . $file->extension();
            $destination_path = 'uploads/exam/';
            $file->move($destination_path, $file_name);
        }
        
        $course = Course::findOrFail($course_id);
        if($request->exam_session_id == $request->session_mid_id) {
            // for "mid" exam
            if($request->already_has_mid_exam == 0) {
                // add a new "mid" exam
                Task::create([
                    'session_id' => $request->exam_session_id,
                    'type' => 'Exam',
                    'title' => $request->exam_title,
                    'description' => $request->exam_description,
                    'due_date' => $due_date,
                    'path_1' => ($file)? $file_name : null,
                    'created_at' => now(),
                ]);
                session(['caption-success' => 'This mid exam information has been added. Thank you!']);
            } else {
                // update the "mid" exam
                $exam = Task::where('session_id', $request->exam_session_id)->first();
                if($exam->path_1) {
                    $destination_path = 'uploads/exam/';
                    File::delete($destination_path . $exam->path_1);
                }
                $exam->update([
                    'session_id' => $request->exam_session_id,
                    'type' => 'Exam',
                    'title' => $request->exam_title,
                    'description' => $request->exam_description,
                    'due_date' => $due_date,
                    'path_1' => ($file)? $file_name : null,
                    'updated_at' => now(),
                ]);
                session(['caption-success' => 'This mid exam information has been updated. Thank you!']);
            }
        } else if($request->exam_session_id == $request->session_last_id) {
            // for "final" exam
            if($request->already_has_final_exam == 0) {
                // add a new "final" exam
                Task::create([
                    'session_id' => $request->exam_session_id,
                    'type' => 'Exam',
                    'title' => $request->exam_title,
                    'description' => $request->exam_description,
                    'due_date' => $due_date,
                    'path_1' => ($file)? $file_name : null,
                    'created_at' => now(),
                ]);
                session(['caption-success' => 'This final exam information has been added. Thank you!']);
            } else {
                // update the "final" exam
                $exam = Task::where('session_id', $request->exam_session_id)->first();
                if($exam->path_1) {
                    $destination_path = 'uploads/exam/';
                    File::delete($destination_path . $exam->path_1);
                }
                $exam->update([
                    'session_id' => $request->exam_session_id,
                    'type' => 'Exam',
                    'title' => $request->exam_title,
                    'description' => $request->exam_description,
                    'due_date' => $due_date,
                    'path_1' => ($file)? $file_name : null,
                    'updated_at' => now(),
                ]);
                session(['caption-success' => 'This final exam information has been updated. Thank you!']);
            }
        }
        return redirect()->back();
    }

    public function exam_destroy(Request $request, $course_id, $exam_id) {
        // menghapus informasi ujian
        $exam = Task::findOrFail($request->exam_id);
        if($exam->path_1) {
            $destination_path = 'uploads/exam/';
            File::delete($destination_path . $exam->path_1);
        }
        $exam->delete();
        session(['caption-success' => 'This exam information has been deleted. Thank you!']);
        return redirect()->back();
    }

    public function exam_submission_download($course_id, $submission_id) {
        // mengunduh pengumpulan ujian
        $data = TaskSubmission
            ::join('tasks', 'task_submissions.task_id', 'tasks.id')->where('tasks.type', 'Exam')
            ->where('task_submissions.id', $submission_id)
            ->select('task_submissions.id', 'task_submissions.code', 'task_submissions.session_registration_id', 'task_submissions.task_id', 'task_submissions.title', 'task_submissions.description', 'task_submissions.status', 'task_submissions.score', 'task_submissions.instructor_reply', 'task_submissions.path_1', 'task_submissions.path_1_submitted_at', 'task_submissions.path_2', 'task_submissions.path_2_submitted_at', 'task_submissions.path_3', 'task_submissions.path_3_submitted_at', 'task_submissions.created_at', 'task_submissions.updated_at', 'task_submissions.deleted_at')
            ->get()->first();
        $file_name = 'NUSIA_' . Carbon::now()->setTimezone(Auth::user()->timezone)->isoFormat('YYYY_MM_DD') . '_' . $data->path_1;
        $path = 'uploads/exam/submission/' . $data->path_1;
        return response()->download($path, $file_name);
    }

    public function exam_submission_update(Request $request, $course_id, $submission_id) {
        // mengoreksi pengumpulan ujian
        $data = Validator::make($request->all(), [
            'exam_submission_score' => ['bail', 'required', 'numeric'],
            'exam_submission_instructor_reply' => ['bail', 'required'],
        ]);
        if($data->fails()) {
            session(['caption-danger' => 'The submission information has not been updated. Try again.']);
            return redirect()->back()->withErrors($data)->withInput();
        }
        
        $task_submission = TaskSubmission::findOrFail($submission_id);
        if($task_submission->task->session->course_id == $course_id) {
            $task_submission->update([
                'score' => $request->exam_submission_score,
                'instructor_reply' => $request->exam_submission_instructor_reply,
                'status' => 'Accepted',
                'updated_at' => now(),
            ]);
            session(['caption-success' => 'This submission information has been updated. Thank you!']);
        } else {
            session(['caption-danger' => 'You are not authorized to update this information.']);
            return redirect()->back()->withErrors($data)->withInput();
        }
        return redirect()->back();
    }

    public function instructor_profile_show($user_id) {
        // melihat informasi profil instructor lain
    }

    public function chat_instructor_index() {
        // menghubungi instructor lain (via chat)
    }

    public function chat_instructor_show($user_id) {
        // menghubungi instructor lain (via chat)
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
        return view('role_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_instructor_store(Request $request, $user_id) {
        // menghubungi instructor lain (via chat)
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

    public function student_profile_show($user_id) {
        // melihat informasi profil student
        
        // PERLU MENGUBAH KEMBALI KODE INI SESUAI UPDATE DB YANG BARU
        $student = Student::where('user_id', $user_id)->get()->first();
        
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
            return view('role_instructor.student_profile_show', compact('student'));
        } else {
            return redirect()->back();
        }
    }

    public function chat_student_index() {
        // menghubungi student (via chat)
    }

    public function chat_student_show($user_id) {
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
        return view('role_instructor.chat_show', compact('users', 'messages', 'partner', 'partner_messages'));
    }

    public function chat_student_store(Request $request, $user_id) {
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

    public function index_course()
    {
        $courses = null;
        $sessions = null;
        if ($this->is_lead_instructor() || $this->is_instructor()) {
            $courses = Course
                ::join('sessions', 'courses.id', 'sessions.course_id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                //->where('instructor_schedules.status', 'Busy')
                ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at')
                ->distinct()
                ->get();
            $sessions = Session
                ::join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->distinct()
                ->orderBy('schedules.schedule_time')
                ->select('sessions.id', 'sessions.code', 'sessions.course_id', 'sessions.schedule_id', 'sessions.form_id', 'sessions.title', 'sessions.description', 'sessions.requirement', 'sessions.link_zoom', 'sessions.reschedule_late_confirmation', 'sessions.reschedule_technical_issue_instructor', 'sessions.reschedule_technical_issue_student', 'sessions.created_at', 'sessions.updated_at', 'sessions.deleted_at')
                ->get();
        } else return redirect()->route('home');

        if($this->is_lead_instructor()) {
            return view('role_lead_instructor.instructor_index_course', compact(
                'courses', 'sessions',
            ));
        } else if($this->is_instructor()) {
            return view('role_instructor.instructor_index_course', compact(
                'courses', 'sessions',
            ));
        }
    }

    public function show_course($course_id)
    {
        /*if ($this->is_lead_instructor() || $this->is_instructor()) {
            $course = Course
                ::join('sessions', 'sessions.course_id', 'courses.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('instructor_schedules', 'instructor_schedules.schedule_id', 'schedules.id')
                ->where('instructor_schedules.instructor_id', Auth::user()->instructor->id)
                ->where('courses.id', $course_id)
                ->select('courses.id', 'courses.code', 'courses.course_package_id', 'courses.title', 'courses.description', 'courses.requirement', 'courses.created_at', 'courses.updated_at', 'courses.deleted_at')
                ->distinct()->get()->first();
        } else return redirect()->route('sessions.index');

        if($this->is_lead_instructor()) {
            return view('role_lead_instructor.instructor_show_course', compact('course'));
        } else if($this->is_instructor()) {
            return view('role_instructor.instructor_show_course', compact('course'));
        }*/
    }
}
